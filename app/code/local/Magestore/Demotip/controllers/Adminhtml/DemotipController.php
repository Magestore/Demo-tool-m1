<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category 	Magestore
 * @package 	Magestore_Demotip
 * @copyright 	Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license 	http://www.magestore.com/license-agreement.html
 */

 /**
 * Demotip Adminhtml Controller
 *
 * @category 	Magestore
 * @package 	Magestore_Demotip
 * @author  	Magestore Developer
 */
class Magestore_Demotip_Adminhtml_DemotipController extends Mage_Adminhtml_Controller_Action
{
	/**
	 * init layout and set active for current menu
	 *
	 * @return Magestore_Demotip_Adminhtml_DemotipController
	 */
	protected function _initAction(){
		$this->loadLayout()
			->_setActiveMenu('demotip/demotip')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		return $this;
	}

	/**
	 * index action
	 */
	public function indexAction(){
		$this->_initAction()
			->renderLayout();
	}

	/**
	 * view and edit item action
	 */
	public function editAction() {
		$id	 = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('demotip/demotip')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data))
				$model->setData($data);

			Mage::register('demotip_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('demotip/demotip');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock('demotip/adminhtml_demotip_edit'))
				->_addLeft($this->getLayout()->createBlock('demotip/adminhtml_demotip_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('demotip')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}

	public function newAction() {
		$this->_forward('edit');
	}

	/**
	 * save item action
	 */
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			$model = Mage::getModel('demotip/demotip');
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));

			try {
				$model->save();
				$demotip_id = $model->getId();
				Mage::helper('demotip')->setData($demotip_id, $data['link']);
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('demotip')->__('Item was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('demotip')->__('Unable to find item to save'));
		$this->_redirect('*/*/');
	}

	/**
	 * delete item action
	 */
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('demotip/demotip');
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

	/**
	 * mass delete item(s) action
	 */
	public function massDeleteAction() {
		$demotipIds = $this->getRequest()->getParam('demotip');
		if(!is_array($demotipIds)){
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
		}else{
			try {
				foreach ($demotipIds as $demotipId) {
					$demotip = Mage::getModel('demotip/demotip')->load($demotipId);
					$demotip->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted', count($demotipIds)));
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
		$this->_redirect('*/*/index');
	}

	/**
	 * mass change status for item(s) action
	 */
	public function massStatusAction() {
		$demotipIds = $this->getRequest()->getParam('demotip');
		if(!is_array($demotipIds)) {
			Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
		} else {
			try {
				foreach ($demotipIds as $demotipId) {
					$demotip = Mage::getSingleton('demotip/demotip')
						->load($demotipId)
						->setStatus($this->getRequest()->getParam('status'))
						->setIsMassupdate(true)
						->save();
				}
				$this->_getSession()->addSuccess(
					$this->__('Total of %d record(s) were successfully updated', count($demotipIds))
				);
			} catch (Exception $e) {
				$this->_getSession()->addError($e->getMessage());
			}
		}
		$this->_redirect('*/*/index');
	}

	/**
	 * export grid item to CSV type
	 */
	public function exportCsvAction(){
		$fileName   = 'demotip.csv';
		$content	= $this->getLayout()->createBlock('demotip/adminhtml_demotip_grid')->getCsv();
		$this->_prepareDownloadResponse($fileName,$content);
	}

	/**
	 * export grid item to XML type
	 */
	public function exportXmlAction(){
		$fileName   = 'demotip.xml';
		$content	= $this->getLayout()->createBlock('demotip/adminhtml_demotip_grid')->getXml();
		$this->_prepareDownloadResponse($fileName,$content);
	}

	protected function _isAllowed(){
		return Mage::getSingleton('admin/session')->isAllowed('demotip');
	}
}

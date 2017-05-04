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
 * Demotip Edit Form Content Tab Block
 * 
 * @category 	Magestore
 * @package 	Magestore_Demotip
 * @author  	Magestore Developer
 */
class Magestore_Demotip_Block_Adminhtml_Demotip_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	/**
	 * prepare tab form's information
	 *
	 * @return Magestore_Demotip_Block_Adminhtml_Demotip_Edit_Tab_Form
	 */
	protected function _prepareForm(){
		$form = new Varien_Data_Form();
		$this->setForm($form);
		
		if (Mage::getSingleton('adminhtml/session')->getDemotipData()){
			$data = Mage::getSingleton('adminhtml/session')->getDemotipData();
			Mage::getSingleton('adminhtml/session')->setDemotipData(null);
		}elseif(Mage::registry('demotip_data'))
			$data = Mage::registry('demotip_data')->getData();
		
		$fieldset = $form->addFieldset('demotip_form', array('legend'=>Mage::helper('demotip')->__('Demotip information')));
		$wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
        $wysiwygConfig->addData(array(
            'add_variables'				=> false,
            'plugins'					=> array(),
            'widget_window_url'			=> Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/widget/index'),
            'directives_url'			=> Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive'),
            'directives_url_quoted'		=> preg_quote(Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive')),
            'files_browser_window_url'	=> Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index'),
        ));
		$fieldset->addField('name', 'text', array(
			'label'		=> Mage::helper('demotip')->__('Name'),
			'class'		=> 'required-entry',
			'required'	=> true,
			'name'		=> 'name',
		));
		
		$fieldset->addField('demotip_content', 'editor', array(
			'name'		=> 'demotip_content',
			'label'		=> Mage::helper('demotip')->__('Content'),
			'title'		=> Mage::helper('demotip')->__('Content'),
			'style'		=> 'width:600',
			'wysiwyg'	=> true,
			'required'	=> false,
			'config'	=> $wysiwygConfig,
		));					
		
		$fieldset->addField('left', 'text', array(
			'label'		=> Mage::helper('demotip')->__('Position Left'),			
			'name'		=> 'left',
		));
		
		$fieldset->addField('top', 'text', array(
			'label'		=> Mage::helper('demotip')->__('Position Top'),			
			'name'		=> 'top',
		));
//		
//		$fieldset->addField('width', 'text', array(
//			'label'		=> Mage::helper('demotip')->__('Width'),			
//			'name'		=> 'width',
//		));
//		
//		$fieldset->addField('height', 'text', array(
//			'label'		=> Mage::helper('demotip')->__('Height'),			
//			'name'		=> 'height',
//		));
		
		$fieldset->addField('link', 'text', array(
			'label'		=> Mage::helper('demotip')->__('Link Url'),			
			'name'		=> 'link',
			'value'     => Mage::helper('demotip')->getData($this->getRequest()->getParam('id')),			
		))->setRenderer($this->getLayout()->createBlock('demotip/adminhtml_grid_renderer_button'));      
		
		
		$fieldset->addField('image_option', 'select', array(
			'label'		=> Mage::helper('demotip')->__('Image Pointer'),
			'name'		=> 'image_option',
			'values'	=> Mage::getSingleton('demotip/status')->getImageArray(),
		));
				
		
		$fieldset->addField('relative_id', 'text', array(
			'label'		=> Mage::helper('demotip')->__('Set Relative Id'),			
			'name'		=> 'relative_id',
			'note'		=> 'This is Id which will be choosen in code HTML by enable debug'
		));
		
		$fieldset->addField('status', 'select', array(
			'label'		=> Mage::helper('demotip')->__('Status'),
			'name'		=> 'status',
			'values'	=> Mage::getSingleton('demotip/status')->getOptionHash(),
		));
		
		$form->setValues($data);
		return parent::_prepareForm();
	}
}
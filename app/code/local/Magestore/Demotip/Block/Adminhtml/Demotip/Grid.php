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
 * Demotip Grid Block
 * 
 * @category 	Magestore
 * @package 	Magestore_Demotip
 * @author  	Magestore Developer
 */
class Magestore_Demotip_Block_Adminhtml_Demotip_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct(){
		parent::__construct();
		$this->setId('demotipGrid');
		$this->setDefaultSort('demotip_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);		
	}
	
	/**
	 * prepare collection for block to display
	 *
	 * @return Magestore_Demotip_Block_Adminhtml_Demotip_Grid
	 */
	protected function _prepareCollection(){
	
		$collection = Mage::getModel('demotip/demotip')->getCollection()->joinLinks();	;		
		$this->setCollection($collection);		
		return parent::_prepareCollection();
	}
	
	/**
	 * prepare columns for this grid
	 *
	 * @return Magestore_Demotip_Block_Adminhtml_Demotip_Grid
	 */
	protected function _prepareColumns(){
		$this->addColumn('demotip_id', array(
			'header'	=> Mage::helper('demotip')->__('ID'),
			'align'	 =>'right',
			'width'	 => '50px',
			'index'	 => 'demotip_id',
		));

		$this->addColumn('name', array(
			'header'	=> Mage::helper('demotip')->__('Name'),
			'align'	 =>'left',
			'index'	 => 'name',
		));
                
                $this->addColumn('demotip_content', array(
			'header'	=> Mage::helper('demotip')->__('Content'),
			'align'	 =>'left',
                        'width'	 => '500px',
			'index'	 => 'demotip_content',
		));
                
                $this->addColumn('left', array(
			'header'	=> Mage::helper('demotip')->__('Position Left'),
			'align'	 =>'center',
                        'width'	 => '50px',
			'index'	 => 'left',
		));
                
                $this->addColumn('top', array(
			'header'	=> Mage::helper('demotip')->__('Position Top'),
			'align'	 =>'center',
                        'width'	 => '50px',
			'index'	 => 'top',
		));
//                $this->addColumn('width', array(
//			'header'	=> Mage::helper('demotip')->__('Width'),
//			'align'	 =>'center',
//                        'width'	 => '50px',
//			'index'	 => 'width',
//		));
//                $this->addColumn('height', array(
//			'header'	=> Mage::helper('demotip')->__('Height'),
//			'align'	 =>'center',
//                        'width'	 => '50px',
//			'index'	 => 'height',
//		));
                
                $this->addColumn('link', array(
			'header'	=> Mage::helper('demotip')->__('Link Url'),
			'align'	 =>'center',
			'index'	 => 'link',
		));
                $this->addColumn('relative_id', array(
			'header'	=> Mage::helper('demotip')->__('Set Relative Id'),
			'align'	 =>'center',
			'index'	 => 'relative_id',
		));

		$this->addColumn('status', array(
			'header'	=> Mage::helper('demotip')->__('Status'),
			'align'	 => 'left',
			'width'	 => '80px',
			'index'	 => 'status',
			'type'		=> 'options',
			'options'	 => array(
				1 => 'Enabled',
				2 => 'Disabled',
			),
		));

		$this->addColumn('action',
			array(
				'header'	=>	Mage::helper('demotip')->__('Action'),
				'width'		=> '100',
				'type'		=> 'action',
				'getter'	=> 'getId',
				'actions'	=> array(
					array(
						'caption'	=> Mage::helper('demotip')->__('Edit'),
						'url'		=> array('base'=> '*/*/edit'),
						'field'		=> 'id'
					)),
				'filter'	=> false,
				'sortable'	=> false,
				'index'		=> 'stores',
				'is_system'	=> true,
		));

		$this->addExportType('*/*/exportCsv', Mage::helper('demotip')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('demotip')->__('XML'));

		return parent::_prepareColumns();
	}
	
	/**
	 * prepare mass action for this grid
	 *
	 * @return Magestore_Demotip_Block_Adminhtml_Demotip_Grid
	 */
	protected function _prepareMassaction(){
		$this->setMassactionIdField('demotip_id');
		$this->getMassactionBlock()->setFormFieldName('demotip');

		$this->getMassactionBlock()->addItem('delete', array(
			'label'		=> Mage::helper('demotip')->__('Delete'),
			'url'		=> $this->getUrl('*/*/massDelete'),
			'confirm'	=> Mage::helper('demotip')->__('Are you sure?')
		));

		$statuses = Mage::getSingleton('demotip/status')->getOptionArray();

		array_unshift($statuses, array('label'=>'', 'value'=>''));
		$this->getMassactionBlock()->addItem('status', array(
			'label'=> Mage::helper('demotip')->__('Change status'),
			'url'	=> $this->getUrl('*/*/massStatus', array('_current'=>true)),
			'additional' => array(
				'visibility' => array(
					'name'	=> 'status',
					'type'	=> 'select',
					'class'	=> 'required-entry',
					'label'	=> Mage::helper('demotip')->__('Status'),
					'values'=> $statuses
				))
		));
		return $this;
	}
	
	/**
	 * get url for each row in grid
	 *
	 * @return string
	 */
	public function getRowUrl($row){
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}
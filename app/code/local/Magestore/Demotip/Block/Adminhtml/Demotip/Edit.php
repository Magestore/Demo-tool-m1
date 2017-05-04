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
 * Demotip Edit Block
 * 
 * @category 	Magestore
 * @package 	Magestore_Demotip
 * @author  	Magestore Developer
 */
class Magestore_Demotip_Block_Adminhtml_Demotip_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct(){
		parent::__construct();
		
		$this->_objectId = 'id';
		$this->_blockGroup = 'demotip';
		$this->_controller = 'adminhtml_demotip';
		
		$this->_updateButton('save', 'label', Mage::helper('demotip')->__('Save Demotip'));
		$this->_updateButton('delete', 'label', Mage::helper('demotip')->__('Delete Demotip'));
		
		$this->_addButton('saveandcontinue', array(
			'label'		=> Mage::helper('adminhtml')->__('Save And Continue Edit'),
			'onclick'	=> 'saveAndContinueEdit()',
			'class'		=> 'save',
		), -100);

		$this->_formScripts[] = "
			function toggleEditor() {
				if (tinyMCE.getInstanceById('demotip_content') == null)
					tinyMCE.execCommand('mceAddControl', false, 'demotip_content');
				else
					tinyMCE.execCommand('mceRemoveControl', false, 'demotip_content');
			}

			function saveAndContinueEdit(){
				editForm.submit($('edit_form').action+'back/edit/');
			}
		";
	}
	
	/**
	 * get text to show in header when edit an item
	 *
	 * @return string
	 */
	public function getHeaderText(){
		if(Mage::registry('demotip_data') && Mage::registry('demotip_data')->getId())
			return Mage::helper('demotip')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('demotip_data')->getName()));
		return Mage::helper('demotip')->__('Add Item');
	}
}
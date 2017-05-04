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
 * Demotip Adminhtml Block
 * 
 * @category 	Magestore
 * @package 	Magestore_Demotip
 * @author  	Magestore Developer
 */
class Magestore_Demotip_Block_Adminhtml_Template extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct(){
		$this->_controller = 'adminhtml_demotip';
		$this->_blockGroup = 'demotip';
		$this->_headerText = Mage::helper('demotip')->__('Item Manager');
		$this->_addButtonLabel = Mage::helper('demotip')->__('Add Item');		
		parent::__construct();
	}
	
	public function getThisUrlAction(){	
		$urlRequest = $this->getRequest();		
		$baseUrl = $urlRequest->getOriginalPathInfo(); 	
		$urlAction = str_replace("/", "_", $baseUrl);		
	
		return $urlAction;
	}	
	
	public function compareUrlAction ($urlAction1, $urlAction2){
		//$lenght = strlen($urlAction1);
		if ($urlAction1 == "adminhtml_default"){
			return 0;
		}		
		$urlAction1 = str_replace("/", "_", $urlAction1);
        if (strpos($urlAction2, $urlAction1) === 0) {
            return 0;
        }
		return strcmp($urlAction1, $urlAction2);
	}
	
	public function megerDemoTipId($urlAction , $collectionUrlLink){
		$array = array();
		foreach ($collectionUrlLink as $urlLink){			
			$compare = $this->compareUrlAction($urlLink->getData('link'), $urlAction);					
			if ($compare == 0){
				$array[] = $urlLink->getData('demotip_id');				
			}
		}				
		return array_unique($array);
	}
}
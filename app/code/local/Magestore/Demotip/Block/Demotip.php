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
 * Demotip Block
 * 
 * @category 	Magestore
 * @package 	Magestore_Demotip
 * @author  	Magestore Developer
 */
class Magestore_Demotip_Block_Demotip extends Mage_Core_Block_Template
{
	/**
	 * prepare block's layout
	 *
	 * @return Magestore_Demotip_Block_Demotip
	 */
	public function _prepareLayout(){
		return parent::_prepareLayout();
	}
	
	public function getThisUrlAction(){	
		$urlRequest = $this->getRequest();		
		$baseUrl = $urlRequest->getOriginalPathInfo(); 	
		$urlAction = str_replace("/", "_", $baseUrl);		
	
		return $urlAction;
	}	
	
	public function compareUrlAction ($urlAction1, $urlAction2){
		//$lenght = strlen($urlAction1);
		if ($urlAction1 == "default"){
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
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
 * @category    Magestore
 * @package     Magestore_Demoguide
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Demoguide Helper
 * 
 * @category    Magestore
 * @package     Magestore_Demoguide
 * @author      Magestore Developer
 */
class Magestore_Demoguide_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getModuleEnable(){
		return Mage::getStoreConfig('demoguide/general/enable',Mage::app()->getStore());
	}
	public function getExtensionName(){
		return Mage::getStoreConfig('demoguide/general/extension_name',Mage::app()->getStore());
	}
	public function getUrlFrontendDemo(){
		return Mage::getStoreConfig('demoguide/general/url_frontenddemo',Mage::app()->getStore());
	}
	public function getShortDesFrontendDemo(){
		return Mage::getStoreConfig('demoguide/general/des_frontenddemo',Mage::app()->getStore());
	}
	public function getUrlFrontendSanboxDemo(){
		return Mage::getStoreConfig('demoguide/general/url_frontendsanboxdemo',Mage::app()->getStore());
	}
	public function getUrlBackendSanboxDemo(){
		return Mage::getStoreConfig('demoguide/general/url_backendsanboxdemo',Mage::app()->getStore());
	}
	public function getShortDesBackendSandboxDemo(){
		return Mage::getStoreConfig('demoguide/general/des_backendsanboxdemo',Mage::app()->getStore());
	}
}
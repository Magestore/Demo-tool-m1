<?php

class Magestore_Demoguide_IndexController extends Mage_Core_Controller_Front_Action
{
	//const XML_DEMOTIP_ENABLE  = 'demotip/general/enable';
	public function disabledemotipAction(){
		//$config = Mage::getModel('core/config');
		//$config ->saveConfig(self::XML_DEMOTIP_ENABLE,0);
		//$config->cleanCache();
		$action = $this->getRequest()->getParam('action');
		if($action=='turn_on'){
			$cookie = Mage::getSingleton('core/cookie');
			$timecookie = 3600*24;
			$cookie->set('visitor_turn_onoff', 1 ,$timecookie,'/');
			$this->getResponse()->setBody('turn on success');
		}
	}
	public function enabledemotipAction(){
		//$config = Mage::getModel('core/config');
		//$config ->saveConfig(self::XML_DEMOTIP_ENABLE,1);
		//$config->cleanCache();
		$action = $this->getRequest()->getParam('action');
		if($action=='turn_off'){
			Mage::getModel('core/cookie')->delete('visitor_turn_onoff');
			$this->getResponse()->setBody('turn off success');
		}
	}
}
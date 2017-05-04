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
 * Demotip Model
 * 
 * @category 	Magestore
 * @package 	Magestore_Demotip
 * @author  	Magestore Developer
 */
class Magestore_Demotip_Model_Link extends Mage_Core_Model_Abstract
{
	public function _construct(){
		parent::_construct();
		$this->_init('demotip/link');
	}
}
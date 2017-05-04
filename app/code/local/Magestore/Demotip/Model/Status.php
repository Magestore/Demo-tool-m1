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
 * Demotip Status Model
 * 
 * @category 	Magestore
 * @package 	Magestore_Demotip
 * @author  	Magestore Developer
 */
class Magestore_Demotip_Model_Status extends Varien_Object {

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    /**
     * get model option as array
     *
     * @return array
     */
    static public function getOptionArray() {
        return array(
            self::STATUS_ENABLED => Mage::helper('demotip')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('demotip')->__('Disabled')
        );
    }

    /**
     * get model option hash as array
     *
     * @return array
     */
    static public function getOptionHash() {
        $options = array();
        foreach (self::getOptionArray() as $value => $label)
            $options[] = array(
                'value' => $value,
                'label' => $label
            );
        return $options;
    }

    static public function getImageArray() {
        return array(
            'none' => Mage::helper('demotip')->__('------Please Choose Image Pointer------'),
//				'1' 	=> Mage::helper('demotip')->__('Left To Right'),
//				'2' 	=> Mage::helper('demotip')->__('Right To Left'),
            '1' => Mage::helper('demotip')->__('To Corner Left Bottom'),
            '2' => Mage::helper('demotip')->__('To Corner Rgiht Bottom'),
            '3' => Mage::helper('demotip')->__('To Corner Left Up'),
            '4' => Mage::helper('demotip')->__('To Corner Right Up'),
            '5' => Mage::helper('demotip')->__('Up to Bottom'),
            '6' => Mage::helper('demotip')->__('Bottom to Up')
        );
    }

}

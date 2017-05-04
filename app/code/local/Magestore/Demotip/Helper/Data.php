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
 * Demotip Helper
 * 
 * @category 	Magestore
 * @package 	Magestore_Demotip
 * @author  	Magestore Developer
 */
class Magestore_Demotip_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getData($id) {
        if (!$id) {
            return null;
        }
        $collection = Mage::getModel('demotip/link')->getCollection()->addFieldToFilter('demotip_id', $id)->addFieldToFilter('dele', 0);
        return $collection;
    }

    public function setData($demotip_id, $link) {
        foreach ($link as $item) {
            $model = Mage::getModel('demotip/link');
            $link_id = $item['idlink'];
            if ($item['demotip_id'] == 0) {
                $model->setData('demotip_id', $demotip_id);
                $model->setData('link', $item['link']);
                $model->setData('dele', $item['dele']);
                $model->save();
            } else {
                $model->setData($item)->setId($link_id);
                $model->save();
            }
        }
    }

    public function changeUrlEnter($urlAction) {
        return $urlAction = str_replace("/", "_", $urlAction);
    }

    public function getModelLink() {
        $collection = Mage::getModel('demotip/link')->getCollection()->addFilter('dele', 0);
        return $collection;
    }

    public function getModelDemotip($demotip_id) {
        $collection = Mage::getModel('demotip/demotip')->getCollection()->addFieldToFilter('demotip_id', $demotip_id)
            ->addFieldToFilter('status', 1);
        return $collection;
    }

    public function isShowDemotip() {
        if (Mage::getModel('core/cookie')->get('visitor_turn_onoff') == 1) {
            return false;
        }
        return Mage::getStoreConfig('demotip/general/enable');
    }

    public function endCodeJs($string) {
        return Zend_Json::encode(array('html' => $string));
    }

    public function getCssForImage($imageOption) {
        $styleCss;
        switch ($imageOption) {
//            case '1':
//                $styleCss = 'style="background:url(' . Mage::getBaseUrl("media") . 'demotip/left-to-right.png) no-repeat right; top: 24%; right: -54px; width: 50%; height: 50%"';
//                break;
//            case '2':
//                $styleCss = 'style="background:url(' . Mage::getBaseUrl("media") . 'demotip/right-to-left.png) no-repeat left; top: 24%; left: -54px; width: 50%; height: 50%"';
//                break;
            case '1':
                $styleCss = 'style="background:url(' . Mage::getBaseUrl("media") . 'demotip/left-bottom.png) no-repeat left; top: -4px;left:15px; position: relative"';
                break;
            case '2':
                $styleCss = 'style="background:url(' . Mage::getBaseUrl("media") . 'demotip/right-bottom.png) no-repeat right; top: -3px;right:20px; position: relative"';
                break;
            case '3':
                $styleCss = 'style="background:url(' . Mage::getBaseUrl("media") . 'demotip/left-up.png) no-repeat left;left:15px; top: -51px;"';
                break;
            case '4':
                $styleCss = 'style="background:url(' . Mage::getBaseUrl("media") . 'demotip/right-up.png) no-repeat right; top: -51px;right:15px;"';
                break;
            case '5':
                $styleCss = 'style="background:url(' . Mage::getBaseUrl("media") . 'demotip/up-bottom.png) no-repeat center top;bottom:-48px;height:60px;"';
                break;
            case '6':
                $styleCss = 'style="background:url(' . Mage::getBaseUrl("media") . 'demotip/bottom-up.png) no-repeat center top; top: -53px;"';
                break;
            default:
                $styleCss = null;
        }
        return $styleCss;
    }

}

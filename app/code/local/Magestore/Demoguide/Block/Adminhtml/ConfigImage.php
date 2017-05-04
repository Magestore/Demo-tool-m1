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
 * Demoguide Block
 * 
 * @category    Magestore
 * @package     Magestore_Demoguide
 * @author      Magestore Developer
 */
class Magestore_Demoguide_Block_Adminhtml_ConfigImage extends Mage_Adminhtml_Block_System_Config_Form_Field {

    protected $_addRowButtonHtml = array();
    protected $_removeRowButtonHtml = array();

    /**
     * Returns html part of the setting
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {
        $this->setElement($element);

//        $html = '<div id="emailblocker_addresses_template" style="display:none">';
//        $html .= $this->_getRowTemplateHtml();
//        $html .= '</div>';
//
//        $html .= '<ul id="emailblocker_addresses_container">';
//        if ($this->_getValue('addresses')) {
//            foreach ($this->_getValue('addresses') as $i => $f) {
//                if ($i) {
//                    $html .= $this->_getRowTemplateHtml($i);
//                }
//            }
//        }
//        $html .= '</ul>';
//        $html .= $this->_getAddRowButtonHtml('emailblocker_addresses_container', 'emailblocker_addresses_template', $this->__('Add New Email'));
        $html = $this->_getImageButtonHtml();
        return $html;
    }
    
    protected function _getDisabled() {
        return $this->getElement()->getDisabled() ? ' disabled' : '';
    }

    protected function _getValue($key) {
        return $this->getElement()->getData('value/' . $key);
    }

    protected function _getSelected($key, $value) {
        return $this->getElement()->getData('value/' . $key) == $value ? 'selected="selected"' : '';
    }
    
    protected function _getImageButtonHtml(){
        if (!$this->_imageButtonHtml) {
            $this->_imageButtonHtml = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setType('image')
                //->setClass('demoguide-upload-image')
                ->setLabel($this->__('Upload'))
                //->setOnClick("")
                ->setDisabled($this->_getDisabled())
                ->toHtml();
        }
        return $this->_imageButtonHtml;
    }

}

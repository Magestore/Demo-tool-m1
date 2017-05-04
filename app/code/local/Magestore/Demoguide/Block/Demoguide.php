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
class Magestore_Demoguide_Block_Demoguide extends Mage_Core_Block_Template {

    /**
     * prepare block's layout
     *
     * @return Magestore_Demoguide_Block_Demoguide
     */
    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function displayonLeftSidebarBlock() {
        $this->setTemplate('demoguide/demoguide.phtml');
    }

}

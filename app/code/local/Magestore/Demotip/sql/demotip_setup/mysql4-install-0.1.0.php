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

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * create demotip table
 */
$installer->run("

DROP TABLE IF EXISTS {$this->getTable('demotip')};
DROP TABLE IF EXISTS {$this->getTable('demotip_link')};
CREATE TABLE {$this->getTable('demotip')} (
  `demotip_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',  
  `demotip_content` text NULL default '',
  `left` int(11) NULL default '0',  
  `top`  int(11) NULL default '0',
  `width` int(11) NULL default '0', 
  `height` int(11) NULL default '0',
  `image_left` int(11) NULL default '0',
  `image_top` int(11) NULL default '0',
  `image_option` int(11) NULL default '0',
  `relative_id`  varchar(255) NULL default '',
  `status` smallint(6) NOT NULL default '0',
  PRIMARY KEY (`demotip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE {$this->getTable('demotip_link')} (
  `link_id` int(11) unsigned NOT NULL auto_increment,
  `demotip_id` int(11) unsigned NOT NULL,  
  `link` text  NULL default '',
  `dele` smallint(6) NULL default '0',
  FOREIGN KEY (`demotip_id`) REFERENCES `{$this->getTable('demotip')}` (`demotip_id`) ON DELETE CASCADE ON UPDATE CASCADE,  
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

");

$installer->endSetup();


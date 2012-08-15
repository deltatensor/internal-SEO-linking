<?php
/**
 * Internal SEO Linking
 *
 * LICENSE: this source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category    Ikantam
 * @package     Ikantam_Internalseolinking
 * @copyright   Copyright (c) 2012 iKantam LLC (http://www.ikantam.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Create table 'internalseolinking/internalseolinking'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('internalseolinking/internalseolinking'))
    
    ->addColumn(
        'id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'Internal SEO Link ID'
    )
        
    ->addColumn(
        'keywords', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable'  => false,
        ), 'Internal SEO Link Keywords'
    )

    ->addColumn(
        'url', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable'  => false,
        ), 'Internal SEO Link URL'
    )

    ->addColumn(
        'title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable'  => true,
            'default'   => null,
        ), 'Internal SEO Link Title'
    )

    ->addColumn(
        'is_enabled', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned'  => true,
            'nullable'  => false,
            'default'   => '0',
        ), 'Internal SEO Link is Enabled'
    )

    ->addColumn(
        'target_blank', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned'  => true,
            'nullable'  => false,
            'default'   => '0',
        ), 'Internal SEO Link Target is "_blank"'
    )
    
    ->addColumn(
        'is_bold', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned'  => true,
            'nullable'  => false,
            'default'   => '0',
        ), 'Internal SEO Link is Bold'
    )
    
    ->addColumn(
        'is_italic', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned'  => true,
            'nullable'  => false,
            'default'   => '0',
        ), 'Internal SEO Link is Italic'
    );
        
$installer->getConnection()->createTable($table);

$installer->endSetup();

<?php
/**
 *
 *  Magestore
 *   NOTICE OF LICENSE
 *
 *   This source file is subject to the Magestore.com license that is
 *   available through the world-wide-web at this URL:
 *   http://www.magestore.com/license-agreement.html
 *
 *   DISCLAIMER
 *
 *   Do not edit or add to this file if you wish to upgrade this extension to newer
 *   version in the future.
 *
 * @category    Magestore
 * @package     Magestore_ReportSuccess
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 *
 */

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->getConnection()->dropTable($installer->getTable('dcpreconfig/preconfigvalue'));

/**
 * Create table 'os_report_flagtag'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('dcpreconfig/preconfigvalue'))
    ->addColumn(
        'id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array('identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true),
        'ID'
    )
    ->addColumn(
        'product_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array('default' => null),
        'product_id'
    )
    ->addColumn(
        'attribute_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array('default' => null),
        'attribute_id'
    )
    ->addColumn(
        'attributeindex',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array('default' => null),
        'attributeindex'
    )
    ->addColumn(
        'value_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array('default' => null),
        'value_id'
    )
    ->setComment('Preconfig Value');

$installer->getConnection()->createTable($table);

$installer->endSetup();

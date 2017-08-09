<?php
class Dreamcode_Preconfig_Model_Mysql4_Preconfigvalue_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('dcpreconfig/preconfigvalue');
    }
}
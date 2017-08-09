<?php
class Dreamcode_Preconfig_Model_Mysql4_Preconfigvalue extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('dcpreconfig/preconfigvalue', 'id');
    }
    
}
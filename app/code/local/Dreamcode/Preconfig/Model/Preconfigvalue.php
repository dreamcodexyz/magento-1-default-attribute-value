<?php
class Dreamcode_Preconfig_Model_Preconfigvalue extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('dcpreconfig/preconfigvalue');
    }
}
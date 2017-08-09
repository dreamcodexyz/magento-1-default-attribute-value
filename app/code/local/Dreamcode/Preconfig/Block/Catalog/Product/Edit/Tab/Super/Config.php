<?php
class Dreamcode_Preconfig_Block_Catalog_Product_Edit_Tab_Super_Config extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_Config
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('dcpreconfig/catalog/product/edit/super/config.phtml');
    }

    public function getPreSelectedValue()
    {
        $product_id =  $this->_getProduct()->getId();

        $collections = Mage::getModel('dcpreconfig/preconfigvalue')->getCollection();
        $collections->addFieldToFilter('product_id', array('eq'=>$product_id));

        foreach ($collections as $item) {
            $data[] = [
                'attributeindex' => $item->getData('attributeindex'),
                'value_id' => $item->getData('value_id')
            ];
        }

        return Mage::helper('core')->jsonEncode($data);

    }
}

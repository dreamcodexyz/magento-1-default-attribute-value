<?php
class Dreamcode_Preconfig_Block_Catalog_Product_Edit_Tab_Super_Config extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_Config

{
    /**
     * Initialize block
     *
     */
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->setProductId($this->getRequest()->getParam('id'));
    //     $this->setTemplate('dcpreconfig/product/edit/super/config.phtml');
    //     $this->setId('config_super_product');
    //     $this->setCanEditPrice(true);
    //     $this->setCanReadPrice(true);
    // }

    public function __construct()
    {
        Mage::log(__LINE__.' '.__METHOD__);
        parent::__construct();
        $this->setTemplate('dcpreconfig/catalog/product/edit/super/config.phtml');
    }

    /**
     * Initialize block
     *
     */
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->setProductId($this->getRequest()->getParam('id'));
    //     $this->setTemplate('dcpreconfig/product/edit/super/config.phtml');
    //     $this->setId('config_super_product');
    //     $this->setCanEditPrice(true);
    //     $this->setCanReadPrice(true);
    // }

    
}

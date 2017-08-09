<?php
class Dreamcode_Preconfig_Model_Observer  {

    public function preSelectConfigurable($observer)
    {
        Mage::log(__LINE__.' '.__METHOD__, null, 'mylogfile.log');
        $product    = $observer->getEvent()->getProduct();
        $request    = Mage::app()->getRequest();
        $controller = $request->getControllerName();
        $action     = $request->getActionName();
        $candidates = array();

        $product_id = $product->getId();

        $collections = Mage::getModel('dcpreconfig/preconfigvalue')->getCollection();
        $collections->addFieldToFilter('product_id', array('eq'=>$product_id));

        foreach ($collections as $item) {
            $defaultAtttVals[$item->getData('attribute_id')] = $item->getData('value_id');
        }

        if(!empty($defaultAtttVals)){
            $candidates = $defaultAtttVals;
        }else{
            if (($action === 'view') && ($controller === 'product') && ($product->getTypeId() === 'configurable')) {
                $configurableAttributes = $product->getTypeInstance(true)->getConfigurableAttributes($product);
                $usedProducts = $product->getTypeInstance(true)->getUsedProducts(null, $product);
                foreach ($usedProducts as $childProduct) {
                    if (!$childProduct->isSaleable()) {
                        continue;
                    }
                    foreach ($configurableAttributes as $attribute) {
                        $productAttribute   = $attribute->getProductAttribute();
                        $productAttributeId = $productAttribute->getId();
                        $attributeValue     = $childProduct->getData($productAttribute->getAttributeCode());
                        $candidates[$productAttributeId] =  $attributeValue;

                        

                    }
                    break;
                }
            }
        }

        $preconfiguredValues = new Varien_Object();
        $preconfiguredValues->setData('super_attribute', $candidates);
        $product->setPreconfiguredValues($preconfiguredValues);

    }

    public function prepareProductSave($observer)
    {
        $request = $observer->getEvent()->getRequest();
        $product = $observer->getEvent()->getProduct();
        $data_pre = $request->getPost('dcpreselected');

        if (($configurable_attributes_data = $request->getPost('configurable_attributes_data'))
            && !$product->getConfigurableReadonly()
        ) {
            $configurable_attributes_data = Mage::helper('core')->jsonDecode($configurable_attributes_data);
            $product_id = $product->getId();
            $save_data = [];

            if(!empty($data_pre)){
                foreach ($data_pre as $key => $value) {
                    $attribute_index = $key;
                    $attribute_value_index = $value;
                    $keyx = false;

                    foreach ($configurable_attributes_data as $k => $v) {
                        $keyx = array_search($attribute_value_index, array_column($v['values'], 'value_index'));
                        if($keyx !== false){
                            $save_data[] = [
                                'product_id' => $product_id,
                                'attribute_id' => $v['attribute_id'],
                                'attributeindex' => $attribute_index,
                                'value_id' => $attribute_value_index
                            ];

                            
                            $collections = Mage::getModel('dcpreconfig/preconfigvalue')->getCollection();
                            $collections->addFieldToFilter('product_id', array('eq'=>$product_id));

                            foreach ($collections as $item) {
                                $item->delete();
                            }
                        }
                    }
                }
                if(!empty($save_data)){
                    foreach ($save_data as $pre_data) {
                        $model = Mage::getSingleton('dcpreconfig/preconfigvalue')->setData($pre_data);
                        $model->save();
                    }    
                }
            }
        }
    }
}

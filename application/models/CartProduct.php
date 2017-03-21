<?php

class Application_Model_CartProduct extends Zend_Db_Table_Abstract
{
    protected $_name = 'cart_product';

    function checkExistence($product_id) {
        $check = $this->find($product_id)->toArray();
         if (!empty($check)) {
            return TRUE;
        }
        return FALSE;
    }

    function addNewItemToCart($cart_id,$product_id,$quantity){
        $data = array(
              'customerID' => $cart_id ,
              'productID'  => $product_id,
              'quantity'   => $quantity
            );

        $this->insert($data);
    }

}

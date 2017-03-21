<?php

class Application_Model_Cart extends Zend_Db_Table_Abstract {

    protected $_name = 'cart';

    function functionName($param) {
        
    }

    function cartDetails($cart_id) {
        return $this->find("cartID=$cart_id")->toArray()[0];
    }

    function checkExistence($customer_id) {
        $check = $this->find($customer_id)->toArray();
        if (!empty($check)) {
            return TRUE;
        }
        return FALSE;
    }

    function newCart($customer_id) {
        $data = array('customerID' => $catID);

        $this->insert($data);
    }

    function getCartID($customer_id) {

        return $this->find($customer_id)->toArray()[0];
    }

}

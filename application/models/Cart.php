<?php

class Application_Model_Cart extends Zend_Db_Table_Abstract {

    protected $_name = 'cart';

    function functionName($param) {

    }

    function cartDetails($cart_id) {
        return $this->find("cartID=$cart_id")->toArray()[0];
    }

    function checkExistence($customer_id) {
<<<<<<< HEAD
        $check= $this->fetchAll("customerID=$customer_id")->toArray();
         if (! empty($check)) {
=======
        $check = $this->find($customer_id)->toArray();
        if (!empty($check)) {
>>>>>>> 8c880f91afb41b86276a12c76284af9638299c7f
            return TRUE;
        }
        return FALSE;
    }

<<<<<<< HEAD
    function newCart($customer_id){
        $data = array('customerID' => $customer_id);
=======
    function newCart($customer_id) {
        $data = array('customerID' => $catID);
>>>>>>> 8c880f91afb41b86276a12c76284af9638299c7f

        $this->insert($data);
    }

    function getCartID($customer_id) {

        $result = $this->fetchAll("customerID=$customer_id")->toArray()[0];
        return $result['cartID'];
    }

}

<?php

class Application_Model_Cart extends Zend_Db_Table_Abstract {

    protected $_name = 'cart';

    function functionName($param) {

    }

    function cartDetails($cart_id) {
        return $this->find("cartID=$cart_id")->toArray()[0];
    }

    function checkExistence($customer_id) {
        $check= $this->fetchAll("customerID=$customer_id")->toArray();
         if (! empty($check)) {
            return TRUE;
        }
        return FALSE;
    }

    function newCart($customer_id){
        $data = array('customerID' => $customer_id);

        $this->insert($data);
    }

    function getCartID($customer_id) {

        $db = Zend_Db_Table::getDefaultAdapter(); //set in config file
        $select = new Zend_Db_Select($db);

        $select->from('cart',array('cartID'))
                ->joinLeft('order_history', 'cart.cartID = order_history.order_id',array())
                ->where("order_history.order_status_id IS NULL AND cart.customerID = $customer_id ");
        $result = $db->fetchAll($select);
        return $result;
    }

}

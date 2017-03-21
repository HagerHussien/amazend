<?php

class Application_Model_Cart extends Zend_Db_Table_Abstract
{
    protected $_name = 'cart';
    
    function functionName($param) {
        
    }
    
    function cartDetails($cart_id) {
        return $this->find("cartID=$cart_id")->toArray()[0];
    }

}


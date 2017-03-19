<?php

class Application_Model_Wishlist extends Zend_Db_Table_Abstract
{
    protected $_name = 'wishlist';
    
    function userWishlist($customer_id) {
        // rerurn all items in user wishlist
        return $this->fetchAll("customerID=$customer_id")->toArray();
    }
    
    function deleteItem($customer_id,$prod_id) {
        //check for item existenxe before deletion
        if ($this->checkExistence($customer_id, $prod_id)) {
            $this->delete(array("productID=$prod_id","customerID=$customer_id"));
            return TRUE;
        }
            return FALSE;
    }
    
    function checkExistence($customer_id,$prod_id) {
        $check = $this->find($customer_id,$prod_id)->toArray();
         if (!empty($check)) {
            return TRUE;
        }
        return FALSE;
    }

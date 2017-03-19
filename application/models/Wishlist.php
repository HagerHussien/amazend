<?php

class Application_Model_Wishlist extends Zend_Db_Table_Abstract
{
    protected $_name = 'product_wishlist';
    
    function userWishlist($wishlist_id) {
        // rerurn all items in user wishlist
        return $this->fetchAll("wishlistID=$wishlist_id")->toArray();
    }
    
    function deleteItem($prod_id,$wish_id) {
        //check for item existenxe before deletion
        $check = $this->find($prod_id,$wish_id)->toArray();
        if (!empty($check)) {
            $this->delete(array("productID=$prod_id","wishlistID=$wish_id"));
            return TRUE;
        }
        else{
            return FALSE;
        }
        
    }
            
}


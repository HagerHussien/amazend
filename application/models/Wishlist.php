<?php

class Application_Model_Wishlist extends Zend_Db_Table_Abstract
{
    protected $_name = 'product_wishlist';
    
    function userWishlist($wishlist_id) {
        // rerurn all items in user wishlist
        return $this->fetchAll("wishlistID=$wishlist_id")->toArray();
    }
            
            
            
            
            
            
            
            

}


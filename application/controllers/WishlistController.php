<?php

class WishlistController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $wish_model = new Application_Model_Wishlist();
        $id=1;
        $user_wishlist=$wish_model->userWishlist($id);
        $prod_model = new Application_Model_Product();
        $prod_array=array();
        
        foreach ($user_wishlist as $key => $value) {
            if ($key == 'productID') {
                $prod_array[]=$prod_model->productDetails($value);
            }
        }
        
        $this->view->prodcut_array=$prod_array;
        
        $this->view->user_wishlist=$user_wishlist;
        
    }


}


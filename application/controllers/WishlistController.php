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
        
        
        $this->view->user_wishlist=$user_wishlist;
        
    }


}


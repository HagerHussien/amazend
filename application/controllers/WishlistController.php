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
        $id = 1;
        $user_wishlist = $wish_model->userWishlist($id);
        $prod_model = new Application_Model_Product();
        $prod_array = array();

        foreach ($user_wishlist as $key => $value) {
//            $push=$prod_model->productDetails($value["productID"]);
//            array_push($prod_array,$push);
            $prod_array[] = $prod_model->productDetails($value['productID']);
        }

        $this->view->prodcut_array = $prod_array;
        $this->view->user_wishlist = $user_wishlist;
    }

    public function addToWishAction()
    {
        $wish_model = new Application_Model_Wishlist();
        $wish_id = 1;
        $prod_id = 2;
        $check = $wish_model->find($prod_id, $wish_id)->toArray();
        if (!empty($check)) {
            echo "already added";
        } else {
            echo "add function";
            $row = $wish_model->createRow();
            $row->productID = $prod_id;
            $row->wishlistID = $wish_id;
            $row->save();
        }
    }

    public function deleteItemAction()
    {
        $prod_id=$this->_request->getParam("pid");
        $wish_id = 1;
        $wish_model = new Application_Model_Wishlist();
        $isDeleted=$wish_model->deleteItem($prod_id,$wish_id);
        if ($isDeleted) {
            $success_msg="Item removed successfully";
        }
        else{
            $success_msg="Item already removed from your wishlist";
        }
    }


}



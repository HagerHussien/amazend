<?php

class CheckoutController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        
    }

    public function cartAction()
    {
        $cust_id = 2;
        $cart_model = new Application_Model_Cart();
        $cart= $cart_model;
        
        $db = Zend_Db_Table::getDefaultAdapter(); //set in config file
        $select = new Zend_Db_Select($db);
//        $select->from('product', array('id', 'title')) //the array specifies which columns I want returned in my result set
        $select->from('cart',array('cartID','customerID')) //the array specifies which columns I want returned in my result set
                 //by specifying an empty array, I am saying that I don't care about the columns from this table
                ->joinInner('cart_product', 'cart.cartID = cart_product.cartID')
                
                ->joinInner('product', 'product.productID=cart_product.productID')
                
                ->joinLeft('order_history', 'order_history.order_id=cart.cartID',array())
                
                ->joinLeft('offer', 'offer.productID=product.productID',array('precent','end'))
                
                ->where("customerID = $cust_id")
                ->where('order_history.order_status_id IS NULL');
        $resultSet = $db->fetchAll($select);
        $this->view->cart=$resultSet;
        
        //get coupon
        
        $coupon_name = $this->_request->getParam("coup");
        if (isset($coupon_name)) {
            $coupon_model = new Application_Model_Coupon();
            $coupon_value = $coupon_model->getCouponValue($coupon_name);
            $this->view->coupon_value=$coupon_value;
        }
        
    }


}




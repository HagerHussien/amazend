<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // display all products at home page
        $product_model = new Application_Model_Product();
        $this->view->products = $product_model->listProducts();

    }

    public function productAction()
    {
        $product_model = new Application_Model_Product();
        $prod_id = $this->_request->getParam("pid");
        $product = $product_model->productDetails($prod_id);
        $this->view->product = $product;
    }


}



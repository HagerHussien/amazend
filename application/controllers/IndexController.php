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


}

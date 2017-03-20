<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // display all products at home page
        $product_model = new Application_Model_Product();
        $this->view->products = $product_model->listProducts();
    }

    public function productAction() {
        $product_model = new Application_Model_Product();
        $prod_id = $this->_request->getParam("pid");
        if ($prod_id == NULL){
            return $this->redirect('index');
        }
        $product = $product_model->productDetails($prod_id);
        $this->view->product = $product;

        $db = Zend_Db_Table::getDefaultAdapter(); //set in config file
        $select = new Zend_Db_Select($db);
//        $select->from('product', array('id', 'title')) //the array specifies which columns I want returned in my result set
        $select->from('product') //the array specifies which columns I want returned in my result set
                ->joinInner('category', 'product.categoryID = category.categoryID') //by specifying an empty array, I am saying that I don't care about the columns from this table
//                        'category', 'groups.id = category.categoryID', array()) //by specifying an empty array, I am saying that I don't care about the columns from this table
                        
                ->where("productID = $prod_id");
        $resultSet = $db->fetchAll($select);
        $this->view->pr=$resultSet;
    }

}

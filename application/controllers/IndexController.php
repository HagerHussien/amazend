<?php

class IndexController extends Zend_Controller_Action {

    public $language = null;

    public function init() {
        $request = $this->getRequest()->getParam('ln');
        //echo $request;
        if (empty($request)) {
            $this->language = new Zend_Session_Namespace('language');
            $this->language->type = isset($this->language->type) ? $this->language->type : "En";
        } else {
            $this->language = new Zend_Session_Namespace('language');
            $this->language->type = $request;
            // echo $this->language->type;
        }

        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $userData = $storage->read();

        $person = (array) $userData;
        //either shopperID or customerID
        $personKey = key($person);
        $userType = new Zend_Session_Namespace('userType');
        $userType->type = $personKey;
    }

    public function indexAction() {
// display all products at home page
        $product_model = new Application_Model_Product();
        $category_model = new Application_Model_Category();
        $categories = new Zend_Session_Namespace('category');
        $categories->cat = $category_model->listCat();
        $this->view->slider_products = $product_model->maxPurchased();
        $this->view->products = $product_model->listProducts();
        $this->view->language = $this->language->type;
    }

    public function productAction() {
//        $product_model = new Application_Model_Product();
        $prod_id = $this->_request->getParam("pid");
        if ($prod_id == NULL) {
            return $this->redirect('index');
        }
//        $product = $product_model->productDetails($prod_id);
//        $this->view->product = $product;

        $db = Zend_Db_Table::getDefaultAdapter(); //set in config file
        $select = new Zend_Db_Select($db);
//        $select->from('product', array('id', 'title')) //the array specifies which columns I want returned in my result set
        $select->from('product') //the array specifies which columns I want returned in my result set
                ->joinInner('category', 'product.categoryID = category.categoryID') //by specifying an empty array, I am saying that I don't care about the columns from this table
//                        'category', 'groups.id = category.categoryID', array()) //by specifying an empty array, I am saying that I don't care about the columns from this table
                ->where("productID = $prod_id");
        $resultSet = $db->fetchAll($select);
        $this->view->product = $resultSet[0];
        $this->view->language = $this->language->type;


// comment part
        $comment_form = new Application_Form_CommentForm();
        $comment_model = new Application_Model_Comment();

        $this->view->comment_form = $comment_form;
        $comment_customerID = 1;
        $comment_productID = 1;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($comment_form->isValid($request->getPost())) {
                $commentdata['comment_body'] = $comment_form->getValue('comment_body');
                $commentdata['comment_date'] = '2017-03-15 00:00:00'; //new Zend_Date();//new Zend_Date::now(); "2017-03-14";
                $commentdata['comment_productID'] = $comment_productID;
                $commentdata['comment_customerID'] = $comment_customerID;
                $comment_model->addNewComment($commentdata);
//$this->redirect('/home/listcomments');
            }
        }
//$comment_model = new Application_Model_Comment();
        $this->view->comments = $comment_model->listComments();
    }

    public function displayCommentAction() {
        $comment_form = new Application_Form_CommentForm();
        $comment_model = new Application_Model_Comment();

        $this->view->comment_form = $comment_form;
        $comment_customerID = 1;
        $comment_productID = 1;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($comment_form->isValid($request->getPost())) {
                $commentdata['comment_body'] = $comment_form->getValue('comment_body');
                $commentdata['comment_date'] = '2017-03-15 00:00:00'; //new Zend_Date();//new Zend_Date::now(); "2017-03-14";
                $commentdata['comment_productID'] = $comment_productID;
                $commentdata['comment_customerID'] = $comment_customerID;
                $comment_model->addNewComment($commentdata);
//$this->redirect('/home/listcomments');
            }
        }
//$comment_model = new Application_Model_Comment();
        $this->view->comments = $comment_model->listComments();
    }

    public function categoryAction() {
        $product_model = new Application_Model_Product();
        $category_id = $this->_request->getParam('cid');
        $this->view->cat_top = $product_model->topProduct($category_id);
        $this->view->cat_details = $product_model->category_products($category_id);
    }

    public function searchAction() {
        // action body
        $product_model = new Application_Model_Product();
        $product_name = $this->_request->getParam('name');
        $search_details = $product_model->productSearch($product_name);
        $page = $search_details[0]['productID'];
        return $this->redirect("/index/product/pid/$page");
    }

}

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

        // comment part
        $comment_form = new Application_Form_CommentForm();
        $comment_model = new Application_Model_Comment();

        $this->view->comment_form = $comment_form ;
        $comment_customerID=1;
        $comment_productID =1;

        $request = $this->getRequest();
        if($request->isPost()){
            if($comment_form->isValid($request->getPost())){
                $commentdata['comment_body']=$comment_form->getValue('comment_body');
                $commentdata['comment_date']= '2017-03-15 00:00:00';//new Zend_Date();//new Zend_Date::now(); "2017-03-14";
                $commentdata['comment_productID']=$comment_productID;
                $commentdata['comment_customerID']=$comment_customerID;
                $comment_model->addNewComment($commentdata);
                //$this->redirect('/home/listcomments');
            }
        }
        //$comment_model = new Application_Model_Comment();
        $this->view->comments = $comment_model->listComments();
    }

    public function displayCommentAction()
    {
        $comment_form = new Application_Form_CommentForm();
        $comment_model = new Application_Model_Comment();

        $this->view->comment_form = $comment_form ;
        $comment_customerID=1;
        $comment_productID =1;

        $request = $this->getRequest();
        if($request->isPost()){
            if($comment_form->isValid($request->getPost())){
                $commentdata['comment_body']=$comment_form->getValue('comment_body');
                $commentdata['comment_date']= '2017-03-15 00:00:00';//new Zend_Date();//new Zend_Date::now(); "2017-03-14";
                $commentdata['comment_productID']=$comment_productID;
                $commentdata['comment_customerID']=$comment_customerID;
                $comment_model->addNewComment($commentdata);
                //$this->redirect('/home/listcomments');
            }
        }
        //$comment_model = new Application_Model_Comment();
        $this->view->comments = $comment_model->listComments();
    }

}

<?php

class CustomerController extends Zend_Controller_Action
{
  public $language;
  public function init()
  {
      $request= $this->getRequest()->getParam('ln');
      //echo $request;      if(empty($request)){
          $lan = new Zend_Session_Namespace('language');
          $this->language->type = $lan->type ;
          // echo $this->language->type;
      }
      else{
          $this->language= new Zend_Session_Namespace('language');
          $this->language->type = $request ;
          // echo $this->language->type;
      }

        // $auth = Zend_Auth::getInstance();
        // $requestActionName = $this->getRequest()->getActionName();
        // if (!$auth->hasIdentity() && $requestActionName!= 'login' && $requestActionName!= 'add')
        // {
        //     $this->redirect("customer/login");
        // }
        // if ($auth->hasIdentity() && $requestActionName= 'login' )
        // {
        //     $this->redirect("/index");
        // }
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        //authentiation to be done

        $form = new Application_Form_CustomerLogin();
        $request = $this->getRequest();
        if ($request->isPost()) {
        if ($form->isValid($request->getPost( ))) {
            // after check for validation get email and password to start auth
        $email = $request->getParam('email');
        $password = $request->getParam('password');
        /********* Authentication Steps ******/
        // step 1
        //we get object of ZendDbAdapter to know which database we connect on
        $db = Zend_Db_Table::getDefaultAdapter( );
        //step 2
        // define object of ZendAuthAdapter with paramters
        // (ZendDbAdapter Object, table name , identity column , credential column)
        $authAdapter = new Zend_Auth_Adapter_DbTable($db,'customer','email','password');
        //step 3
        //set the identity column value and credential column value
        $authAdapter->setIdentity($email);
        $authAdapter->setCredential($password);
        //step 4
        //perform authentication
        $result = $authAdapter->authenticate( );
        //step 5
        // check if authentication is valid
        if ($result->isValid( )) {
                /********* Session Steps ******/
            //session step 1
            // get object from ZendAuth Class
            $auth = Zend_Auth::getInstance();
            //session step 2
            // get storage to write session on it
            $storage = $auth->getStorage();
            // session step 3
            //write values to session (by default it’s written to Zend_Auth namespace)
            $storage->write($authAdapter->getResultRowObject(array('customerID', 'email','EnName')));
            // redirect to root index/index
            return $this->redirect('/index');
        }
        else {
            // if user is not valid send error message to view
            $this->view->error_message = "Invalid Email or Password!";
        }
        }
        }

            $this->view->form = $form;

    }

    public function addAction()
    {
        $form = new Application_Form_CustomerSignup();
        //$this->view->customerSignup=$form;

        $request = $this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getParams()))
            {
                $customerModel = new Application_Model_Customer();
                $customerModel->addNewCustomer($request->getPost());
                //to be changed
                $this->redirect('/customer/login');

            }
        }
        $this->view->form = $form;
    }

    public function deleteItemAction()
    {
        $prod_id=$this->_request->getParam("pid");
        $customer_id = 1;
        $wish_model = new Application_Model_Wishlist();
        $isDeleted=$wish_model->deleteItem($customer_id,$prod_id);
        if ($isDeleted) {
            $success_msg="Item removed successfully";
        }
        else{
            $success_msg="Item already removed from your wishlist";
        }
    }

    public function myWishListAction()
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
//        $this->view->user_wishlist = $user_wishlist;
    }

    public function addToCartAction()
    {
    }

    public function addPtoductToCartAction()
    {
      echo "hassssssssssssan";
    }

    public function addcartAction()
    {
        $customer_id = 1;
        $cart_model = new Application_Model_Cart();
        $cart_product_model = new Application_Model_CartProduct();
        //$product_id = $this->_request->getParam('pid');
        $product_id= 1;
        $check_result = $cart_model->checkExistence(1);
        echo $check_result;
        if($check_result){  // this customer already have cart
          echo "this customer already have cart";
            $cart_id = $cart_model->getCartID($customer_id);

            $cart_id = $cart_model->getCartID($customer_id);
            if($cart_product_model->checkExistence($product_id)){
                //echo "already added";
                //alert('laaaaaaaaaaa');
                //$this->entityManager->flush();
              $this->redirect("/Index/product/pid/$product_id");
            }else{
                $cart_product_model->addNewItemToCart($cart_id,$product_id,1);
                $this->redirect("/Index/product/pid/$product_id");
            }
        }else{
          echo "this customer already have no  cart";
          echo $check_result;


            $cart_model->newCart($customer_id);
            $cart_id = $cart_model->getCartID($customer_id);
            if($cart_product_model->checkExistence($product_id)){
                //echo "already added";

                $this->redirect("/Index/product/pid/$product_id");
            }else{
                $cart_product_model->addNewItemToCart($cart_id,$product_id,1);
                $this->redirect("/Index/product/pid/$product_id");
            }

        }

    }

    public function logoutAction()
    {

        $auth=Zend_Auth::getInstance();
        $auth->clearIdentity();
        // $userType->type = NULL;
         Zend_Session::namespaceUnset('userType');
         $this->redirect('/Customer/login');

    }

    public function maiAction()
    {
        // action body
    }

    public function addwishAction()
    {
        $wish_model = new Application_Model_Wishlist();
        $customer_id = 1;
        //$prod_id = 2;
        $product_id = $this->_request->getParam('pid');
        if ($wish_model->checkExistence($customer_id, $product_id)) {

            $this->view->form = "added before";
        } else {
            $wish_model->addToWish($customer_id,$product_id);
            $this->redirect("/index/product/pid/$product_id");
        }
    }


}

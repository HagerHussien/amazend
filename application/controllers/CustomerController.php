<?php

class CustomerController extends Zend_Controller_Action {

    public $language;

    public function init() {
        //Session to be opened
        $loginSession = new Zend_Session_Namespace('user');

        //facebook session

        $fpsession = new Zend_Session_Namespace('facebook');

        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $userData = $storage->read();
        $person = (array) $userData;
        //either shopperID or customerID
        $personKey = key($person);
        if ($personKey != "customerID" && $personKey != "") {
            $this->redirect("/index");
        }
        // var_dump($personKey);
        // die();


        $requestActionName = $this->getRequest()->getActionName();

        // var_dump($this->getRequest()->getActionName() );
        // die();
        // if (!$auth->hasIdentity() && $requestActionName!= 'login' && $requestActionName!= 'add')
        // {
        //     $this->redirect("customer/login");
        // }
        // if ($auth->hasIdentity() && $requestActionName= 'login' )
        // {
        //     $this->redirect("/index");
        // }
        // if ($auth->hasIdentity() && $requestActionName= 'logout' )
        // {
        //     $this->redirect("/customer/logout");
        // }


        if (!$auth->hasIdentity() && ($this->getRequest()->getActionName() != 'login') &&
                ($this->getRequest()->getActionName() != 'add')) {
            $this->redirect("customer/login");
        }



        if ($auth->hasIdentity() && ((($this->getRequest()->getActionName() == 'login')) || (($this->getRequest()->getActionName() == 'add')))) {
            $this->redirect("/index");
        }



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

    public function indexAction() {
        // action body
        $this->redirect('/customer/my-wish-list');
    }

    public function loginAction() {
        //authentiation to be done
        $auth = Zend_Auth::getInstance();
        $request = $this->getRequest();
        $actionName = $request->getActionName();

        if ($auth->hasIdentity() && $actionName == 'login') {
            $this->redirect('/index');
        }
        if (!$auth->hasIdentity() && $actionName != 'login') {
            $this->redirect('/customer/login');
        }

        //login

        $form = new Application_Form_CustomerLogin();
        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                // after check for validation get email and password to start auth
                $email = $request->getParam('email');
                $password = $request->getParam('password');
                /*                 * ******* Authentication Steps ***** */
                // step 1
                //we get object of ZendDbAdapter to know which database we connect on
                $db = Zend_Db_Table::getDefaultAdapter();
                //step 2
                // define object of ZendAuthAdapter with paramters
                // (ZendDbAdapter Object, table name , identity column , credential column)
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'customer', 'email', 'password');
                //step 3
                //set the identity column value and credential column value
                $authAdapter->setIdentity($email);
                $authAdapter->setCredential($password);
                //step 4
                //perform authentication
                $result = $authAdapter->authenticate();
                //step 5
                // check if authentication is valid
                if ($result->isValid()) {
                    /*                     * ******* Session Steps ***** */


//check if blocked
                    $user_status = (array) $authAdapter->getResultRowObject(array('customerID', 'email', 'EnName', 'status'));
                    if ($user_status['status'] == "blocked") {
                        $blocked_status = "You are Blocked. Contact the adminstrator";
// $this->view->blocked_status=$blocked_status;
                        $this->redirect('/customer/login');
                    }//session step 1
                    // get object from ZendAuth Class
                    $auth = Zend_Auth::getInstance();
                    //session step 2
                    // get storage to write session on it
                    $storage = $auth->getStorage();
                    // session step 3
                    //write values to session (by default it’s written to Zend_Auth namespace)
                    $storage->write($authAdapter->getResultRowObject(array('customerID', 'email', 'EnName')));

                    // //Session to be opened
                    // $loginSession = new Zend_Session_Namespace('user');
//                    $loginSession->user = $authAdapter->getResultRowObject(array('customerID', 'email', 'EnName'));
                    // redirect to root index/index
                    return $this->redirect('/index');
                } else {
                    // if user is not valid send error message to view
                    $this->view->error_message = "Invalid Email or Password!";
                }
            }
        }

        $this->view->form = $form;

        //Facebook button
        $fb = new Facebook\Facebook([
            'app_id' => '1769107093406339', // Replace {app-id} with your app id
            'app_secret' => '39eba50bb7e6bbcc985a87f47656e7d4',
            'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $loginUrl = $helper->getLoginUrl($this->view->serverUrl() .
                '/customer/fp-auth-action');
        $this->view->facebook_url = $loginUrl;
    }

    public function addAction() {
        $form = new Application_Form_CustomerSignup();
        //$this->view->customerSignup=$form;

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getParams())) {
                $customerModel = new Application_Model_Customer();
                $customerModel->addNewCustomer($request->getPost());
                //to be changed
                $this->redirect('/customer/login');
            }
        }
        $this->view->form = $form;
    }

    public function deleteItemAction() {
        $userData = Zend_Auth::getInstance()->getStorage()->read();
        $person = (array) $userData;
        $prod_id = $this->_request->getParam("pid");
        $customer_id = $person['customerID'];
        $wish_model = new Application_Model_Wishlist();
        $isDeleted = $wish_model->deleteItem($customer_id, $prod_id);
        if ($isDeleted) {
            $success_msg = "Item removed successfully";
            $this->redirect('/customer/my-wish-list');
        } else {
            $success_msg = "Item already removed from your wishlist";
        }
    }

    public function myWishListAction() {
        $userData = Zend_Auth::getInstance()->getStorage()->read();
        $person = (array) $userData;
        $wish_model = new Application_Model_Wishlist();
        $id = $person['customerID'];
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

    public function addToCartAction() {

    }

    public function addPtoductToCartAction() {
        echo "hassssssssssssan";
    }

    public function addcartAction() {
        $userData = Zend_Auth::getInstance()->getStorage()->read();
        $person = (array) $userData;
        $customer_id = $person['customerID'];
        $customer_email = $person['email'];
        $cart_model = new Application_Model_Cart();
        $cart_product_model = new Application_Model_CartProduct();
        $product_model = new Application_Model_Product();
        if (null == ($this->_request->getParam('pid'))) {
            $this->redirect('/checkout/cart');
        }

        $product_id = $this->_request->getParam('pid');
        $cart_id = $cart_model->getCartID($customer_id);
        if (empty($cart_id)) {
            $cart_model->newCart($customer_id, $customer_email);
            $cart_id = $cart_model->getCartID($customer_id);
        }
        $cartID = $cart_id[0]['cartID'];
        $check = $cart_product_model->checkExistence($cartID, $product_id);
        if ($check) {
            $product_price = $product_model->prouduct_price($product_id);
            $product_price = $product_price[0]['price'];
            $cart_product_model->addNewItemToCart($cartID, $product_id, 1, $product_price, $product_price);
        }
        $this->redirect("/Index/product/pid/$product_id");
    }

    public function logoutAction() {
        //Zend_Session::destroy();
        // $this->_helper->redirector('index', 'index');

        Zend_Session::namespaceUnset('user');
        Zend_Session::namespaceUnset('facebook');
        Zend_Session::namespaceUnset('userType');
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->redirect('/customer/login');
        // $userType->type = NULL;
        // $this->redirect('/customer/login');
    }

    public function addwishAction() {
        $userData = Zend_Auth::getInstance()->getStorage()->read();
        $person = (array) $userData;
        $wish_model = new Application_Model_Wishlist();
        $customer_id = $person['customerID'];
        //$prod_id = 2;
        $product_id = $this->_request->getParam('pid');
        if ($wish_model->checkExistence($customer_id, $product_id)) {

            $this->view->form = "added before";
        } else {
            $wish_model->addToWish($customer_id, $product_id);
            $this->redirect("/index/product/pid/$product_id");
        }
    }

    public function fpAuthActionAction() {
        var_dump("Hello");
        die();
        // define
        //instance from facebook
        $fb = new Facebook\Facebook([
            'app_id' => '1769107093406339', // Replace {app-id} with your app id
            'app_secret ' => '39eba50bb7e6bbcc985a87f47656e7d4',
            'default_graph_version ' => 'v2.2',
        ]);
        // use helper method of facebook for login
        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error (headers link)
            echo 'Graph returned an error: ' . $e->getMessage();
            Exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            Exit;
        }
        // handle access token & print full error message
        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() .
                "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            Exit;
        }
        // Logged in
        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        //check if access token expired
        if (!$accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                // try to get another access token
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " .
                $helper->getMessage() . "</p>\n\n";
                Exit;
            }
        }
        //Sets the default fallback access token so we don't have to pass it to each request
        $fb->setDefaultAccessToken($accessToken);
        try {
            $response = $fb->get('/me');
            $userNode = $response->getGraphUser();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            Exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            Exit;
        }

        // //facebook session
        // $fpsession = new Zend_Session_Namespace('facebook');
        // write in session email & id & first_name
        $fpsession->first_name = $userNode->getName();
        // var_dump($userNode->getName());
        // die();


        $this->redirect('/index');
    }

    public function fblogoutActionAction() {
        Zend_Session::namespaceUnset('facebook');
        $this->redirect("/index");
    }

    public function fbloginAction() {
        //Facebook button
        $fb = new Facebook\Facebook([
            'app_id' => '1769107093406339', // Replace {app-id} with your app id
            'app_secret' => '39eba50bb7e6bbcc985a87f47656e7d4',
            'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $loginUrl = $helper->getLoginUrl($this->view->serverUrl() .
                '/customer/fp-auth-action');
        $this->view->facebook_url = $loginUrl;
        // $this->view->facebookUrl = '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
        $this->view->facebookUrl = '<a href="' . htmlspecialchars($loginUrl) . '"> <img src="/img/fblogin-btn.png"></img></a>';
    }

    public function addrateAction() {
//        if($this->getRequest()->)
        //header('Access-Control-Allow-Origin: *');
        // $ajaxContext = $this->_helper->getHelper('AjaxContext');
        // $ajaxContext->addActionContext('addrate', 'json')
        //     ->initContext();
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        // $rate = 50;
        // $product_id = 1;
        //explode($_POST);
        $rate = $this->getRequest()->getParam('rate');
        $product_id = $this->getRequest()->getParam('product_id');
        // var_dump($product_id);
        // var_dump($rate);
        // die();
        echo $rate . "and prod id=" . $product_id;
        $product_model = new Application_Model_Product();
        $product_model->addRate($product_id, $rate);
    }

}

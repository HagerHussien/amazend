<?php

class CustomerController extends Zend_Controller_Action
{

    public function init()
    {
        /*$auth = Zend_Auth::getInstance();
        $requestActionName = $this->getRequest()->getActionName();
        if (!$auth->hasIdentity() && $requestActionName!= 'login' &&
        $requestActionName!= 'add') {
        $this->redirect("customer/login"); }*/
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
        $authAdapter->setCredential(md5($password));
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
            $storage->write($authAdapter->getResultRowObject(array('email', 'id','EnName')));
            // redirect to root index/index
            return $this->redirect('customer');
        }
        else {
            // if user is not valid send error message to view
            $this->view->error_message = "Invalid Email or Password!";
        }
        }
        }

            $this->view->form = $form;
        
    }
    
    //=====================================================
    //list action not auto implemented
    //===============================================
    //add action also
    public function addAction()
    {
        $form = new Application_Form_CustomerSignup();
        $this->view->customerSignup=$form;
        
        $request = $this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getParams()))
            {
                $customerModel = new Application_Model_Customer();
                $customerModel->addNewCustomer($request->getPost());
                //to be changed
                $this->redirect('/index');
                
            }
        }
         $this->view->form = $form;
    }


}






<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body

    	$users = new Users();
		$form = new LoginForm();
		$this->view->form = $form;
		if($this->getRequest()->isPost()){
		if($form->isValid($_POST)){
		$data = $form->getValues();
		$auth = Zend_Auth::getInstance();
		$authAdapter = new Zend_Auth_Adapter_DbTable($users->getAdapter(),'Users');
		$authAdapter->setIdentityColumn('username')
		->setCredentialColumn('password');
		$authAdapter->setIdentity($data['username'])
		->setCredential($data['password']);
		$result = $auth->authenticate($authAdapter);
		if($result->isValid()){
		$storage = new Zend_Auth_Storage_Session();
		$storage->write($authAdapter->getResultRowObject());
		$this->_redirect('index/home');
		} else {
		$this->view->errorMessage = "Invalid username or password. Please try again.";
		}
		}
		}





    }


}


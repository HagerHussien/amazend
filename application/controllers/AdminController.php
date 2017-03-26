<?php


// require_once 'Zend/Mail.php';
 
// Create transport
//require_once 'Zend/Mail/Transport/Smtp.php';

class AdminController extends Zend_Controller_Action {

    public function init() {
        // //Session to be opened
        $loginSession = new Zend_Session_Namespace('user');
         $layout = $this->_helper->layout();
        $layout->setLayout('admlayout');

        if (!$auth->hasIdentity() && ($this->getRequest()->getActionName() != 'login') &&
        ($this->getRequest()->getActionName() != 'add'))
        {
            $this->redirect("admin/login");
        }

        
        if ($auth->hasIdentity() && ((($this->getRequest()->getActionName() == 'login')) || (($this->getRequest()->getActionName() == 'add'))) )
        {
            $this->redirect("/index");
        }


    }

    public function indexAction() {
        // action body
    }

    public function adminAction()
    {
        // action body
    }

    public function addCategoryAction() {
        // action body
        $form = new Application_Form_AddCat();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $catID = $form->getValue('categoryID');
                $cat_EnName = $form->getValue('cat_EnName');
                $cat_ArName = $form->getValue('cat_ArName');
                $adminID = $form->getValue('adminID');
                $row = new Application_Model_Category();
                $row->addCat($catID, $cat_EnName, $cat_ArName, $adminID);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function deleteCategoryAction() {
        // action body
        $cat_model = new Application_Model_Category();
        $cat_id = $this->_request->getParam("cid");
        $cat_model->deleteCat($cat_id);
        $this->_helper->redirector('index');
    }

    public function editCategoryAction()
    {
        // action body
        $form = new Application_Form_AddCat();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $catID = $form->getValue('categoryID');
                $EnName = $form->getValue('cat_EnName');
                $ArName = $form->getValue('cat_ArName');
                $adminID = $form->getValue('adminID');
                $edit = new Application_Model_Category();
                $edit->updateCat($catID, $EnName, $ArName, $adminID);
                $this->_helper->redirector('index');
               }
            else {
                $form->populate($formData);
            }
        } else {
            $catID = $this->_getParam('cid', 0);
            if ($catID > 0) {
                $cat = new Application_Model_Category();
                $form->populate($cat->getCat($catID));
            }
        }
    }

    public function createCouponAction() {
        // action body

        $form = new Application_Form_CreateCoupon();
        $form->submit->setLabel('CREATE');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $couponID = $form->getValue('couponID');
                $name = $form->getValue('name');
                $percent = $form->getValue('percent');
                $row = new Application_Model_Coupon();
                $row->CreateCoupon($couponID, $name, $percent);
                $this->_helper->redirector('index');
            }
            else {
                $form->populate($formData);
            }
        }

    }

    public function sendCouponAction() {

        $coupon_model = new Application_Model_Coupon();
        $coupon_user = new Application_Model_Customer ();
        $coupon_id = $this->_request->getParam("id");
        $this->view->coupon = $coupon_id;
    }

    public function sendEmailAction() {
        // action body

        $coupon_model = new Application_Model_Coupon();
        $coupon_user = new  Application_Model_Customer ();
        $user_email = $this->_request->getParam("email");
        $user_name = $this->_request->getParam("name");
        $coupon_id = $this->_request->getParam("cid");
        $coupon = $coupon_model->getCoupon($coupon_id);

        $tr = new Zend_Mail_Transport_Smtp('smtp.gmail.com', array('auth' => 'login',
            'port' => 587,
            'ssl' => 'tls',
            'username' => 'amazend.zendphp@gmail.com',
            'password' => 'amazendzendphp'));
        Zend_Mail::setDefaultTransport($tr);

        $mail = new Zend_Mail();
        $mail->setFrom('amazend.zendphp@gmail.com');
        
        $mail->setBodyHtml('<p>Hello  '. $user_name .' </p>
<p>We have made a discount for you with amount of '. $coupon['percent'] .' % for the upcoming purchase Order.</p>
<p> write this in discount field when purchasing next time </p>
' . $coupon['name'] . '');

        $mail->addTo($user_email, 'recipient');
        $mail->setSubject('Discount coupon');
        $mail->send($tr);

        $this->redirect('admin/send-coupon/id/' . $coupon_id);
    }

    public function blockAction() {
        // action body

        $cast_model = new Application_Model_Customer();
        $cast_id = $this->_request->getParam("id");
        $user = $cast_model->customerDetails($cast_id);


        if ($user['status'] === 'unblocked') {
            $status = 'blocked';
            $cast_model->updateCustomer($cast_id, $status);
            $this->_helper->redirector('index');
        } else {

            $status = 'unblocked';
            $cast_model->updateCustomer($cast_id, $status);
            $this->_helper->redirector('index');
        }

    }

    public function deletecouponAction() {
        // action body

        $coupon_model = new Application_Model_Coupon();
        $coupon_id = $this->_request->getParam("id");
        $coupon_model->deleteCoupon($coupon_id);
        $this->_helper->redirector('index');
    }   

    public function addAction()
    {
        $form = new Application_Form_Admin();
        //$this->view->admin=$form;

        $request = $this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getParams()))
            {
                $adminModel = new Application_Model_Admin();
                $adminModel->addNewAdmin($request->getPost());
                //to be changed
                $this->redirect('/admin/login');

            }
        }
         $this->view->form = $form;
    }

    public function loginAction()
    {
        //authentiation to be done

        $form = new Application_Form_AdminLogin();
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
        $authAdapter = new Zend_Auth_Adapter_DbTable($db,'admin','email','password');
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
            $storage->write($authAdapter->getResultRowObject(array('adminID','email','EnName')));

            // //Session to be opened
            // $loginSession = new Zend_Session_Namespace('user');

            $loginSession ->user = $authAdapter->getResultRowObject(array('adminID', 'email','EnName'));

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


}























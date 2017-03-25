<?php


// require_once 'Zend/Mail.php';
 
// Create transport
//require_once 'Zend/Mail/Transport/Smtp.php';

class AdminController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
         $layout = $this->_helper->layout();
        $layout->setLayout('admlayout');
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

}



















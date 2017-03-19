<?php


 require_once 'Zend/Mail.php';
 
// Create transport
require_once 'Zend/Mail/Transport/Smtp.php';

class AdminController extends Zend_Controller_Action
{

    //use Zend\Mail;



    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function adminAction()
    {
        // action body
    }

    public function addCategoryAction()
    {
        // action body
        $form = new Application_Form_AddCat();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $catID = $form->getValue('categoryID');
                $EnName = $form->getValue('EnName');
                $ArName = $form->getValue('ArName');
                $adminID = $form->getValue('adminID');
                $row = new Application_Model_Category();
                $row->addCat($catID,$EnName,$ArName,$adminID);
                $this->_helper->redirector('index');
            }
            else {
                $form->populate($formData);
            }
        }
    }

    public function deleteCategoryAction()
    {
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
                $EnName = $form->getValue('EnName');
                $ArName = $form->getValue('ArName');
                $adminID = $form->getValue('adminID');
                $edit = new Application_Model_Category();
                $edit->updateCat($catID,$EnName,$ArName,$adminID);
                $this->_helper->redirector('index');
               }
            else {
                $form->populate($formData);
                }
         }
        else {
            $catID = $this->_getParam('cid', 0);
            if ($catID > 0) {
            $cat = new  Application_Model_Category();
            $form->populate($cat->getCat($catID));
            }
         }

    }

    public function createCouponAction()
    {
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
                $row->CreateCoupon($couponID,$name,$percent);
                $this->_helper->redirector('index');
            }
            else {
                $form->populate($formData);
            }
        }

    }

    public function sendCouponAction()
    {

        $tr = new Zend_Mail_Transport_Smtp('smtp.gmail.com',
                     array('auth' => 'login',
                        'port' => 587,
                        'ssl' => 'tls',
                             'username' => 'amazend.zendphp@gmail.com',
                             'password' => 'amazendzendphp'));
        Zend_Mail::setDefaultTransport($tr);

        $mail = new Zend_Mail();
        $mail->setFrom('hager.hussien.osman@gmail.com');
        $mail->setBodyHtml('some message - it may be html formatted text');
        $mail->addTo('baghdadinoo@gmail.com', 'recipient');
        $mail->setSubject('subject');
        $mail->send($tr);


/*
$transport = new Zend_Mail_Transport_Smtp('localhost');

 
// Sending out multiple mails at once
for ($i = 0; $i > 5; $i++) {
    $mail = new Zend_Mail();
    $mail->addTo('hager.hussien.osman@gmail.com', 'Test');
    $mail->setFrom('studio@peptolab.com', 'Test');
    $mail->setSubject('Demonstration - Sending Multiple Mails per SMTP Connection');
    $mail->setBodyText('...Your message here...');
    $mail->send($transport); //Using the SMTP transport for sending the mail
    
}*/

   }
}













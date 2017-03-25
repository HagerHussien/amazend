<?php

class ProductController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        $form = new Application_Form_Product();
        
        
        $request = $this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getParams()))
            {
                if($form->photo->isUploaded()){
                //     var_dump();
                // die();
                    
                $photo =  array('photo' => $form->photo->getValue() );    
                $productModel = new Application_Model_Product();
                $prodID=$productModel->addNewProduct(array_merge($request->getPost(),$photo));
                 // var_dump($prodID);
                 // die();

                $offerModel = new Application_Model_Offer();
                $offerModel->addOffer($request->getPost(),$prodID);
                //to be changed
                $this->redirect('/index');
                }
                
                
            }
        }
         $this->view->form = $form;
    }


}




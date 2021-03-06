<?php

class ProductController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        
    }

    public function addAction() {
        $form = new Application_Form_Product();


        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getParams())) {
                if ($form->photo->isUploaded()) {
                    //     var_dump();
                    // die();

                    $photo = array('photo' => $form->photo->getValue());
                    $productModel = new Application_Model_Product();
                    $prodID = $productModel->addNewProduct(array_merge($request->getPost(), $photo));
                    // var_dump($prodID);
                    // die();

                    $offerModel = new Application_Model_Offer();
                    $offerModel->addOffer($request->getPost(), $prodID);
                    //to be changed
                    $this->redirect('/product');
                }
            }
        }
        $this->view->form = $form;
    }

    public function editAction() {
        // action body
        $form = new Application_Form_Product();

        $this->view->form = $form;

        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($form->isValid($request->getParams())) {
                if ($form->photo->isUploaded()) {
                    $photo = array('photo' => $form->photo->getValue());
                } else {
                    $photo = NULL;
                }
                $productModel = new Application_Model_Product();
                $post_data = $request->getPost();
                $product_data = array(
                    'productID' => $this->getParam('pid'),
                    'EnName' => $post_data['EnName'],
                    'ArName' => $post_data['ArName'],
                    'EnDescription' => $post_data['EnDescription'],
                    'ArDescription' => $post_data['ArDescription'],
                    'price' => $post_data['price'],
                    'categoryID' => $post_data['categoryID'],
                    'photo' => $photo
                );
                $prodID = $productModel->editProduct($product_data);
                $offer_data = array(
                    'start' => $post_data['start'],
                    'end' => $post_data['end'],
                    'precent' => $post_data['precent']
                );
                $offerModel = new Application_Model_Offer();
                $offerModel->editOffer($offer_data, $prodID);
                //to be changed
                $this->redirect('/product');
            } else {
                $form->populate($formData);
            }
        } else {
            $catID = $this->_getParam('pid', 0);
            if ($catID > 0) {
                $cat = new Application_Model_Product();
                $form->populate($cat->getProd($catID));
            }
        }
    }

    public function deleteAction() {
        // action body


        $prod_model = new Application_Model_Product();
        $prod_id = $this->_request->getParam("pid");
        $prod_model->deleteProd($prod_id);
        $this->_helper->redirector('index');
    }

}

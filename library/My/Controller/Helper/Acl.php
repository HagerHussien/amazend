<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acl
 *
 * @author mohamed
 */
class My_Controller_Helper_Acl {

	// public $acl;

 //    public function __construct(){
        
 //        $this->acl = new Zend_Acl();
 //    }

 //    public function setRoles() {
 //        $this->acl->addRole(new Zend_Acl_Role("guest"));
 //        $this->acl->addRole(new Zend_Acl_Role("customer"));
 //        $this->acl->addRole(new Zend_Acl_Role("shopper"));
 //        $this->acl->addRole(new Zend_Acl_Role("admin"));

 //        $this->acl->addRole(new Zend_Acl_Role(customer),'guest');
 //        $this->acl->addRole(new Zend_Acl_Role(shopper),'guest');
 //        $this->acl->addRole(new Zend_Acl_Role(admin),'guest');
 //        $this->acl->addRole(new Zend_Acl_Role(admin),'customer');
 //        $this->acl->addRole(new Zend_Acl_Role(admin),'shopper');
 //    }

 //    public function setResources() {
       
 //        //index

 //        $this->acl->add(new Zend_Acl_Resource('index'));
 //        $this->acl->add(new Zend_Acl_Resource('index'),'index');
 //        $this->acl->add(new Zend_Acl_Resource('prodcut'),'index');
 //        $this->acl->add(new Zend_Acl_Resource('displayComment'),'index');
 //        $this->acl->add(new Zend_Acl_Resource('category'),'index');
 //        $this->acl->add(new Zend_Acl_Resource('search'),'index');

 //        //product
 //        $this->acl->add(new Zend_Acl_Resource('product'));
 //        $this->acl->add(new Zend_Acl_Resource('add'),'product');

 //        //Checkout
 //        $this->acl->add(new Zend_Acl_Resource('checkout'));
 //        $this->acl->add(new Zend_Acl_Resource('cart'),'checkout');
        
 //    }

 //    public function setPrivileges() {
 //        // index priviliges
 //        $this->acl->allow('guest','index','index');
 //        $this->acl->allow('guest','index','product');
 //        $this->acl->allow('guest','index','displayComment');
 //        $this->acl->allow('guest','index','category');
 //        $this->acl->allow('guest','index','search');

 //        //priviliges
 //        $this->acl->allow('shopper','product','add');

 //        //priviliges
 //        $this->acl->allow('customer','checkout','cart');

 //    }

 //    public function setAcl()
 //    {
 //        Zend_Registry::set("acl", $this->acl);
 //    }
        
        // $this->addRole(new Zend_Acl_Role(guest));
        // $this->addRole(new Zend_Acl_Role(customer));
        // $this->addRole(new Zend_Acl_Role(shopper));
        // $this->addRole(new Zend_Acl_Role(admin));

        // $this->addRole(new Zend_Acl_Role(customer),'guest');
        // $this->addRole(new Zend_Acl_Role(shopper),'guest');
        // $this->addRole(new Zend_Acl_Role(admin),'guest');
        // $this->addRole(new Zend_Acl_Role(admin),'customer');
        // $this->addRole(new Zend_Acl_Role(admin),'shopper');

        // //index

        // $this->add(new Zend_Acl_Resource('index'));
        // $this->add(new Zend_Acl_Resource('index'),'index');
        // $this->add(new Zend_Acl_Resource('prodcut'),'index');
        // $this->add(new Zend_Acl_Resource('displayComment'),'index');
        // $this->add(new Zend_Acl_Resource('category'),'index');
        // $this->add(new Zend_Acl_Resource('search'),'index');

        // // index priviliges
        // $this->allow('guest','index','index');
        // $this->allow('guest','index','product');
        // $this->allow('guest','index','displayComment');
        // $this->allow('guest','index','category');
        // $this->allow('guest','index','search');


        // //product
        // $this->add(new Zend_Acl_Resource('product'));
        // $this->add(new Zend_Acl_Resource('add'),'product');

        //priviliges
        // $this->allow('shopper','product','add');

        // //Checkout
        // $this->add(new Zend_Acl_Resource('checkout'));
        // $this->add(new Zend_Acl_Resource('cart'),'checkout');

        //priviliges
        // $this->allow('customer','checkout','cart');

        






    // public $acl;
    
    // public function __construct() {
    //     $this->acl = new Zend_Acl();
    // }
    
    // public function setRoles() {
    //     $this->acl->addRole(new Zend_Acl_Role("guest"));
    //     $this->acl->addRole(new Zend_Acl_Role("customer"));
    //     $this->acl->addRole(new Zend_Acl_Role("shopper"));
    //     $this->acl->addRole(new Zend_Acl_Role("admin"));
    // }
    
    // public function setResources() {
    //     $this->acl->addResource(new Zend_Acl_Resource("admin"));
    //     $this->acl->addResource(new Zend_Acl_Resource("customer"));
    //     $this->acl->addResource(new Zend_Acl_Resource("index"));
    //     $this->acl->addResource(new Zend_Acl_Resource("shopper"));
    //     $this->acl->addResource(new Zend_Acl_Resource("error"));
    //     $this->acl->addResource(new Zend_Acl_Resource("product"));
    //     $this->acl->addResource(new Zend_Acl_Resource("checkout"));


    //     // action --- controller
    //     // $this->acl->addResource(new Zend_Acl_Resource("add"), "customer");
    //     // $this->acl->addResource(new Zend_Acl_Resource("login"), "customer");
    //     // $this->acl->addResource(new Zend_Acl_Resource("logout"), "customer");

    //     // $this->acl->addResource(new Zend_Acl_Resource("add"), "shopper");
    //     // $this->acl->addResource(new Zend_Acl_Resource("login"), "shopper");
    //     // $this->acl->addResource(new Zend_Acl_Resource("logout"), "shopper");

    //     // $this->acl->addResource(new Zend_Acl_Resource("add"), "admin");
    //     // $this->acl->addResource(new Zend_Acl_Resource("login"), "admin");
    //     // $this->acl->addResource(new Zend_Acl_Resource("logout"), "admin");


        
    // }
    // //access of controller admin on contrrollers admin & index 
    // // then give the Controller  Role  action from another controller
    // public function setPrivileges() {
    //     $this->acl->allow("admin", array("admin", "index"));
    //     $this->acl->allow("admin", "customer", array("logout"));

    //     $this->acl->allow("customer", array("customer", "index"));
    //     // $this->acl->allow("customer", "customer", array("logout"));
    //     $this->acl->allow("customer", "product", array("logout"));
    //     $this->acl->allow("customer", "checkout", array("cart"));

    //     $this->acl->allow("shopper", array("shopper", "index"));
    //     $this->acl->allow("shopper", "customer", array("logout"));
    //     $this->acl->allow("shopper", "product", array("add"));
        
        

    //     $this->acl->allow("guest", array("index"));
    //     $this->acl->allow("guest", "customer", array("add", "login"));
    //     $this->acl->allow("guest", "shopper", array("add", "login"));
    	

        
    // }
    
    
}
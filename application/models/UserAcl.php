<?php

class Application_Model_UserAcl extends Zend_Acl
{
	// public function __construct(){
		
	// 	$this->addRole(new Zend_Acl_Role(guest));
	// 	$this->addRole(new Zend_Acl_Role(customer));
	// 	$this->addRole(new Zend_Acl_Role(shopper));
	// 	$this->addRole(new Zend_Acl_Role(admin));

	// 	$this->addRole(new Zend_Acl_Role(customer),'guest');
	// 	$this->addRole(new Zend_Acl_Role(shopper),'guest');
	// 	$this->addRole(new Zend_Acl_Role(admin),'guest');
	// 	$this->addRole(new Zend_Acl_Role(admin),'customer');
	// 	$this->addRole(new Zend_Acl_Role(admin),'shopper');

	// 	//index

	// 	$this->add(new Zend_Acl_Resource('index'));
	// 	$this->add(new Zend_Acl_Resource('index'),'index');
	// 	$this->add(new Zend_Acl_Resource('prodcut'),'index');
	// 	$this->add(new Zend_Acl_Resource('displayComment'),'index');
	// 	$this->add(new Zend_Acl_Resource('category'),'index');
	// 	$this->add(new Zend_Acl_Resource('search'),'index');

	// 	// index priviliges
	// 	$this->allow('guest','index','index');
	// 	$this->allow('guest','index','product');
	// 	$this->allow('guest','index','displayComment');
	// 	$this->allow('guest','index','category');
	// 	$this->allow('guest','index','search');


	// 	//product
	// 	$this->add(new Zend_Acl_Resource('product'));
	// 	$this->add(new Zend_Acl_Resource('add'),'product');

	// 	//priviliges
	// 	$this->allow('shopper','product','add');

	// 	//Checkout
	// 	$this->add(new Zend_Acl_Resource('checkout'));
	// 	$this->add(new Zend_Acl_Resource('cart'),'checkout');

	// 	//priviliges
	// 	$this->allow('customer','checkout','cart');

		


	// }

}


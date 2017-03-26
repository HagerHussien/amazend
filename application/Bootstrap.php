<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	
	//add this to application.ini
	// autoloaderNamespaces[] = "My_"
	// resources.frontController.plugins.Acl = "My_Controller_Plugin_Acl"

	//autoloadernamespaces[] = "Plugin_"
	//


	// protected function _initACL(){
	// 	$helper = new My_Controller_Helper_Acl();
	// 	$helper->setRoles();
	// 	$helper->setResources();
	// 	$helper->setPrivileges();
	// 	$helper->setAcl();
	// }
	
	// protected function _initAutoload(){
	// 	$fc = Zend_Controller_Front::getInstance();
	// 	$fc->registerPlugin(new Plugin_AccessCheck());


	// }

}


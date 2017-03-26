<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Zmazon_Controller_Plugin_ACL
 *
 * @author mohamed
 */
class My_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract {
    // public function preDispatch(\Zend_Controller_Request_Abstract $request) {
    //     $acl = Zend_Registry::get("acl");
    //     $userSession = new Zend_Session_Namespace("user");
    //     $userSessionFacebook = new Zend_Session_Namespace("facebook");
    //     //var_dump($userSession->user->privilege);
    //     //die();
    //     if($userSession->user == "" && $userSessionFacebook->facebook == "") {
    //         $roleName = "guest";
    //     }
        
    //     else {
    //         $roleName = $userSession->user->privilege;
    //         $roleName = $userSessionFacebook->facebook->privilege;
    //     }
        
    //     $controller = $request->getControllerName();
    //     $action = $request->getActionName();
        
        
    //     if(! $acl->isAllowed($roleName, $controller, $action)) {
    //         $request->setControllerName("Index");
    //         $request->setActionName("index");
    //     }
    // }
}
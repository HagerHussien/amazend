<?php

class Application_Model_Admin extends Zend_Db_Table_Abstract
{

	 protected $_name = 'admin';

     public function getAllAdmins(){

     	return $this->fetchAll()->toArray();

     }

     public function addNewAdmin($userData){
     	$row = $this->createRow();
		$row->EnName = $userData['EnName'];
		$row->ArName = $userData['ArName'];
		$row->email = $userData['email'];
		$row->password = $userData['password'];

		$row->save();
     }
     

}


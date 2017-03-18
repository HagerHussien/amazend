<?php

class Application_Model_Admin extends Zend_Db_Table_Abstract
{

	 protected $_name = 'admin';

     public function getAllAdmins(){

     	return $this->fetchAll()->toArray();

     }
}


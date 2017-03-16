<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
	protected $_name = 'Users';
	
	public function checkUnique($username)
	{
		$select = $this->_dbTable->select()
		->from($this->_name,array('username'))
		->where('username=?',$username);
		$stmt = $select->query();
		$result = $stmt->fetchAll();
			if($result){
			return true;
			}
		return false;
	}
}


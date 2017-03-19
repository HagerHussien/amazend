<?php

class Application_Model_Shopper extends Zend_Db_Table_Abstract
{
	protected $_name = 'shopper';
	
	function listShoppers()
	{
		return $this->fetchAll()->toArray();
	}
	function deleteShopper($id)
	{
		$this->delete("shopperID=$id");
	}
	function shopperDetails($id)
	{
		return $this->find($id)->toArray();
	}
	function addNewShopper($userData)
	{
		$row = $this->createRow();
		$row->$EnName = $userData['EnName'];
		$row->$ArName = $userData['ArName'];
		$row->$email = $userData['email'];
		$row->$password = $userData['password'];
		
		$row->save();
	}

}


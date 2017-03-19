<?php

class Application_Model_Customer extends Zend_Db_Table_Abstract
{	
	protected $_name = 'customer';
	
	function listCustomers()
	{
		return $this->fetchAll()->toArray();
	}
	function deleteCustomer($id)
	{
		$this->delete("customerID=$id");
	}
	function customerDetails($id)
	{
		return $this->find($id)->toArray();
	}
	function addNewCustomer($userData)
	{
		$row = $this->createRow();
		$row->$EnName = $userData['EnName'];
		$row->$ArName = $userData['ArName'];
		$row->$email = $userData['email'];
		$row->$password = $userData['password'];
		//$row->$wishlist_id = $userData['wishlist_id'];
		$row->save();
	}



}

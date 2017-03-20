<?php

class Application_Model_Coupon extends Zend_Db_Table_Abstract
{

protected $_name = 'coupon';

function getCoupon($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('couponID = ' . $id);
		if (!$row) {
		throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}

function listCoupon()
	{
		return $this->fetchAll()->toArray();
	}



	function CreateCoupon($couponID,$name,$percent)
	{
		$data = array(
		'couponID' => $couponID,
		'name' => $name,
		'percent' => $percent,
		
			);

		$this->insert($data);
	}

function deleteCoupon($id)
{
	$this->delete("couponID=$id");
	
}
}


<?php

class Application_Model_Category extends Zend_Db_Table_Abstract
{

protected $_name = 'category';


function listCat()
{
	return $this->fetchAll()->toArray();
}
function deleteCat($id)
{
	$this->delete("categoryID=$id");
	

}
function detailCat($id)
{
   return $this->find($id)->toArray()[0];
}

function getCat($id)
	{
	$id = (int)$id;
		$row = $this->fetchRow('categoryID = ' . $id);
		if (!$row) {
		throw new Exception("Could not find category $id");
		}
		return $row->toArray();
	}

	
	public function updateCat($catID,$EnName,$ArName,$adminID)
	{
		$data = array(
		'categoryID' => $catID,
		'cat_EnName' => $EnName,
		'cat_ArName' => $ArName,
		'adminID' => $adminID,
		);
		$this->update($data, 'categoryID = '. (int)$catID);
	}

	function addCat($catID,$cat_EnName,$cat_ArName,$adminID)
	{
		$data = array(
		'categoryID' => $catID,
		'cat_EnName' => $cat_EnName,
		'cat_ArName' => $cat_ArName,
		'adminID' => $adminID,
			);

		$this->insert($data);
	}
	public function topProduct($catID)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		
		$select = new Zend_Db_Select($db);

		$select ->from('product')
			->where( 'product.categoryID='.(int)$catID)
			->order('product.no_purchase DESC')
			->limit(1);
		return $resultSet = $db->fetchAll($select);



	}



}


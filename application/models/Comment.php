<?php

class Application_Model_Comment extends Zend_Db_Table_Abstract
{

  protected $_name = 'comment';

  function listComments(){
      return $this->fetchAll()->toArray();
  }

  function deleteComment($comment_id){
      $this->delete("id =$comment_id");
  }

  function addNewComment($commentData)
  {
      $row = $this->createRow();
      $row->comment_body = $commentData['comment_body'];
      $row->comment_date = $commentData['comment_date'];
      $row->comment_productID= $commentData['comment_productID'];
      $row->comment_customerID = $commentData['comment_customerID'];
      $row->save();
  }

  function updateComment($comment_id,$commentData)
  {

      $user_data['fname'] = $userData['fname'];
      $user_data['lname'] = $userData['lname'];
      $user_data['gender'] = $userData['gender'];
      $user_data['email'] = $userData['email'];
      $user_data['track'] = $userData['track'];
      $this->update($user_data,"id=$id");
  }


}

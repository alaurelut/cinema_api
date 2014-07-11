<?php

class UserFollowingHandler {


    function post($id_user, $id_user_followed)
    {


    	global $db;

		$select = $db->prepare("SELECT id FROM following WHERE id_user = ? AND id_user_followed = ? ");
		$select->bindParam(1, $id_user );
		$select->bindParam(2, $id_user_followed );
		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			header("HTTP/1.1 400");
		}		   
		else
		{   
		    $insert = $db->prepare("INSERT INTO following (id_user, id_user_followed) 
		    	VALUES  (?, ?)");
		    $insert->bindParam(1, $id_user );
		    $insert->bindParam(2, $id_user_followed );
		    $res = $insert->execute();

		    $lastId = $db->lastInsertId(); 


			$sth = $db->prepare(" SELECT * 
								FROM `following` 
								WHERE `id` = ".$lastId." ");
			$sth->execute();

		}
	}

    function delete($id_user, $id_user_followed)
    {
    	global $db;

		$select = $db->prepare("SELECT id FROM following WHERE id_user = ? AND id_user_followed = ? ");
		$select->bindParam(1, $id_user );
		$select->bindParam(2, $id_user_followed );
		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			$count = $db->exec("DELETE FROM following WHERE id_user = ".$id_user." AND id_user_followed = ".$id_user_followed." ");
			
		}		   
		else
		{   
			header("HTTP/1.1 400");
		}

    }

    function get($id_user) {

		global $db;

		$sth = $db->prepare(" SELECT * 
							FROM users
							WHERE id
							IN (
							SELECT id_user_followed
							FROM following
							WHERE id_user = ".$id_user."
							) ");


		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($result);

    }

}

class UserFollowersHandler {

    function get($id_user_followed) {

		global $db;

		$sth = $db->prepare(" SELECT * 
							FROM users
							WHERE id
							IN (
							SELECT id_user
							FROM following
							WHERE id_user_followed = ".$id_user_followed."
							) ");


		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($result);

    }

}
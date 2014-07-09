<?php

class UserHandler {

    function get() {

		global $db;

		$sth = $db->prepare("SELECT * FROM users");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);


		    // foreach ($result as $key => $value) {
		    // 	echo $value['name'].' '.$value['id'].' | ';
		    // }

		echo(json_encode($result));
    }

    function post()
    {
    	$name =	$_POST['name'];
    	global $db;

		$select = $db->prepare("SELECT name FROM users WHERE name = ? ");
		$select->bindParam(1, $name );

		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			echo 'un user avec cette id existe deja';
		}		   
		else
		{   
		    $insert = $db->prepare("INSERT INTO users (name) 
		    	VALUES  (?)");
		    $insert->bindParam(1, $name );

		    $res = $insert->execute();
		    echo $name;

		}
    }


}


class UserProfileDeleteHandler {

    function get($id) {


		 global $db;

		 $select = "SELECT * FROM users WHERE id = ".$id." ";

		 foreach ($db->query($select) as $row) {
		     echo $row['id'] . " ";
		     echo $row['name'] . "<br>";
		 }
    }

    function delete($id)
    {
    	global $db;

		$select = $db->prepare("SELECT name FROM users WHERE id = ? ");
		$select->bindParam(1, $id );

		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			$count = $db->exec("DELETE FROM users WHERE id = ".$id." ");

		    echo 'success delete';
		}		   
		else
		{   
			echo 'aucun user trouvé pour cet id';
		}
    }

    function put($id)
    {

	   	$name =	$_GET['name'];
    	global $db;

		$select = $db->prepare("SELECT name FROM users WHERE id = ? ");
		$select->bindParam(1, $id );
		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{

			$insert = $db->prepare("UPDATE users SET name = ? WHERE id = ?");

			$insert->bindParam(1,$name );
			$insert->bindParam(2,$id );
			$res = $insert->execute();

		    echo 'success modify';
		}		   
		else
		{   
			echo 'aucun user trouvé pour cet id';
		}
    }

}


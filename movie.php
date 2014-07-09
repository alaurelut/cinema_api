<?php

class MovieHandler {

    function get() {

		global $db;

		$sth = $db->prepare("SELECT * FROM movies");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);


		    foreach ($result as $key => $value) {
		    	echo $value['name'].' '.$value['id'].' | ';
		    }

		// var_dump(json_encode($result));
    }

    function post()
    {
    	$name =	$_POST['name'];
    	global $db;

		$select = $db->prepare("SELECT name FROM movies WHERE name = ? ");
		$select->bindParam(1, $name );

		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			echo 'un film avec cette id existe deja';
		}		   
		else
		{   
		    $insert = $db->prepare("INSERT INTO movies (name) 
		    	VALUES  (?)");
		    $insert->bindParam(1, $name );

		    $res = $insert->execute();
		    echo $name;

		}
    }

}

class MovieProfileDeleteHandler {

    function delete($id)
    {
    	global $db;

		$select = $db->prepare("SELECT name FROM movies WHERE id = ? ");
		$select->bindParam(1, $id );

		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			$count = $db->exec("DELETE FROM movies WHERE id = ".$id." ");

		    echo 'success delete';
		}		   
		else
		{   
			echo 'aucun movie trouvé pour cet id';
		}
    }

    function get($id) {


		 global $db;

		 $select = "SELECT * FROM movies WHERE id = ".$id." ";

		 foreach ($db->query($select) as $row) {
		     echo $row['id'] . " ";
		     echo $row['name'] . "<br>";
		 }
    }

}

class MovieModifyHandler {

    function put($id,$name)
    {
    	global $db;

		$select = $db->prepare("SELECT name FROM movies WHERE id = ? ");
		$select->bindParam(1, $id );
		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{

			$insert = $db->prepare("UPDATE movies SET name = ? WHERE id = ?");

			$insert->bindParam(1,$name );
			$insert->bindParam(2,$id );
			$res = $insert->execute();

		    echo 'success modify';
		}		   
		else
		{   
			echo 'aucun movie trouvé pour cet id';
		}
    }
}
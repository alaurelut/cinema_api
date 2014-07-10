<?php

class MovieHandler {

    function get() {

		global $db;

		$sth = $db->prepare("SELECT * FROM movies");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);


		    foreach ($result as $key => $value) {
		    	echo $value['title'].' '.$value['id'].' | ';
		    }

		// var_dump(json_encode($result));
    }

    function post()
    {
    	$title =	$_POST['title'];
    	global $db;

		$select = $db->prepare("SELECT title FROM movies WHERE title = ? ");
		$select->bindParam(1, $title );

		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			echo 'un film avec cette id existe deja';
		}		   
		else
		{   
		    $insert = $db->prepare("INSERT INTO movies (title) 
		    	VALUES  (?)");
		    $insert->bindParam(1, $title );

		    $res = $insert->execute();
		    

		    $lastId = $db->lastInsertId(); 

			$sth = $db->prepare("SELECT * FROM movies WHERE id = ".$lastId." ");
			$sth->execute();

			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

			echo(json_encode($result));


		}
    }

}

class MovieProfileDeleteHandler {

    function delete($id)
    {
    	global $db;

		$select = $db->prepare("SELECT title FROM movies WHERE id = ? ");
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
		     echo $row['title'] . "<br>";
		 }
    }

}

class MovieModifyHandler {

    function put($id,$title)
    {
    	global $db;

		$select = $db->prepare("SELECT title FROM movies WHERE id = ? ");
		$select->bindParam(1, $id );
		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{

			$insert = $db->prepare("UPDATE movies SET title = ? WHERE id = ?");

			$insert->bindParam(1,$title );
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
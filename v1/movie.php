<?php

class MovieHandler {

    function get() {

		global $db;

		$sth = $db->prepare("SELECT * FROM movies");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		echo(json_encode($result));
    }

    function post()
    {
    	$title = $_POST['title'];
    	$genre = $_POST['genre'];
    	$cover = $_POST['cover'];
    	global $db;

		$select = $db->prepare("SELECT title FROM movies WHERE title = ? ");
		$select->bindParam(1, $title );

		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			header("HTTP/1.1 400");
		}		   
		else
		{   
		    $insert = $db->prepare("INSERT INTO movies (title, genre, cover) 
		    	VALUES  (?, ?, ?)");
		    $insert->bindParam(1, $title );
		    $insert->bindParam(2, $genre );
		    $insert->bindParam(3, $cover );

		    $res = $insert->execute();
		    

		    $lastId = $db->lastInsertId(); 

			$sth = $db->prepare("SELECT * FROM movies WHERE id = ".$lastId." ");
			$sth->execute();

			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

			echo(json_encode($result));


		}
    }

}

class MovieProfileDeleteModifyHandler {

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

		}		   
		else
		{   
			header("HTTP/1.1 400");
		}
    }

    function get($id)
    {
    	global $db;

		$sth = $db->prepare("SELECT * FROM movies WHERE id = ".$id." ");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		echo(json_encode($result));

    }

    function put($id)
    {
    	$_PUT = array();
    	parse_str(file_get_contents("php://input"),$_PUT);

    	$title = $_PUT['title'];
    	$genre = $_PUT['genre'];
    	$cover = $_PUT['cover'];

    	if (isset($title) && isset($genre) && isset($cover)) {
    		header("HTTP/1.1 400");
    	}
    	else
    	{
	    	global $db;

			$select = $db->prepare("SELECT title FROM movies WHERE id = ? ");
			$select->bindParam(1, $id );
			$select->execute(); 
			
			$count = $select->rowCount();

			if ($count >= 1)
			{

				$insert = $db->prepare("UPDATE movies SET title = ?, genre = ?, cover = ?  WHERE id = ?");

				$insert->bindParam(1,$title );
				$insert->bindParam(2,$genre );
				$insert->bindParam(3,$cover );
				$insert->bindParam(4,$id );
				$res = $insert->execute();

				$sth = $db->prepare("SELECT * FROM movies WHERE id = ".$id." ");
				$sth->execute();

				$result = $sth->fetchAll(PDO::FETCH_ASSOC);

				echo(json_encode($result));

			}		   
			else
			{   
				header("HTTP/1.1 400");
			}
		}


    }

}

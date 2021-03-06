<?php

class UserWatchlistHandler {


    function post($idUser, $idMovie)
    {
    	global $db;

		$select = $db->prepare("SELECT * FROM user_movie WHERE id_user = ? AND id_movie = ? ");
		$select->bindParam(1, $idUser );
		$select->bindParam(2, $idMovie );

		$select->execute(); 


		$result = $select->fetchAll(PDO::FETCH_ASSOC);

	    foreach ($result as $key => $value) {
	    	$watching = $value['watching'];
	    	$id = $value['id'];
	    }

	    if (isset($watching))
	    {
			if ($watching == 'no')
			{
				header("HTTP/1.1 400");
			}
			elseif ($watching == 'yes') {
				$insert = $db->prepare("UPDATE user_movie SET watching = 'no' WHERE id = ?");
				$insert->bindParam(1,$id );
				$res = $insert->execute();
			}
		}
		else
		{   

			$likes = 'no';
		    $insert = $db->prepare("INSERT INTO user_movie (id_user, id_movie, watching) 
		    	VALUES  (?, ?, ?)");
		    $insert->bindParam(1, $idUser );
		    $insert->bindParam(2, $idMovie );
		    $insert->bindParam(3, $likes );
		    $res = $insert->execute();
		}
    }

    function delete($idUser, $idMovie)
    {
    	global $db;

		$select = $db->prepare("SELECT * FROM user_movie WHERE id_user = ? AND id_movie = ? AND watching = 'no' ");
		$select->bindParam(1, $idUser );
		$select->bindParam(2, $idMovie );

		$select->execute(); 

		$result = $select->fetchAll(PDO::FETCH_ASSOC);


		    foreach ($result as $key => $value) {
		    	$id_likes = $value['id'];
		    }

		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			$count = $db->exec("DELETE FROM user_movie WHERE id = ".$id_likes." AND watching = 'no' ");

		}		   
		else
		{   
			header("HTTP/1.1 400");
		}
    }

    function get($idUser) {

		global $db;

		$sth = $db->prepare(" SELECT * 
							FROM movies
							WHERE id
							IN (
							SELECT id_movie
							FROM user_movie
							WHERE id_user = ".$idUser."
							AND watching = 'no'
							) ");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($result);

    }

}
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
				echo 'Ce film est deja dans la watchlist de cet user';
			}
			elseif ($watching == 'yes') {
				$insert = $db->prepare("UPDATE user_movie SET watching = 'no' WHERE id = ?");
				$insert->bindParam(1,$id );
				$res = $insert->execute();
				echo 'Success watching movie id '. $idMovie . ' For user id '.$idUser;
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
		    echo 'Success Watchlisting movie id '. $idMovie . ' For user id '.$idUser;

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

		    echo 'success deleting movie from watchlist';
		}		   
		else
		{   
			echo 'aucun film trouvé pour cet iduser et idmovie dans sa watchlist';
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
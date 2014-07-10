<?php

class UserLikesHandler {


    function post($idUser, $idMovie)
    {
    	global $db;

		$select = $db->prepare("SELECT * FROM user_movie WHERE id_user = ? AND id_movie = ? ");
		$select->bindParam(1, $idUser );
		$select->bindParam(2, $idMovie );

		$select->execute(); 


		$result = $select->fetchAll(PDO::FETCH_ASSOC);

	    foreach ($result as $key => $value) {
	    	$liking = $value['liking'];
	    	$id = $value['id'];
	    }

	    if (isset($liking)) {
		    if ($liking == 'yes')
			{
				echo 'Cet user like deja ce film';
			}
			elseif ($liking == 'no') {
				$insert = $db->prepare("UPDATE user_movie SET liking = 'yes' WHERE id = ?");
				$insert->bindParam(1,$id );
				$res = $insert->execute();
				echo 'Success liking movie id '. $idMovie . ' For user id '.$idUser;
			}	   

	    }
		else
		{   

			$likes = 'yes';
		    $insert = $db->prepare("INSERT INTO user_movie (id_user, id_movie, liking) 
		    	VALUES  (?, ?, ?)");
		    $insert->bindParam(1, $idUser );
		    $insert->bindParam(2, $idMovie );
		    $insert->bindParam(3, $likes );
		    $res = $insert->execute();
		    echo 'Success liking movie id '. $idMovie . ' For user id '.$idUser;

		}
    }

    function delete($idUser, $idMovie)
    {
    	global $db;

		$select = $db->prepare("SELECT * FROM user_movie WHERE id_user = ? AND id_movie = ? AND liking = 'yes' ");
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
			$count = $db->exec("DELETE FROM user_movie WHERE id = ".$id_likes." ");

		    echo 'Cet utilisateur (id : '.$idUser .') n\'aime plus le film id : '.$idMovie;
		}		   
		else
		{   
			echo 'aucun film trouvé pour cet iduser et idmovie dans ses likes';
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
							AND liking = 'yes'
							) ");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($result);

    }

}
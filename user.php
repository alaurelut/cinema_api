<?php

class UserHandler {

    function get() {

		global $db;

		$sth = $db->prepare("SELECT * FROM users");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		echo(json_encode($result));

    }

    function post()
    {
    	$name =	$_POST['username'];
    	global $db;

		$select = $db->prepare("SELECT username FROM users WHERE username = ? ");
		$select->bindParam(1, $name );

		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			echo 'un user avec cette id existe deja';
		}		   
		else
		{   
		    $insert = $db->prepare("INSERT INTO users (username) 
		    	VALUES  (?)");
		    $insert->bindParam(1, $name );

		    $res = $insert->execute();

		    $lastId = $db->lastInsertId(); 


			$sth = $db->prepare(" SELECT * 
								FROM `users` 
								WHERE `id` = ".$lastId." ");
			$sth->execute();

			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

			$user = array();

			$like_count = 0;
			$dislike_count = 0;
			$watched_count = 0;
			$watchlist_count = 0;

			foreach ($result as $cle => $valeur) 
			{
				foreach ($valeur as $key => $value) {
					switch ($key) {
					case 'username':

						$user['username'] = $value;
						break;

					case 'id':

						$user['id'] = $value;
					break;

					}
				}
				
			}

			$user['likes'] = $like_count;
			$user['dislikes'] = $dislike_count;
			$user['watched'] = $watched_count;
			$user['watchlist'] = $watchlist_count;


			echo json_encode($user);

			// var_dump($result);

		}
    }


}


class UserProfileDeleteHandler {

    function get($id) {


		global $db;


		$sth = $db->prepare(" SELECT * 
							FROM `users` 
							LEFT JOIN `user_movie`
							ON `users`.`id` = `user_movie`.`id_user`
							WHERE `users`.`id` = ".$id." ");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		if (count($result) == 0)
		{
			echo 'Aucun user trouvé pour cette id';
		}		   
		else
		{   

			$user = array();

			$like_count = 0;
			$dislike_count = 0;
			$watched_count = 0;
			$watchlist_count = 0;

			foreach ($result as $cle => $valeur) 
			{
				foreach ($valeur as $key => $value) {
					switch ($key) {
					case 'username':

						$user['username'] = $value;
						break;

					case 'liking':

						if ($value == 'yes') {
							$like_count += 1;
						}
						if ($value == 'no') {
							$dislike_count += 1;
						}
						break;

					case 'watching':
						if ($value == 'yes') {
							$watched_count += 1;
						}
						if ($value == 'no') {
							$watchlist_count += 1;
						}
						break;

					default:
						# code...
						break;
					}
				}
				
			}
			$user['id'] = $id;
			$user['likes'] = $like_count;
			$user['dislikes'] = $dislike_count;
			$user['watched'] = $watched_count;
			$user['watchlist'] = $watchlist_count;


			echo json_encode($user);
		}
    }

    function delete($id)
    {
    	global $db;

		$select = $db->prepare("SELECT username FROM users WHERE id = ? ");
		$select->bindParam(1, $id );

		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{
			$count = $db->exec("DELETE FROM users WHERE id = ".$id." ");

		    echo 'L\'utilisateur id '.$id.' a été supprimé avec succès';
		}		   
		else
		{   
			echo 'Aucun utilisateur trouvé pour cet id';
		}
    }

    function put($id)
    {

	   	$name =	$_GET['username'];
    	global $db;

		$select = $db->prepare("SELECT username FROM users WHERE id = ? ");
		$select->bindParam(1, $id );
		$select->execute(); 
		
		$count = $select->rowCount();

		if ($count >= 1)
		{

			$insert = $db->prepare("UPDATE users SET username = ? WHERE id = ?");

			$insert->bindParam(1,$name );
			$insert->bindParam(2,$id );
			$res = $insert->execute();

		    $sth = $db->prepare(" SELECT * 
							FROM `users` 
							LEFT JOIN `user_movie`
							ON `users`.`id` = `user_movie`.`id_user`
							WHERE `users`.`id` = ".$id." ");
			$sth->execute();

			$result = $sth->fetchAll(PDO::FETCH_ASSOC);



				$user = array();

				$like_count = 0;
				$dislike_count = 0;
				$watched_count = 0;
				$watchlist_count = 0;

				foreach ($result as $cle => $valeur) 
				{
					foreach ($valeur as $key => $value) {
						switch ($key) {
						case 'username':

							$user['username'] = $value;
							break;

						case 'liking':

							if ($value == 'yes') {
								$like_count += 1;
							}
							if ($value == 'no') {
								$dislike_count += 1;
							}
							break;

						case 'watching':
							if ($value == 'yes') {
								$watched_count += 1;
							}
							if ($value == 'no') {
								$watchlist_count += 1;
							}
							break;

						default:
							# code...
							break;
						}
					}
					
				}
				$user['id'] = $id;
				$user['likes'] = $like_count;
				$user['dislikes'] = $dislike_count;
				$user['watched'] = $watched_count;
				$user['watchlist'] = $watchlist_count;


				echo json_encode($user);
		}		   
		else
		{   
			echo 'aucun user trouvé pour cet id';
		}
    }

}


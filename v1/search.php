<?php

class SearchHandler {

    function get() {

    	$q = $_GET['q'];
    	$type = $_GET['type'];

		global $db;

		if ($type == 'users') {
			$query = "SELECT * FROM ".$type." 
					WHERE username 
					LIKE '".$q."%' ";
		}

		if ($type == 'movies') {
			$query = "SELECT * FROM ".$type." 
					WHERE title 
					LIKE '".$q."%' ";
		}


		$sth = $db->prepare($query);
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		echo(json_encode($result));
    }

}
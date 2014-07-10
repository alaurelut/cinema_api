<?php

class GenreHandler {

    function get() {

		global $db;

		$sth = $db->prepare("SELECT * FROM genre");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		echo(json_encode($result));
    }

}
<?php
Class DbCon {
	Private $host = "localhost";
	Private $user = "root";
	Private $pwd = "";
	Private $dbName = "amigo";

	Protected function connect(){
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
		$pdo = new PDO($dsn, $this->user, $this->pwd);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		return $pdo;
    }
}

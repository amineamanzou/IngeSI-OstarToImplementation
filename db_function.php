<?php
	
	function connectDb(){
		$base="just4you";
		$user="root";
		$pass="root";
		$host="localhost";
		try{
			$dbConnect=new PDO('mysql:host='.$host.';dbname='.$base,
                               $user, $pass, 
                               array(
                                   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                               )
            );
			return $dbConnect;
		}catch(PDOException $e){
			exit('Invalid request or Db error'.$e->getMessage());
		}
	}

?>
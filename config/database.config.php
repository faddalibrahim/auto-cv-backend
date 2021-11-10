<?php 

	require 'credentials.config.php';

	class Database{
		private $host = HOST;
		private $user = USERNAME;
		private $password = PASSWORD;
		private $name = DB_NAME;
		private $conn;
		
		public function connect(){
			$this->conn = null;

			try{
				$this->conn = new PDO("mysql:host=$this->host;dbname=$this->name;charset=utf8",$this->user,$this->password);

				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $output = 'Database connection established.';             
                
				
			}catch (PDOException $e){
                $output = 'Connection Error: ' . $e->getMessage(). ' in ' . $e->getFile() . ' : '. $e->getLine();
			}

            echo $output;
            
			return $this->conn;
		}
	}

 ?>
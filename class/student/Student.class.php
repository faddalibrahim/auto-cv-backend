<?php 

	/**
	 * 
	 */
	class Student{
		//DB Stuff
		private $conn;
		private $table = 'student';

		//Post properties
		public $id;
		public $fullname;
		public $email;
		public $password;
		public $details;

		//constructor
		public function __construct($db){
			$this->conn = $db;
		}

        public function login(){
			$email = htmlspecialchars(strip_tags($this->details->email));
			$password = password_verify($this->details->password,PASSWORD_DEFAULT);

			// getting student data to verify password
            $sql = "SELECT email,password from $this->table WHERE email = :email";
			$stmt = $this->conn->prepare($sql);
			$stmt.bindParam(':email',$email);
			$stmt->execute();

			// if there was a record
			if($stmt->rowCount()){
				$student_data = $stmt->fetch();

				// compare passwords
				if(password_verify($student_data['password'], $password)){
					return json_encode(array('ok'=> true, 'message' => 'login successful'));
				}

				return json_encode(array('ok'=> false, 'message' => 'email or password incorrect'));
			}

			// if no record
			return json_encode(array('ok'=> false, 'message' => 'email or password incorrect'));





        }

		public function register(){

			//clean details
			$firstname = htmlspecialchars(strip_tags($this->details->firstname));
			$lastname = htmlspecialchars(strip_tags($this->details->lastname));
			$email = htmlspecialchars(strip_tags($this->details->email));
			$password = htmlspecialchars(strip_tags($this->details->password));
			$password = password_hash($password,PASSWORD_DEFAULT);

			// generate token
			$token = bin2hex(random_bytes(50));
		
			// prepare query
			$sql = "INSERT INTO $this->table (fn,ln,email,pwd,token) VALUES(:fn, :ln, :email, :pwd, :token)";
			$stmt = $this->conn->prepare($sql);

			//bind data
			$stmt->bindParam(':fn', $firstname);
			$stmt->bindParam(':ln', $lastname);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':pwd', $password);
			$stmt->bindParam(':token', $token);


			//execute query and return success message if successful
			if($stmt->execute()){
				return json_encode(array('ok' => true, 'message' => 'user successfully registered'));
			}

			//return error if something goes wrong
			return json_encode(array('ok' => false, 'message' => $stmt->error));

        }

		public function forgotPassword(){
            return json_encode(array('forgot password' => 'yhupp you are on the student forgot password route'));
        }

		public function resetPassword(){
            return json_encode(array('reset password' => 'yhupp you are on the student reset password route'));
        }
	
		
	}

 ?>
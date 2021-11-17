<?php 

	

	/**
	 * 
	 */
	class Student{
		//DB Stuff
		private $conn;
		private $table = 'student';
		private $parent_table = 'person';

		// miscillaneous
		public $details;
		private $sanitizedDetails;

		private $loginFields = array('email','password');
		private $registerationFields = array('fname','lname','email','password');

		// login errors
		private $login_error = array('ok'=> false, 'message' => 'email or password incorrect');

		//register errors
		private $email_exists = array('ok'=> false, 'message' => 'email is already taken');

		//registeration successes
		private $register_success = array('ok' => true, 'message' => 'user successfully registered');
		
		private $invalid_data = array('ok' => false, 'message' => 'haha invalid dataaaa');

		//constructor
		public function __construct($db){
			$this->conn = $db;
		}

		// extra
		private function validateFields($field_key_array){
			foreach ($this->details as $field => $value){
        		if (!(in_array($field, $field_key_array)) || !$value){
					return false;
        		}
    		}
			return true;
		}

		private function sanitizeDetails($details){
			function sanitize($each_detail){
				return htmlspecialchars(strip_tags(trim($each_detail)));
			}

			$this->sanitizedDetails = array_map("sanitize",$details);
		}

		private function getDataFromDB($email){
			// change this is a join
			$sql = "SELECT * from $this->parent_table WHERE email = :email";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':email',$email);
			$stmt->execute();

			return $stmt;
		}

		private function getBottomId(){
			$sql = "SELECT student_id from $this->table ORDER BY student_id DESC LIMIT 1";
			$stmt_get_bottom_id = $this->conn->prepare($sql);
			$stmt_get_bottom_id->execute();

			if($stmt_get_bottom_id->rowCount()){
				$bottom_record = $stmt_get_bottom_id->fetch();
				return $bottom_record['student_id'];
			}

			return 0;
		}

		private function createNewId(){
			require "../../incs/constants.inc.php";

			$bottom_id = $this->getBottomId();

			if($bottom_id){
				$bottom_id_str_arr = explode(EXPLODE_AT,$bottom_id);
				$bottom_id_int = (int) end($bottom_id_str_arr);
				$new_id_number = $bottom_id_int + 1;
	
				$new_student_id = STUDENT_ID_PREFIX . strval($new_id_number);
	
				return $new_student_id;
			}

			return "SD1";

		}

	

        public function login(){
			if (!$this->validateFields($this->loginFields)){
				return json_encode($this->invalid_data);
			}

			$this->sanitizeDetails($this->details);

			
			$stmt = $this->getDataFromDB($this->sanitizedDetails['email']);
			
			// if there is a record
			if($stmt->rowCount()){
				$student_data = $stmt->fetch();
				extract($student_data);

				
				// compare passwords
				if(password_verify($this->sanitizedDetails['password'],$password)){
					return json_encode(array('ok'=> true, 'message' => 'login successful', 'data' => array(
						'firstName' => $fname, 
						'lastName' => $lname,
						'email' => $email,
						'isVerified' => $isVerified,
						'token' => $token
					)));
				}
				
				// if password not correct
				return json_encode($this->login_error);
			}
			
			// if no record
			return json_encode($this->login_error);
        }
		
		public function register(){
			if (!$this->validateFields($this->registerationFields)){
				return json_encode($this->invalid_data);
			}

			$this->sanitizeDetails($this->details);


			// check if user exists in database
			$stmt = $this->getDataFromDB($this->sanitizedDetails['email']);
			if($stmt->rowCount()){
				return json_encode($this->email_exists);
			}

			// new student id
			$new_id = $this->createNewId();

			// hash password
			$hashed_password = password_hash($this->sanitizedDetails['password'],PASSWORD_DEFAULT);

			// generate token
			$token = bin2hex(random_bytes(50));
		
			// prepare query
			$sql = "INSERT INTO $this->parent_table (person_id, fname,lname,email,password,token) 
					VALUES(:person_id, :fname, :lname, :email, :password, :token)";
			$stmt = $this->conn->prepare($sql);

			//bind data
			$stmt->bindParam(':person_id', $new_id);
			$stmt->bindParam(':fname', $this->sanitizedDetails['fname']);
			$stmt->bindParam(':lname', $this->sanitizedDetails['lname']);
			$stmt->bindParam(':email', $this->sanitizedDetails['email']);
			$stmt->bindParam(':password', $hashed_password);
			$stmt->bindParam(':token', $token);
			
			
			//execute query and return success message if successful
			if($stmt->execute()){
				// add to child table(student);
				$sql = "INSERT INTO $this->table (student_id) VALUES(:student_id)";
				$stmt = $this->conn->prepare($sql);
				$stmt->bindParam(':student_id', $new_id);

				if($stmt->execute()){
					return json_encode($this->register_success);

				}

				return json_encode(array('ok' => false, 'message' => $stmt->error));

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
<?php
	/*
	# 
	 */
	class user{
		public $pdo;
		public $msg;
		public $user;

		public function connect()
		{
			if (session_status() === PHP_SESSION_ACTIVE) {
				try {
					$dbhost = 'localhost';
					$dbname='kho2';
					$dbuser = 'root';
					$dbpass = 'kaitoryouga';
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
					$this->pdo = $pdo;
					return true;
				}catch (PDOException $e) {
					echo "Error : " . $e->getMessage() . "<br/>";
					die();
				}
			}else{
				$this->msg = "Sever diconnect";
				return false;
			}
		}

		public function registration($mail, $lname, $fname, $pass, $verify)
		{
			$this->connect();
			$pdo = $this->pdo;
			$pass_hash = $this->password_ha($pass);
			$sql = $pdo->prepare('INSERT INTO user (MAIL, LNAME, FNAME, PASS) VALUES (?, ?, ?, ?)');
			$sql->execute(array("$mail", "$lname", "$fname", "$pass_hash"));
			$user = $sql->fetchAll();
		}

		public function login($mail, $pass)
		{
			$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare("SELECT MAIL, PASS FROM user");
			$sql->execute();
			$user = $sql->fetchAll();

			$flag_login = false;
			$flag_incre = 0;

			foreach ($user as $key => $value) {
				for ($i=0; $i < count($value); $i++) { 
					$flag_incre = $i;
					$flag_incre++;
					if ($mail == $value[$i]) {
						if ($this->pass_verify($pass, $value[$flag_incre++])) {
							$flag_login = true;
							break;
						}
					}
				}
			}

			if ($flag_login == false) {
				$this->msg = "Login faill !!!";
				$this->print_msg();
			}else{
				$this->msg = "Login successfully !!!";
				$this->print_msg();
				echo "<SCRIPT type='text/javascript'>
              			window.location.replace(\"./table.php\");
              		</SCRIPT>";
			}
			
		}

		public function password_ha($pass)
		{
			return password_hash($pass, PASSWORD_DEFAULT);
		}

		public function cofirm_code()
		{
			$cofirm_code_original = "SSBhbSBrYWl0byByeW91Z2E";
			$code = array();
			$cofirm_code_lenght = strlen($cofirm_code_original) - 1;
			for ($i=0; $i < 4; $i++) { 
				$code[] = $cofirm_code_original[rand(0, $cofirm_code_lenght)];
			}
			return implode($code);
		}

		public function pass_verify($pass, $pass_hash)
		{
			if (password_verify($pass, $pass_hash)) {
				return true;
			}else{
				return false;
			}
		}
		// public function logout($value='')
		// {
		// 	$this->msg = "Logout successfully";
		// 	$_SESSION["user"] = null;
		// 	session_regenerate_id();
		// 	return true;
		// }

		public function forgot_pass($mail)
		{
			$pdo = $this->pdo;
			$sql = $pdo->prepare("SELECT MAIL FROM user");
			$sql->execute();
			$user = $sql->fetchAll();
			if ($mail == $user["MAIL"]) {
				$messenger = "";
				mail($mail, "Forgot password", $messenger);
			}
		}

		public function change_pass($pass_change, $id)
		{
			$pass_hash = password_ha($pass_change);
			$pdo = $this->pdo;
			$sql = $pdo->prepare("UPDATE user SET PASS = ? WHERE ID = ?");
			if ($sql->execute(["$pass_hash"],["$id"])) {
				$user = $sql->fetchAll();
				$_SESSION["user"]["pass"] = $user["PASS"];
				$this->msg = "Change password successfully";
			}
		}

		public function print_msg()
		{
		    echo 
            '<script type="text/javascript">
              alert("'.$this->msg.'");
            </script>';
		}

	}

?>
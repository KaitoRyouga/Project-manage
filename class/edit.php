<?php
	/**
	 * # create class edit with object pdo and msg
	 * # pdo used for management database
	 * # msg used print messenge
	 */
	class edit
	{
		public $pdo;
		public $msg;

		/*
		# function connect used check session_status and connect database
		 */
		public function connect()
		{
			if (session_status() == PHP_SESSION_ACTIVE) {
				try {
					$dbhost = "localhost";
					$dbname = "kho2";
					$dbuser = "root";
					$dbpass = "kaitoryouga";
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
					$this->pdo = $pdo;
				} catch (PDOException $e) {
					echo "Error:" . $e->getMessenge() . "</br>";
					die();
				}
			}else{
				$this->msg = "Sevet diconnect";
			}
		}

		/*
		# function used fix bug id auto_increment after delete on database
		 */
		public function auto_fix()
        {
        	$this->connect;
        	$pdo = $this->pdo;
        	$sql_array = array('SET @num := 0', 'UPDATE item SET id = @num := (@num+1)', 'ALTER TABLE tableName AUTO_INCREMENT = 1');
			for ($i=0; $i < 3; $i++) { 
				$sql = $pdo->prepare($sql_array[$i]);
				$sql->execute();
			}
			// echo '<script type="text/javascript">
			// 		window.location.replace(\'./table.php\');
			// 	</script>';
        }

        /*
        # function echo_head used print head for table
         */
		public function echo_head()
        {
			echo '
				<th>ID</th>
				<th>ITEM_CODE</th>
				<th>ITEM</th>
				<th>QUANTITY</th>
				<th></th>
        	';
        }

        /*
        function create_manage used print table manage
         */
		public function create_manage()
        {
        	$this->connect();
        	$pdo = $this->pdo;
        	$sql = $pdo->prepare('SELECT * FROM item');
        	$sql->execute();
        	$user = $sql->fetchAll();
        	$flag  = 1;
	    	$flagD = 1;
	    	foreach ($user as $key => $value) {
	    		if ($flag == 1) {
	    			$this->echo_head();
	    		}
				echo '
					<tr>
						<td>
							'.$value["ID"].'
						</td>
						<td>
							'.$value["ITEM_CODE"].'
						</td>
						<td>
							'.$value["ITEM"].'
						</td>
						<td>
							'.'<input type="number" name="name_step'.$flag++.'" step="1" value="'.$value["QUANTITY"].'" min="0">'.'
						</td>
						<td>
							'.'	<button name="button" value="OK" type="button" onclick="callphp()">
									<a href="?d='.$value["ITEM_CODE"].'">Delete</a>
								</button>
								<script type="text/javascript">
      								function callphp() {
      								alert("Delete successfully");
							        }
							    </script>'.'
						</td>
					</tr>
				';
			}
			$this->auto_fix();
        }       

        /*
        # function delete used delete 1 item based code item on database
         */
        public function Delete()
        {
        	$this->connect();
        	$pdo = $this->pdo;
        	if (!empty($_GET["d"])) {
        		$ID_DB = $_GET["d"];
        		$this->log_delete($ID_DB);
        		// $ID_DB = 3;
				$sql = $pdo->prepare('DELETE FROM item WHERE ITEM_CODE = ?');
				$sql->execute(array("$ID_DB"));
				$user = $sql->fetchAll();
				echo 	'<script type="text/javascript">
							window.location.replace(\'./table.php\');
						</script>';
        	}
        	$this->auto_fix();
        }

        /*
        # function nrow used print number row in table
         */
        public function nrow()
        {
        	$this->connect();
        	$pdo = $this->pdo;
	    	$sql = $pdo->prepare('SELECT count(*) FROM item');
	    	$sql->execute();
	    	$user = $sql->fetchAll();
	    	foreach ($user as $key => $value) {
	    		return $value[0];
	    	}
        }

        /*
        function create_name used create info for item before insert
         */
        public function create_name()
		{
			echo '
				<form action="table.php" method="POST" id="main-form-1">
					<p>Create name item:</p>
					<input type="text" name="name_item_input"></br>
					<p>Create quantity:</p>
					<input type="number" name="name_step_insert" step="1" value="1" min="0"></br>
					<input type="submit" name="submit_name" value="accept">
				</form>
			';
		}

		/*
		# function creaete_code_item used create code item for item after insert with mechanism anti_same
		 */
		public function create_code_item()
		{
			$original_code_item= "aSBhbSBrYWl0byByeW91Z2EgYW5kIHRoaXMgaXMgYSBjb2RlIGl0ZW0";
			$code_item = array();
			$item_code_lenght = strlen($original_code_item) - 1;
			for ($i=0; $i < 4; $i++) { 
				$code_item[] = $original_code_item[rand(0, $item_code_lenght)];
			}
			$code_final = implode($code_item);
			if ($this->anti_same($code_final) == true) {
				return $code_final;
			}else{
				$this->create_code_item();
			}
		}

		/*
		function insert used insert info of item up to table
		 */
		public function insert($item_code, $item, $quantity)
		{
			$this->log_insert($item_code, $item, $quantity);
			$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('INSERT INTO item (ITEM_CODE, ITEM, QUANTITY) VALUES (?, ?, ?)');
			$sql->execute(array("$item_code", "$item", "$quantity"));
			echo 	'<script type="text/javascript">
							alert("Insert successfully");
							window.location.replace(\'./table.php\');
					</script>';
			$this->auto_fix();
		}

		/*
		function update used update info of item up to table
		 */
		public function update($quantity, $id)
		{
			$this->history_log($quantity, $id);
			$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('UPDATE item SET QUANTITY = ? WHERE ID = ?');
			$sql->execute(array("$quantity", "$id"));
			echo 	'<script type="text/javascript">
							alert("Update successfully");
							window.location.replace(\'./table.php\');
					</script>';
		}

		/*
		function print_msg used print messenge based object msg
		 */
		public function print_msg()
		{
			$msg = $this->msg;
			echo '
				<script type="text/javascript">
  					alert("'.$msg.'")
				</script>';
		}

		/*
		# function diff_date used check different of file log, if more than 86400s will clear file log
		 */
		public function diff_date()
		{
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$date1 = date ("H:i:s", filemtime("../history/history_log.txt"));
			$date2 = date("H:i:s");
			$date3 = date_create($date1);
			$date4 = date_create($date2);
			$diff = date_diff($date3, $date4);
			$array_time = array(0, 0, 86400, 3600, 60, 1);
			$s = 0;
			$i = 0;

			foreach ($diff as $key => $value) {
					$s += $array_time[$i++] * $value;
			}
			// if ($s > 86400) {
			// 	$myfile = fopen("../history/history_log.txt", "w") or die("Unable to open file!");
			// }
		}

		/*
		# function datetime used get date current
		 */
		public function datetime()
		{

			date_default_timezone_set('Asia/Ho_Chi_Minh');
			return date("H:i:s");
		}

		/*
		# function history_log used write log update of info item after edit
		 */
		public function history_log($quantity, $id)
		{
			$this->pdo;
			$pdo = $this->pdo;
			$sql = $pdo->prepare("SELECT ITEM_CODE, QUANTITY FROM item WHERE ID = ?");
			$sql->execute(array("$id"));
			$user = $sql->fetchAll();

			foreach ($user as $key => $value) {
				if ($value[1] != $quantity) {
					$messenge_action = ' CHANGE QUANTITY('.$value[1].' => '.$quantity.') WHERE ITEM_CODE = '.$value[0].'';
				}
				else{
					return false;
				}
			}

			$this->write_log($messenge_action);
		}

		/*
		# function log_delete used write log delete of info item after edit
		 */
		public function log_delete($item_code_delete)
		{
			$messenge_action = ' DELETE ITEM_CODE = '.$item_code_delete.'';

			$this->write_log($messenge_action);
		}

		/*
		# function log_insert used write log insert of info item after edit
		 */
		public function log_insert($item_code, $name, $quantity)
		{
			$messenge_action = ' INSERT ITEM = '.$name.' WITH ITEM_CODE = '.$item_code.' AND QUANTITY = '.$quantity.'';

			$this->write_log($messenge_action);
		}

		/*
		# function write_log used open file log and write info item after edit
		 */
		public function write_log($messenge_action)
		{
			$messenge_date = $this->datetime();
			$mes = $messenge_date . $messenge_action;

			$myfile = fopen("./history/history_log.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $mes.PHP_EOL);
			fclose($myfile);
		}

		/*
		# function form_search used create form search info of 1 item
		 */
		public function form_search($item_code)
		{
			$this->connect();
        	$pdo = $this->pdo;
        	$sql = $pdo->prepare('SELECT * FROM item WHERE ITEM_CODE = ?');
        	$sql->execute(array("$item_code"));
        	$user = $sql->fetchAll();
        	$flag  = 1;
	    	$flagD = 1;
	    	$id = 1;
	    	foreach ($user as $key => $value) {
	    		if ($flag == 1) {
	    			$this->echo_head();
	    		}
				echo '
					<tr>
						<td>
							'.$id++.'
						</td>
						<td>
							'.$value["ITEM_CODE"].'
						</td>
						<td>
							'.$value["ITEM"].'
						</td>
						<td>
							'.'<input type="number" name="name_step'.$flag++.'" step="1" value="'.$value["QUANTITY"].'" min="0">'.'
						</td>
						<td>
							'.'	<button name="button" value="OK" type="button" onclick="callphp()">
									<a href="?d='.$value["ITEM_CODE"].'">Delete</a>
								</button>
								<script type="text/javascript">
      								function callphp() {
      								alert("Delete successfully");
							        }
							    </script>'.'
						</td>
					</tr>
				';
			}
			$this->auto_fix();
		}

		/*
		# function anti_same is mechanism anti_same used check item code exist
		 */
		public function anti_same($code)
		{
			$this->connect();
			$pdo = $this->pdo;
			$sql = $pdo->prepare('SELECT ITEM_CODE FROM item');
			$sql->execute();
			$user = $sql->fetchAll();
			foreach ($user as $key => $value) {
				if ($code == $value[0]) {
					return false;
				}
			}
			return true;
		}
	}
?>
<?php
/* Creates connections to the database */
// Function to obtain mysqli connection.
class conn_db() {
	private $db;
	private $err;

	function __construct() {
		// Connect to DB
		$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8';
		try {
			$this->db = new PDO($dsn, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch (PDOException $e) {
			$response["status"] = "error";
			$response["message"] = "Connection Failed: " . $e->getMessage();
			$response["data"] = null;
			exit;
		}
	}

	function select($table, $columns, $where, $order) {
		try {
			$a = array();
			$w = "";
			foreach ($where as $key => $value) {
				$w . = " and " . $key . " like :" . $key;
				$a[":" . $key] = $value;
			}
			$stmt = $this->db->prepare("select " . $columns . " from " . $table . " where 1 = 1 " . $w . " " . $order);
			$stmt->execute($a);
			$rows = $stmt->fetchAll(PDO::TETCH_ASSOC);
			if(count($rows)<=0) {
				$response["status"] = "warning";
				$response["message"] = "No data found."
			}
			else {
				$response["status"] = "success";
				$response["message"] = "Data selected from database."
			}
			$response["data"] = $rows;
		} catch(PDOException $e) {
			$response["status"] = "error";
			$response["message"] = "Select Failed: " . $e->getMessage();
			$response["data"] = null;
		}
		return $response;
	}
}
?>
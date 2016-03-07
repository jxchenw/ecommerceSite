<?php
	require_once "/vendor/autoload.php";
	require_once dirname(__DIR__) . "../helpers/connect.php";

Class Categories {
	public static function getCategoryHandler() {
		$sql = "CALL getCategories()";
		// Connect to DB
		$db = conn_db();
		// Run the query
		if($stmt = $db->prepare($sql)) {
			// Execute query
			$stmt->execute();
			// Bind query results
			$stmt->bind_result($category_id, $category_name);
			$data = array();
			// Grab all the results
			while($stmt->fetch()) {
				$entry = new stdClass();
				// Add the values to the entry array
				$entry->category_id = $category_id;
				$entry->category_name = $category_name;
				// Add that array to the data
				array_push($data, $entry);
				$entry = null;
			}
			// Print errors to log if there are any
			if($stmt->error) {
				error_log("error: " . $stmt->error);
				return false;
			}
			// Close ports
			$stmt->close();
			$db->close();
			// Return the data as a json
			return json_encode($data);
		}
		else {
			$db->close();
			return false;
		}
	}

	public static function getCategories() {
		/**
		$result = Categories::getCategoryHandler();
		if($result) {
			\Slim\Slim::getInstance()->response->setStatus(200);
			\Slim\Slim::getInstance()->response->setBody($result);
		}
		else {
			\Slim\Slim::getInstance()->response->setStatus(404);
		} **/

		
	}
}
/**		global $con;
		$get_cats = "select * from Categories";
		$run_cats = mysqli_query($con, $get_cats);

		while($row_cats = mysqli_fetch_array($run_cats)) {
			$cat_id = $row_cats['category_id'];
			$cat_title = $row_cats['category_name'];

			echo "<li><a href='#'>$cat_title</a></li>";
		}
	}**/
?>
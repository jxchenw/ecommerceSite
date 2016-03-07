<?php
	require_once "/vendor/autoload.php";
	require_once "handlers/category.php";

	use \Slim\App;

	// Creating and configuring slim
	$app = new App();
	$app = \Slim\Slim::getInstance();

	$db = conn_db();

	// Routing
	$app->get('/categories', function () {
		global $db;
		$rows = $db->select("Categories", "category category_id, category_name", array("parent" => 0), "ORDER BY category_name");

		//parent categories node
		$categories = array();

		foreach ($rows["data"] as $row) {
			$cat_id = $row["category_id"];
			//select sub-categories by their main categories
			$subcategories = $db->select("Categories", "category category_id, category_name", array("parent" => $cat_id), "ORDER BY category_name");
			$category = array(); //temp array
			$category["cat_id"] = $row["category_id"];
			$category["name"] = $row["category_name"];
			$category["subcategories"] = array();

			foreach ($rows["data"] as $srow) {
				$subcat = array();
				$subcat["cat_id"] = $srow["category_id"];
				$subcat["name"] = $srow["category_name"];
				array_push($category["subcategories"], $subcat);
			}
			//push signle category into parent
			array_push($categories, $category);
		}
		echoResponse(200, $categories);
	});

	function echoResponse($status_code, $response) {
		global $app;
		$app->status($status_code);
		$app->contentType('application/json');
		echo json_encode($response, JSON_NUMERIC_CHECK);
	}

	// Run
	$app->run();
?>
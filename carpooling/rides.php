<?php
// Get the route from the request
$route = $_GET["route"];

// Handle the route
switch ($route) {
	case "book_and_pay":
		// Get the ride data from the request
		$ride = [
			"origin" => $_POST["origin"],
			"destination" => $_POST["destination"],
			"date" => $_POST["date"],
			"seats" => $_POST["seats"],
			"driver_id" => $_POST["driver_id"]
		];

		// Save the ride data to rides.json
		$rides = json_decode(file_get_contents("rides.json"), true);
		$rides[] = $ride;
		file_put_contents("rides.json", json_encode($rides));

		// Process the payment
		$card_number = $_POST["card_number"];
		$expiry_date = $_POST["expiry_date"];
		$cvv = $_POST["cvv"];
		$amount = $_POST["amount"];

		// Simulate payment processing
		// (in a real system, this would be done securely using a payment gateway)
		$success = true;

		if ($success) {
			// Redirect to index.html after successful payment
			header("Location: index.html");
			exit;
		} else {
			echo "<span style='color:red'>Payment failed. Please try again later.</span>";
		}

		break;
	case "rides":
		// Get the booked rides from rides.json
		$rides = json_decode(file_get_contents("rides.json"), true);

		// Return the booked rides as JSON
		header("Content-Type: application/json");
		echo json_encode($rides);
		break;
	default:
		http_response_code(404);
		echo "Invalid route";
}
?>

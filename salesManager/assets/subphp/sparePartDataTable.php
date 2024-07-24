<?php
require_once('../../../db/connect.php');

// Prepare the SQL query
$sql = "SELECT 
    sparepart.sparePartImage,
    sparepart.sparePartNum,
    sparepart.sparePartName,
    sparepart.stockItemQty,
    sparepart.weight,
    sparepart.price,
    sparepart.discountPrice,
    disabledsparepart.disable
 FROM `sparepart` LEFT JOIN `disabledsparepart` ON sparepart.sparePartNum = disabledsparepart.sparePartNum";

// Prepare the statement
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die(json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $conn->error]));
}

// Execute the statement
if (!$stmt->execute()) {
    die(json_encode(['status' => 'error', 'message' => 'Execute statement failed: ' . $stmt->error]));
}

// Get the result set
$result = $stmt->get_result();

// Initialize an empty array to hold the data
$dataSet = [];

// Check if there are any rows in the result set
if ($result->num_rows > 0) {
    // Fetch each row and format the data
    while ($row = $result->fetch_assoc()) {
        $row['discountPrice'] = ($row['discountPrice'] == 0) ? "No Discount" : "$" . $row['discountPrice'];
        $disable = ($row['disable'] == 1) ? "Disabled" : "Enabled";

        // Append the formatted row to the dataSet array
        $dataSet[] = [
            $row['sparePartImage'],
            $row['sparePartNum'],
            $row['sparePartName'],
            $row['stockItemQty'],
            $row['weight'] . "kg",
            "$" . $row['price'],
            $row['discountPrice'],
            $disable
        ];
    }
}

// Return the data as a JSON response
echo json_encode(['status' => 'success', 'data' => $dataSet]);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
<?php
/**
 * Created by Vishnu
 * Date: 24.01.2024
 */
require_once("functions.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES["bookFile"])) {
	// Check if file was uploaded without errors
    if ($_FILES["bookFile"]["error"] == 0) {
        $tempName = $_FILES["bookFile"]["tmp_name"];
        $jsonContent = file_get_contents($tempName); // Read the JSON file content
        $jsonData = json_decode($jsonContent, true); // Parse JSON content

        if ($jsonData === null) {
            echo "Error decoding JSON file.";
        } else {
            // Display the content of the JSON file  
            $tableName = "customers";
            foreach ($jsonData as $data) {
                // Insert data
                if (insertData($tableName, $data, "sale_id")) {
                    header('Location: index.php');
                    $successMessage = "File Uploaded Successfully";
                } else {
                    echo "Error inserting record";
                }
            }
        }
    } else {
        echo "Error uploading file. Error code: " . $_FILES["bookFile"]["error"];
    }
}

?>
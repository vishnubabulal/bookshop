<?php
/**
 * Created by Vishnu
 * Date: 24.01.2024
 */
// database connections
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookshop";

// Create connection
function connectToDatabase() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Close connection
function closeDatabaseConnection($conn) {
    $conn->close();
}

// Insert data into the database
function insertData($tableName, $data, $primaryKeyField) {
    $conn = connectToDatabase();
    // Exclude the primary key field from the column names
    $columnsToInsert = array_diff(array_keys($data), [$primaryKeyField]);
    $columnNames = implode(", ", $columnsToInsert);

    // Exclude the primary key field from the values
    $valuesToInsert = array_diff_assoc($data, [$primaryKeyField => $data[$primaryKeyField]]);
    $escapedValues = array_map(function ($value) use ($conn) {
        return mysqli_real_escape_string($conn, $value);
    }, $valuesToInsert);
    $columnValues = "'" . implode("', '", $escapedValues) . "'";

    $sql = "INSERT INTO $tableName ($columnNames) VALUES ($columnValues)";

    if ($conn->query($sql) === TRUE) {
        closeDatabaseConnection($conn);
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        closeDatabaseConnection($conn);
        return false;
    }
}

// Fetch all data from the database table
function fetchData($tableName, $customerName = "", $productName = "", $price = "") {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM $tableName WHERE 1";
    if (!empty($customerName)) {
        $sql .= " AND customer_name LIKE '%$customerName%'";
    }
    if (!empty($productName)) {
        $sql .= " AND product_name LIKE '%$productName%'";
    }
    if (!empty($price)) {
        $sql .= " AND product_price LIKE '%$price%'";
    }
    
    $sql .= " ORDER BY sale_date DESC";
    
    $result = $conn->query($sql);

    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    closeDatabaseConnection($conn);
    return $data;
}

function deleteAllRecordsFromDatabase($tableName) {
    $conn = connectToDatabase();
    // to delete all records
    $sql = "DELETE FROM $tableName";
    $conn->query($sql);
    // Close the connection
    closeDatabaseConnection($conn);
}

?>
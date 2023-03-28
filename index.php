<?php

// Connect to database
$host = 'localhost';
$user = 'username';
$password = 'password';
$dbname = 'database_name';
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read CSV file
$filename = 'data.csv';
$file = fopen($filename, 'r');
if (!$file) {
    die("Error opening file");
}

// Insert data into database
while (($data = fgetcsv($file)) !== FALSE) {
    $name = $data[0];
    $email = $data[1];
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close file and database connection
fclose($file);
$conn->close();

echo "Data imported successfully";

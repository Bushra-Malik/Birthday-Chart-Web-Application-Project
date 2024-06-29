<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "birthdaycalender";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all records from BirthdayList table
$sql = "SELECT * FROM BirthdayList";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $birthdays = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $birthdays[] = $row;
    }
    echo json_encode($birthdays);
} else {
    echo json_encode([]);
}

// Close connection
mysqli_close($con);
?>

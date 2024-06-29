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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['personName'];
    $dob = $_POST['personDOB'];
    $age = $_POST['personAge'];
    $image = $_FILES['personImage']['name'];
    $target_dir = "uploads/";

    // Ensure the uploads directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($image);

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES['personImage']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO BirthdayList (name, dob, age, pic) VALUES ('$name', '$dob', '$age', '$target_file')";
        if (mysqli_query($con, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Close connection
mysqli_close($con);
?>

<?php
    $conn = mysqli_connect("localhost", "root", "", "restaurant");
    if(!$conn) {
        die("Connecttion failed: ".mysqli_connect_error());
    }
?>
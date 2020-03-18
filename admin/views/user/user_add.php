<?php
    require_once "../conn.php";

    if(isset($_POST["submit"])) {
        // var_dump($_POST);
        $username = $_POST['username'];
        $pass = $_POST['password'];
        $role = $_POST['role'];

        // $sql2 = "SELECT max(id) AS lastId FROM tbl_user";
        $sql2 = "SELECT MAX(CAST(id as UNSIGNED)) as id from tbl_user";
        $q2 = $conn->query($sql2);
        $data = mysqli_fetch_assoc($q2);
        // var_dump($data);
        echo $data['id'];
        $lastId = $data['id'];
        $lastId++;
        echo $lastId;
        // $lastId++;
        // print_r($data);
        // $id = (string) $lastId;

        $sql = "INSERT INTO tbl_user (id, username, password, role) VALUES
                ($lastId, '$username','$pass','$role')";

        $q = $conn->query($sql);
    }
?>
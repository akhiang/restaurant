<?php
   require_once "../conn.php";

   $data = array();
   $sql = "SELECT * FROM tbl_user";
   $result = $conn->query($sql);

   foreach ($result as $row) {
      $sub_array = array();
      $sub_array[] = $row['id'];
      $sub_array[] = $row['username'];
      $sub_array[] = $row['password'];
      $sub_array[] = $row['role'];
      $sub_array[] = '
         <a href="#" class="edit-user badge badge-info mr-2" data-toggle="modal" data-target="#edit-user-modal" data-userId="'.$row["id"].'"><i class="fa fa-pencil-alt p-1"></i></a>
         <a href="#" class="del-user badge badge-danger" data-userId="'.$row["id"].'"><i class="fa fa-trash p-1"></i></a>
      ';
      $data[] = $sub_array;
   }
   
   $output = array(
      "data" => $data
   );
   echo json_encode($output);
?>
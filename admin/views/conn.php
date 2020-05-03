<?php
    $conn = mysqli_connect("localhost", "root", "", "restaurant");
    if(!$conn) {
        die("Connecttion failed: ".mysqli_connect_error());
    }

    function orderStatus($status){
        if($status == 'unpaid'){
            return '<span class="badge badge-warning">Unpaid</span>';
        } else if($status == 'paid') {
            return '<span class="badge badge-success">Paid</span>';
        } else {
            return '<span class="badge badge-secondary">Cancelled</span>';
        }
    }

    function reArray($arr) {
        foreach ($arr as $key => $value) {
            $array[] = $value['themonth'];
        }
        return $array;
    }

    function checkMonth($data, $months) {
        $diff = array_diff($months, $data);
        foreach ($diff as $key => $value) {
            $miss_month[]['themonth'] = $value;
        }
        return $miss_month;
    }

    function sortByDate($a, $b) {
        return strcmp($a["themonth"], $b["themonth"]);
    }
?>
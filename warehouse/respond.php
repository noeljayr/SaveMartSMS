<?php
include('../connect.php');

?>





<?php
    if(isset($_GET["action"])){
        if($_GET["action"] == "accept"){
           $id =  $_GET["req_id"];
           $p_id =  $_GET["p_id"];
           $quat = $_GET["quat"];

           $accept = "UPDATE request_data
           SET status = 'Accepted'
           WHERE req_id = $id;";
           $accept_result=mysqli_query($conn,$accept) or die("Data entry failed" .mysqli_error($conn));

           $add = "UPDATE `product_data` SET `quantity_available`= `quantity_available` + $quat  WHERE product_ID = $p_id";
           $add_result= mysqli_query($conn,$add) or die("Data entry failed" .mysqli_error($conn));

           header('Location: requests.php');
        }
    }
?>


<?php
    if(isset($_GET["action"])){
        if($_GET["action"] == "reject"){
           $id =  $_GET["req_id"];

           $accept = "UPDATE request_data
           SET status = 'Rejected'
           WHERE req_id = $id;";
           $accept_result=mysqli_query($conn,$accept) or die("Data entry failed" .mysqli_error($conn));

           header('Location: requests.php');
        }
    }
?>
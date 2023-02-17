<?php

include('../connect.php');

if(isset($_POST['signup'])){
    $id_num=$_POST['user_id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $gender=$_POST['optradio'];
    $role=$_POST['role'];
    $password= 1234;
    $status = "active";
    
    
    
    
        $query="INSERT INTO `users`(`user_id`, `firstName`, `lastName`,`gender`, `role`,`password`, `status`) 
                VALUES ('$id_num','$fname','$lname','$gender','$role','$password','$status')";
        $result=mysqli_query($conn,$query) or die("Data entry failed" .mysqli_error($conn));
        
    
        if($result){
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Registration successful'
            })</script>";
            header('Location: users.php');
        }
    } 
?>



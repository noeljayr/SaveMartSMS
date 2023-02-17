<?php
 session_start();
    
include('../connect.php');


if(isset($_POST['addp'])){

        $name = $_POST['name'];
        $qua = $_POST['quat'];
        $price = $_POST['price'];
        $p_id = $_POST['p_id'];


        if($qua < 0){
        

            $_SESSION['fmessage'] = "Quantity Cannot be less than 0!";
            $_SESSION['msg_type'] = "danger";
            header("Location: addproduct.php");
            
            
        }
        elseif($price < 0){
            
    
            $_SESSION['fmessage'] = "Price Cannot be less than 0!";
            $_SESSION['msg_type'] = "danger";
            header("Location: addproduct.php");
            
            
        }
        elseif(is_numeric($name)){
            $_SESSION['fmessage'] = "Name only contain numbers!";
            $_SESSION['msg_type'] = "danger";
            header("Location: addproduct.php");

        }
        
        else{

        
                
            $query="INSERT INTO `product_data`(`product_name`, `quantity_available`, `price`, `product_ID`) 
            VALUES ('$name','$qua','$price', '$p_id')";
            
            $result=mysqli_query($conn,$query) or die("Data entry failed" .mysqli_error($conn));
                    if($result){
                        $_SESSION['message'] = "Product added!";
                         $_SESSION['msg_type'] = "success";
                       header('Location: products.php');
                     }
                     

                        
                   

                           
                    //                 $_SESSION['fmessage'] = "Data entry failed either, product already in the database!";
                    //                  $_SESSION['msg_type'] = "danger";
                    //                 header('Location: products.php');
                            
                    //     }
    
                    //else end

        }

}





?>


<?php

if(isset($_POST['save'])){
    $product_id =  $_POST['id'];
    $quatity =  $_POST['quantity'];
    $p_name =  $_POST['product'];
    $price =  $_POST['price'];

    if($quatity < 0){
        

        $_SESSION['fmessage'] = "Quantity Cannot be less than 0!";
        $_SESSION['msg_type'] = "danger";
        header("Location: edit.php?action=edit&p_id=".$product_id."&quat=".$quatity."&p_name=".$p_name."&price=".$price);
        
        
    }
    elseif($price < 0){
        

        $_SESSION['fmessage'] = "Price Cannot be less than 0!";
        $_SESSION['msg_type'] = "danger";
        header("Location: edit.php?action=edit&p_id=".$product_id."&quat=".$quatity."&p_name=".$p_name."&price=".$price);
        
        
    }
    else{
        $update = "UPDATE product_data
        SET quantity_available  = $quatity, price = $price, product_name =  '$p_name'
        WHERE product_ID = $product_id;";
        $upresult=mysqli_query($conn,$update) or die("Data entry failed" .mysqli_error($conn));
    
        if($upresult){
            $_SESSION['message'] = "Update Successful!";
            $_SESSION['msg_type'] = "success";
            header('Location: products.php');
        }
        else{
            $_SESSION['message'] = "Failed!";
            $_SESSION['msg_type'] = "danger";
            header('Location: products.php');
        }

    }

    
    
    
}




?>
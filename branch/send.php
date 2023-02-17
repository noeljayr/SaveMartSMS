<?php 
      include('../connect.php');
      session_start();
    

      
      if(isset($_POST['send'])){

        
      
      
       for ($a = 0; $a < count($_POST["product_id"]); $a++)
       {
         $product_name  = $_POST['product_name'][$a];
         $quantity = $_POST['quantity'][$a];
         $product_id = $_POST['product_id'][$a];
         
         $query = "INSERT INTO request_data (product_id, quantity, status, user_id)
         SELECT * FROM (SELECT  $product_id, $quantity, 'Pending', 'save2') AS tmp
         WHERE NOT EXISTS (
             SELECT * FROM request_data WHERE product_id =  $product_id AND quantity = $quantity AND status = 'Pending' 
         )
         ";

         $result= mysqli_query($conn,$query) or die("Data entry failed" .mysqli_error($conn));

         if($result){
          $_SESSION['message'] = "Request Sent!";
          $_SESSION['msg_type'] = "success";
          header('Location: requests.php');
        }
        else{
          $_SESSION['message'] = "Failed!";
          $_SESSION['msg_type'] = "danger";
          header('Location: requests.php');
       }

         
       }

                
            
        }
      
      
      
      
      
?>

<?php

$page = 'products';
include('../inc/header.php');
include('./s_navigation.php');

if(isset($_POST['submit'])){
    $productName = $_POST['product'];
    $quantity = $_POST['quantity'];
    $reason = $_POST['reason'];

    $query = "SELECT * FROM product_data WHERE product_name = '$productName'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        $id = $row['product_ID'];
        $total = $quantity + $row['quantity_available'];
        if($reason == 'Good'){
            $sql = "UPDATE product_data SET quantity_available = '$total' WHERE Product_ID = '$id'";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        echo '<script>alert("success");</script>';
                    }
        }else{
            $query="INSERT INTO `product_return`(`product_ID`,`quantity`) 
                VALUES ('$id','$quantity')";
                $result=mysqli_query($conn,$query) or die("Data entry failed" .mysqli_error($conn));
                        if($result){
                            echo '<script>alert("success");</script>';
                        }
        }
    }
}

?>
<style>
    .panel{
        padding: 50px;
    }
</style>

<div class = "main">
            <div class="topbar">
                <div class="toggle">
                    <i class="fas fa-bars"></i>
                    
                </div>
                <div class="profile">
                    
                </div>
            </div>

                    <!-- MAIN CONTENT GOES HERE -->
                    <div class="card card-outline card-primary">
                    <div class="card-body">
                     <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="product">Product name</label>
                <input class="form-control" type="text" name="product" placeholder="Product name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input class="form-control" type="number" name="quantity" placeholder="Quantity" required>
            </div>
            <div class="form-group">
            <label for="sel1">Select the reason for return:</label>
            <select class="form-control" name="reason">
                <option value="Good">Good</option>
                <option value="Bad">Bad</option>
            </select>
            </div> 
            <div class="col-10">
                <button type="submit" class="btn btn-primary btn-md" name="submit">submit</button><br>
            </div>  
        </form>

     </div>

      
        
</div>








<script>
        let toggle = document.querySelector('.toggle')
        let myNavigation = document.querySelector('.myNavigation')
        let main = document.querySelector('.main')

        toggle.onclick = function(){
            myNavigation.classList.toggle('active')
            main.classList.toggle('active')
        }
  </script>

<?php include('../inc/footer.php');?>
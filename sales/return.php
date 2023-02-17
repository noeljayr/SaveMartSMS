<?php
$page = 'return';
include('../inc/header.php');
include('./s_navigation.php');
$pquery  = "SELECT product_ID, product_name FROM `product_data` ";
$presult = mysqli_query($conn, $pquery);


if(isset($_POST['submit'])){
    $productID = $_POST['product'];
    $quantity = $_POST['quantity'];
    $reason = $_POST['reason'];

    $query = "SELECT * FROM product_data WHERE product_ID = '$productID'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        $id = $row['product_ID'];
        $total = $quantity + $row['quantity_available'];
        if($reason == 'Good'){
            $sql = "UPDATE product_data SET quantity_available = '$total' WHERE Product_ID = '$id'";
                    $result = mysqli_query($conn, $sql);
            $query="INSERT INTO `product_return`(`product_ID`,`quantity`, `reason`) 
                VALUES ('$id','$quantity', '$reason')";
                $result=mysqli_query($conn,$query) or die("Data entry failed" .mysqli_error($conn));
                    if($result){
                        $_SESSION['message'] = "Return success!";
                         $_SESSION['msg_type'] = "success";
                    }
                    else{
                        $_SESSION['fmessage'] = "Failed!";
                         $_SESSION['msg_type'] = "danger";
                    }
        }else{
            $query="INSERT INTO `product_return`(`product_ID`,`quantity`, `reason`) 
            VALUES ('$id','$quantity', '$reason')";
                $result=mysqli_query($conn,$query) or die("Data entry failed" .mysqli_error($conn));
                        if($result){
                            $_SESSION['message'] = "Return success!";
                             $_SESSION['msg_type'] = "success";
                        }
                        else{
                            $_SESSION['fmessage'] = "Failed!";
                             $_SESSION['msg_type'] = "danger";
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
                <div class="navtitle">
                    <a href="index.php"> SaveMart Stock Management System: Sales Person</a>
                </div>
                <div class="profile">
                <div class="mydropdown">
                        <button class="link">
                        <div class="dropdown">
                        <button class="btn btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="name">
                            <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>
                            </span>    
                            
                        </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#logout" data-bs-toggle="modal" data-bs-target="#logoutmodal"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                         </ul>
                        </div>
                        </button>
                        
                    
                    
                </div>
            </div>

                   
            <?php
            if(isset( $_SESSION['message'])):
                ?>
                       <div class="alert alert-<?=$_SESSION['msg_type']?> d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle" style=" font-size: 20px"></i>
                    
                        <div style="padding-left: 10px">
                            <?php   echo $_SESSION['message'] ?>
                            <?php  unset($_SESSION['message'])  ?>
                        </div>
                        </div>

            <?php endif; ?>  
                    <!-- MAIN CONTENT GOES HERE -->
                    <div class="card card-outline card-primary">
     
     <div class="panel">
        <form action="" method="POST">
            <div style="width: 30%;" class="form-group">
               
                <input placeholder="Barcode"  class="form-control" type="text" name="product"> 
            </div>
            <div style="width: 30%;" class="form-group">
               
                <input min="1"  class="form-control" type="number" name="quantity" placeholder="Quantity" required>
            </div>
            <div style="width: 30%;" class="form-group">
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

      
        
</div>


    






<script>
        let toggle = document.querySelector('.toggle')
        let myNavigation = document.querySelector('.myNavigation')
        let main = document.querySelector('.main')
        let link = document.querySelector('.link')
        let mydropdown = document.querySelector('.mydropdown-menu')
        let main_content = document.querySelector('.main_content')
        let voidspace = document.querySelector(!'.mydropdown-menu')
        let nav = document.querySelector('.topbar')
        

        toggle.onclick = function(){
            myNavigation.classList.toggle('active')
            main.classList.toggle('active')
        }

        link.onclick = function(){
            mydropdown.classList.toggle('active')
            
        }


        main_content.onclick = function(){
            mydropdown.classList.remove('active')
            
            
            
        }
        
       
        
        
  </script>

<script>

    var select_box_element = document.querySelector('#select_box');

    dselect(select_box_element, {
        search: true
    });
    var select_box_element = document.querySelector('#wselect_box');

    dselect(select_box_element, {
        search: true
    });
</script>

    

<?php
include('../inc/footer.php');

?>
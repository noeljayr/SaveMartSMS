<?php
$page = 'products';
include('../inc/header.php');
include('./b_navigation.php');



?>

<div class = "main">
        <div class="topbar">
                <div class="toggle">
                    <i class="fas fa-bars"></i>
                    
                </div>
                <div class="navtitle">
                    <a href="index.php"> SaveMart Stock Management System: Branch Manager</a>
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


                    <!-- MAIN CONTENT GOES HERE -->
     <div class="main_content"> 
     <?php
            if(isset( $_SESSION['fmessage'])):
                ?>
                       <div class="alert alert-<?=$_SESSION['msg_type']?> d-flex align-items-center" role="alert">
                       
                        <i class="fas fa-exclamation-triangle"  style=" font-size: 20px"></i>
                    
                        <div style="padding-left: 10px">
                            <?php   echo $_SESSION['fmessage'] ?>
                            <?php  unset($_SESSION['fmessage'])  ?>
                        </div>
                        </div>

            <?php endif; ?>  
     <div class="card card-outline card-primary">
    
    <div class="card-header">

        <div class="card-tools">
        
            
        </div>
    </div>
    <div class="card-body">
    <div class="container">


<?php

if(isset($_GET["action"])){
    if($_GET["action"] == "edit"){
        
       $pro_name =   $_GET["p_name"];
       $quat = $_GET["quat"];
       $p_id =  $_GET["p_id"];
       $price =  $_GET["price"];

      ?>

      <form  action="manage_products.php" method="POST">

            <div class="input-group input-group-sm mb-3" style="width: 30%;">
                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width: 25%">Name     : </span>
                    <input type="text" name="product" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php  echo $pro_name ?>" required>
            </div>
                    <input   type="hidden" name="id"  value="<?php  echo $p_id ?>" > 


            <div class="input-group input-group-sm mb-3" style="width: 30%;">
                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width: 25%">Quantity : </span>
                    <input name= "quantity"type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php  echo $quat ?>" >
            </div>
            
            <div class="input-group input-group-sm mb-3" style="width: 30%;">
                    <span class="input-group-text" id="inputGroup-sizing-sm"  style="width: 25%">Price MK: </span>
                    <input step="any" name= "price"type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php  echo $price ?>" >
            </div>

            <div class="form-footer">
                <button type= "submit" name= "save" class="btn btn-primary btn-sm"> Save</button>
            </div>
      </form>

        <?php
        
       
    //    $accept = "UPDATE request_data
    //    SET status = 'Accepted'
    //    WHERE req_id = $id;";
    //    $accept_result=mysqli_query($conn,$accept) or die("Data entry failed" .mysqli_error($conn));

     
    

    }
    }




        ?>
           


       
   </div>

</div>

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


    

<?php
include('../inc/footer.php');

?>
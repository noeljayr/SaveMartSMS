<?php
$page = 'requests';
include('../inc/header.php');
include('./b_navigation.php');
$query  = "SELECT * FROM  product_data INNER JOIN request_data ON product_data.product_ID =  request_data.product_id"; 
$result = mysqli_query($conn, $query);



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
            <!-- add success message -->

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
     <div class="card card-outline card-primary">
    
    <div class="card-header">

        <div class="card-tools">
        
            <a href="./addrequest.php" class="btn btn-flat btn-sm btn-success" >
                 <span class="fas fa-plus"></span>    Add new
            </a>
        </div>
    </div>
    <div class="card-body">
    <div class="container">
        
            <div class="table-responsive-sm">

            <table id="products_data" class="table table-bordered table-sm" style="width:100%"> 
                <colgroup>
                        <col width="2%">
                        <col width="15%">
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
                     
                    </colgroup>
                        
                
                <thead>
                    <tr align="center">
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                       
                        <th>Date created</th>
                        <th>Status</th>
                       
                    </tr>
                </thead>
                <?php

                
                $row_num = 0;
                while($row = mysqli_fetch_array($result)){
                ?>     
                         <?php $row_num += 1;?>
                        <tr align="center">
                        <td><?php echo $row_num;  ?> </td>
                        <td><?php echo $row['product_name'];  ?> </td>
                        
                        <td><?php echo $row['quantity']; ?></td>
                      
                         <td><?php echo $row['date']; ?></td>
                         <td><?php
                        if($row['status'] == "Pending"): ?>

                            <span class="badge rounded-pill bg-warning text-dark">Pending</span>
                            
                        <?php endif; ?>

                        <?php
                        
                         
                        if($row['status'] == "Accepted"): ?>

                            <span class="badge rounded-pill bg-success text-light">Accepted</span>
                            
                        <?php endif; ?>


                        <?php
                        
                         
                        if($row['status'] == "Rejected"): ?>

                            <span class="badge rounded-pill bg-danger text-light">Rejected</span>
                            
                        <?php endif; ?>

                    </td>
                        
                       
                       

            <?php  }
          
          
            ?>

        
    
             </table>
            </div>
     
   

       
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
<?php
$page = 'products';




include('../inc/header.php');
include('./b_navigation.php');
$query  = "SELECT * FROM product_data ORDER BY product_id DESC"; 
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
                
                    <a href="./addproduct.php" class="btn btn-flat btn-sm btn-success">
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
                                <col width="5%">
                                <col width="10%">
                                <col width="5%">
                                <col width="1%">
                            </colgroup>
                                
                        
                        <thead>
                            <tr align="center">
                                <th>#</th>
                                <th>Name</th>
                                <th>Available</th>
                                <th>Price (MK)</th>
                                <th>Date addded</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php

                        
                        $row_num = 0;
                        while($row = mysqli_fetch_array($result)){
                        ?>     
                                <?php $row_num += 1;?>
                                <tr align="center">
                                <td><?php echo $row_num;  ?> </td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['quantity_available']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['date_added']; ?></td>
                                <td>
                                <?php 
                                if($row['quantity_available']< 50){

                                    echo("<h7> Out of stock </h7>");
                                    
                                }
                                else{
                                    
                                    echo("<h8>In stock </h8>");
                                }                    
                                 
                                ?>
                                </td>
                                <td>
                                <a href = "edit.php?action=edit&p_name=<?php echo $row["product_name"];?>&price=<?php echo $row["price"];?>&quat=<?php echo $row["quantity_available"];?>&p_id=<?php echo $row["product_ID"];?>" ><span class="btn"><span class="fa fa-edit text-primary"></span></span></a>
                                </td>
                  

                    <?php  }
                  
                  
                    ?>

                
            
                     </table>
                    </div>
                   
                   
                   

                <!-- Modal -->

                <form action="manage_products.php" name="addp"  method="POST"> 
                <div class="modal fade" id="addProducts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Product Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="modal-body">

                    
                                    <form role="form" action="" method="POST">
                                    
                                        <div class="form-group" class="name_input">
                                            <label>Name</label>
                                            <input class="form-control" type="text" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" type="text" name="quat" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input step="any" type="number"class="form-control" type="text" name="price" required>
                                        </div>
                                    </form>
                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="addp" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
  
                </form>
           </div>
		
    </div>
  
	</div>

     </div>

      
        
</div>


<?php

$req_query = "SELECT product_ID, product_name , quantity_available FROM product_data WHERE quantity_available < 50";
$req_result = $conn -> query($req_query);


if(mysqli_num_rows($req_result) > 0)  
{    
   while($req_row = mysqli_fetch_assoc($req_result))  
   {
   ?>
      
           <a>
               <div>
                   <?php $p_id = ($req_row['product_ID']); 
                   

                   $diff = 50 - $req_row['quantity_available'];


                  
               
                   $request = "INSERT INTO request_data (product_id, quantity, status, user_id)
                   SELECT * FROM (SELECT $p_id, $diff, 'Pending', 'save2') AS tmp
                   WHERE NOT EXISTS (
                       SELECT * FROM request_data WHERE product_id = $p_id AND quantity = $diff AND status = 'Pending'
                   )
                   ";
                   $send_result=mysqli_query($conn,$request) or die("Data entry failed" .mysqli_error($conn));

                   ?>
               </div>
           </a>
  
   <?php
   }
}


?>                                   




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
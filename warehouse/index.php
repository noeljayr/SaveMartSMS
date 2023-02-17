<?php
$page = 'index';
include('../inc/header.php');
include('./w_navigation.php');


?>

<div class = "main">
        <div class="topbar">
                <div class="toggle">
                    <i class="fas fa-bars"></i>
                    
                </div>
                <div class="navtitle">
                    <a href="index.php"> SaveMart Stock Management System: Warehouse Manager</a>
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
    
     <div class="container-fluid">
     <div class="card card-outline card-primary">
     
<hr>
<div  class="row " > 
    <div type = "button"  class="btn" class="col-12 col-sm-6 col-md-3" style=" width: 20%;">
    <a href="reports.php" style="text-decoration: none; color: black;">
    <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-chart-line"></i></span>

            <div class="info-box-content" >
            <span class="info-box-text">Reports</span>
            <span class="info-box-number text-right">
                           </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->


    </a>    
    
   
    </div>
    
    <div type = "button"  class="btn" class="col-12 col-sm-6 col-md-3"  data-bs-toggle="modal" data-bs-target="#requests_modal" style=" width: 20%;">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-primary elevation-1"><i class="far fa-calendar-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Requests</span>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php
                   

                   $query  = "SELECT product_data.product_name,product_data.product_ID, request_data.quantity, request_data.status, request_data.req_id, request_data.date, users.firstName, users.lastName FROM  product_data INNER JOIN request_data ON product_data.product_ID =  request_data.product_id  INNER JOIN users ON request_data.user_id = users.user_id WHERE request_data.status = 'Pending'"; 

                   $result = mysqli_query($conn, $query);
                  
                   $row = mysqli_num_rows($result);
                   echo $row;

            ?>
    <span class="visually-hidden">Pending</span></span>
            
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    
    <a type = "button"  class="btn" class="col-12 col-sm-6 col-md-3"  data-bs-toggle="modal" href="./products.php" style=" width: 20%;">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-boxes"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Products</span>
           
           
 
  
    
          
</div>
             
</div>
        
</a>
   
      
        
</div>


    
   <!--Requests notification Modal -->
   <div class="modal fade" id="requests_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pending Requests</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="table-responsive-sm">

<table id="products_data" class="table table-bordered table-sm" style="width:100%"> 
    <colgroup>
                        <col width="1%">
                        <col width="9%">
                        <col width="2%">
                        <col width="3%">
                        <col width="5%">
                        <col width="5%">
                        <col width="8%">
        </colgroup>
            
    
    <thead>
        <tr align="center">
            <th>#</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Date</th>
            <th>From</th>

            <th>Action</th>
        </tr>
    </thead>
    <?php

    $row_num = 0;
   
    while($row = mysqli_fetch_array($result)){
    ?>     
            <?php $row_num = $row_num + 1; ?>
            <tr align="center">
            <td><?php echo $row_num;  ?> </td>
            <td><?php echo $row['product_name'];  ?> </td>
            
            <td><?php echo $row['quantity']; ?></td>
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

            
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['firstName']. " ". $row['lastName']; ?></td>
            
           
            <td>
                <a class="btn btn-sm btn-success <?php if($row['status'] == "Rejected" or $row['status'] == "Accepted"){echo "disabled";}?>" href = "respond.php?action=accept&quat=<?php echo $row["quantity"];?>&p_id=<?php echo $row["product_ID"];?>&req_id=<?php echo $row["req_id"];?>">Accept</a>
                <a class="btn btn-sm btn-danger <?php if($row['status'] == "Rejected" or $row['status'] == "Accepted"){echo "disabled";}?>" href = "respond.php?action=reject&p_id=<?php echo $row["product_ID"];?> &req_id=<?php echo $row["req_id"];?>">Reject</a>
            </td>

<?php  }


?>



 </table>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div><div class="card-body">
                                <div class="container ">
                                    <?php
                                        
                                           
                                            $query = "SELECT sales.date, sales.quantity, product_data.product_name, product_data.price
                                            FROM sales
                                            INNER JOIN product_data
                                            ON sales.product_ID=product_data.product_ID WHERE sales.date";
                                            $result = mysqli_query($conn, $query);
                                            if($row = mysqli_num_rows($result) > 0){

                                            ?>
                                            <br/>
                                           
                                                <?php
                                                $i = 0; $total = 0;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $i++;  

                                                    $total += $row["quantity"] * $row["price"];
                                                $productName[] = $row['product_name'];
                                                    $quantity[] = $row['quantity'];
                                            ;
                                            ?>

                                        
                                                    <?php
                                                }
                                            } else{ echo '';}
                                        ?>
                                        
                                        <div >
                                            <canvas  id="myChart"></canvas>
                                        <?php
                                        

                                    ?>
            

  

                                    </div>
                                       
                            </div>
            </div>



    
   



   <script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productName); ?>,
            datasets: [{
                label: 'Sales',
                data: <?php echo json_encode($quantity); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 3
            }]
        },
        options: {
            //maintainAspectRatio: false,
            //responsive: true,
        }
    });
</script>
    
   <!--Requests notification Modal --> 
   </div></div>





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
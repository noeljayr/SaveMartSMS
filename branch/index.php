<?php
$page = 'index';
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


    <div type = "button"  class="btn" class="col-12 col-sm-6 col-md-3" style=" width: 20%;">
    <a href="requests.php" style="text-decoration: none; color: black;">
    <div class="info-box bg-light shadow">
    <span class="info-box-icon bg-primary elevation-1"><i class="far fa-calendar-alt"></i></span>

            <div class="info-box-content" >
            <span class="info-box-text">Requests</span>
            <span class="info-box-number text-right">
                           </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->


    </a>    
    
   
    </div>
    <div type = "button"  class="btn" class="col-12 col-sm-6 col-md-3"  data-bs-toggle="modal" data-bs-target="#products_modal" style=" width: 20%;">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-boxes"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Products</span>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php
                    $query  = "SELECT * FROM product_data WHERE quantity_available < 50"; 
                    $result = mysqli_query($conn, $query);
                    $counter = 0; 
                    $row = mysqli_num_rows($result);
                    echo $row;

                    $_SESSION['counter'] = $row;
                       
            ?>
 
  
    
          
</div>
             
</div>
        
</div>   <!--product notification Modal -->
      <div class="modal fade" id="products_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Out Of stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="table-responsive-sm">

<table id="products_data" class="table table-stripped table-sm" style="width:100%"> 
    <colgroup>
            <col width="2%">
            <col width="10%">
            <col width="5%">
            <col width="5%">
            <col width="5%">
            <col width="5%">
            <col width="1%">
        </colgroup>
            
    
    <thead>
        <tr >
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

    
    $counter = 0; 
    while($row = mysqli_fetch_array($result)){
    ?>     
            <?php $counter += 1 ?>
            <tr align="center">
            <td><?php echo $counter; ?></td>
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

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
   <!--product notification Modal --> 
<div class="card-body">
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
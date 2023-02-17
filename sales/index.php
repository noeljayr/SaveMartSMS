<?php
$page = 'index';
include('../inc/header.php');
include('./s_navigation.php');


?>

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


                    <!-- MAIN CONTENT GOES HERE -->
     <div class="main_content"> 
     <div class="container-fluid">
           
      


     <div class="card card-outline card-primary">
<hr>
<div  class="row " > 
<div type = "button"  class="btn" class="col-12 col-sm-6 col-md-3" style=" width: 20%;">
    <a href="pos.php" style="text-decoration: none; color: black;">
    <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tags"></i></span>

            <div class="info-box-content" >
            <span class="info-box-text">Point of Sale</span>
            <span class="info-box-number text-right">
                           </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->


    </a>    
    
   
    </div>


    <div type = "button"  class="btn" class="col-12 col-sm-6 col-md-3" style=" width: 20%;">
    <a href="return.php" style="text-decoration: none; color: black;">
    <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-undo"></i></span>

            <div class="info-box-content" >
            <span class="info-box-text">Return</span>
            <span class="info-box-number text-right">
                           </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->


    </a>    
    
   
    </div>
    <div type = "button"  class="btn" class="col-12 col-sm-6 col-md-3" style=" width: 20%;">
    <a href="reports.php" style="text-decoration: none; color: black;">
    <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-line"></i></span>

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
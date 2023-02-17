
    <div class="myContainer">
        <div class="myNavigation">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="img"><img src="../assests/smLogo1.png" alt="" width="30" height="30"></span>
                        <span class="title">SaveMart</span>
                    </a>
                </li>
                <li class="<?php if($page == 'index'){echo'active';}?>">
                    <a href="index.php">
                        <span class="icon"><i class="nav-icon fas fa-tachometer-alt"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li  class="<?php if($page == 'products'){echo'active';}?>">
                    <a href="products.php">
                        <span class="icon"><i class="nav-icon fas fa-boxes"></i></span>
                        <span class="title">Products<span class="badge rounded-pill bg-danger"  style="font-size: 9px;
                        margin-left: 9px;
                        
                        ">  

                <?php
                    $query  = "SELECT * FROM product_data WHERE quantity_available < 50"; 
                    $result = mysqli_query($conn, $query);
                    $counter = 0; 
                    $row = mysqli_num_rows($result);
                    echo $row;

                    $_SESSION['counter'] = $row;
                       
                ?>
                        </span></span>
                        
                    </a>
                </li>
          
                <li class="<?php if($page == 'requests'){echo'active';}?>">
                    <a href="requests.php">
                        <span class="icon"><i class="far fa-calendar-alt"></i></span>
                        <span class="title">Requests


                        <span class="badge rounded-pill bg-danger"  style="font-size: 9px;
                        margin-left: 9px;
                        
                        ">  

                <?php
                                       $query  = "SELECT * FROM  product_data INNER JOIN request_data ON product_data.product_ID =  request_data.product_id WHERE request_data.status = 'Pending'"; 
                 
                                       $result = mysqli_query($conn, $query);
                                      
                                       $row = mysqli_num_rows($result);
                                       echo $row;
                       
                ?>
                        </span>
                        </span>
                    </a>
                </li>
                <li class="<?php if($page == 'reports'){echo'active';}?>">
                    <a href="reports.php">
                        <span class="icon"><i class="fas fa-chart-line"></i></span>
                        <span class="title">Reports</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>     
     
    
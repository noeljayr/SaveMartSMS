
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
                <li  class="<?php if($page == 'users'){echo'active';}?>">
                    <a href="users.php">
                        <span class="icon"><i class="nav-icon fas fa-users"></i></span>
                        <span class="title">Users</span>

                <?php
                    $query  = "SELECT * FROM users"; 
                    $result = mysqli_query($conn, $query)        
                 ?>
                       
                        
                    </a>
                </li>
              
               
            </ul>
        </div>
        </div>     
     
    
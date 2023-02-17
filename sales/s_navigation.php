
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
          
                <li class="<?php if($page == 'pos'){echo'active';}?>">
                    <a href="pos.php">
                        <span class="icon"><i class="nav-icon fas fa-tags"></i></span>
                        <span class="title">Point of sale</span>
                    </a>
                </li>
                <li class="<?php if($page == 'return'){echo'active';}?>">
                    <a href="return.php">
                        <span class="icon"><i class="fas fa-undo"></i></span>
                        <span class="title">Return Products</span>
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
     
    
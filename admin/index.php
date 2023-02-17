<?php
$page = 'index';
include('../inc/header.php');
include('./ad_navigation.php');


?>

<div class = "main">
        <div class="topbar">
                <div class="toggle">
                    <i class="fas fa-bars"></i>
                    
                </div>
                <div class="navtitle">
                    <a href="index.php"> SaveMart Stock Management System: Administrator</a>
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
           
<hr>
<div  class="row " > 
<div type = "button"  class="btn" class="col-12 col-sm-6 col-md-3" style=" width: 20%;">
    <a href="users.php" style="text-decoration: none; color: black;">
    <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content" >
            <span class="info-box-text">Users</span>
            <span class="info-box-number text-right">
                           </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->


    </a>    
    
   
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
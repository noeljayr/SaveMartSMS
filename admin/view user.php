<?php

$page = 'users';
include('../inc/header.php');
include('./ad_navigation.php');

if(isset($_POST['signup'])){
    $id_num=$_POST['user_id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $gender=$_POST['optradio'];
    $role=$_POST['role'];
    $password= 1234;
    $status = "active";
    
    
    
    
        $query="INSERT INTO `users`(`user_id`, `firstName`, `lastName`,`gender`, `role`,`password`, `status`) 
                VALUES ('$id_num','$fname','$lname','$gender','$role','$password','$status')";
        $result=mysqli_query($conn,$query) or die("Data entry failed" .mysqli_error($conn));
        
    
        if($result){
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Registration successful'
            })</script>";
        }
    } 
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
         <h4><center>User details</center></h4>
     <?php
     $id = $_GET['user_id'];
        $page_query = "SELECT * FROM users WHERE user_id = '$id'";
        $page_result = mysqli_query($conn, $page_query);
        $row = mysqli_fetch_array($page_result);
            ?>
            <table class="table table-bordered" style="margin: 20px;">
                <tr>
                    <th>First name</th>
                    <td><?php echo $row['firstName'];?></td>
                </tr>
                <tr>
                    <th>Last name</th>
                    <td><?php echo $row['lastName'];?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?php echo $row['role'];?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php echo $row['status'];?></td>
                </tr>
            </table>
            <?php
     ?>


     </div>

      
        
</div>
</div>

    






<script>
        let toggle = document.querySelector('.toggle')
        let myNavigation = document.querySelector('.myNavigation')
        let main = document.querySelector('.main')

        toggle.onclick = function(){
            myNavigation.classList.toggle('active')
            main.classList.toggle('active')
        }
  </script>

  <script>

  
  var select_box_element = document.querySelector('#user');

  dselect(select_box_element, {
      search: false
  });
</script>
<?php
include('../inc/footer.php');

?>

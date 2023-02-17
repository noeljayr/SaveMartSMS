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

    if(isset($_GET['dis'])){
        $id = $_GET['dis'];
        $query = "SELECT * FROM users WHERE user_id = '$id'";
        $page_result = mysqli_query($conn, $query);
        if (mysqli_num_rows($page_result)>0) {
            $row = mysqli_fetch_array($page_result);

            $query="UPDATE users SET status='deactive' WHERE user_id = '$id'";
            $result=mysqli_query($conn,$query);
        }
    }
    
    if(isset($_GET['ena'])){
        $id = $_GET['ena'];
        $query = "SELECT * FROM users WHERE user_id = '$id'";
        $page_result = mysqli_query($conn, $query);
        if (mysqli_num_rows($page_result)>0) {
            $row = mysqli_fetch_array($page_result);

            $query="UPDATE users SET status='active' WHERE user_id = '$id'";
            $result=mysqli_query($conn,$query);
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
     <div class="card card-outline card-primary">
    
    <div class="card-header">

        <div class="card-tools">
        
            <button type="button" class="btn btn-flat btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#adduser">
            <span class="fas fa-plus"></span>    Add new
            </button>
        </div>
    </div>
    <div class="card-body">
    <div class="container">
        
            <div class="table-responsive-sm">

            <table id="user_data" class="table table-bordered table-sm" style="width:100%"> 
                
                
                <thead>
                <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <?php

                
               
$page_query = "SELECT * FROM users";
$page_result = mysqli_query($conn, $page_query);
                while($row = mysqli_fetch_array($page_result)){
                ?>     

                        <tr align="center">
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstName']; ?></td>
                        <td><?php echo $row['lastName']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td>

<?php
    if($row['status']=='active'){ ?>
        <a class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure to Disable?')" href="?dis=<?php echo $row['user_id']; ?>">Disable</a>
<?php } else{ ?>
        <a class="btn btn-sm btn-success" onclick="return confirm('Are You Sure to Enable?')" href="?ena=<?php echo $row['user_id']; ?>">Enable</a>
<?php } ?>
<a  class="btn btn-sm btn-info" href="view user.php?user_id=<?php echo $row['user_id']; ?>">View</a>
</td>
           

            
            <?php  }
          
               
            ?>

        
    
             </table>
            </div>
     
   

        <!-- Modal -->

        <form action="add.php" name="signup"  method="POST"> 
        <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="modal-body">
                            <form role="form" action="" method="POST">
                            
                                <div class="form-group" class="child1">
                                    <label>User ID</label>
                                    <input class="form-control" type="text" name="user_id" required>
                                </div>
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" class="form-control" type="text" name="fname" required>
                                </div>

                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" type="text" name="lname" required>
                                </div>
                                

                                <div class="form-group">
                                <label>Gender</label>
                                    <div class="rad">
                                    <input class="form-check-input" type="radio" name="optradio" value="Male">
                                    <label class="form-check-label">
                                       Male
                                    </label>
                              
                              
                                    <input class="form-check-input" type="radio" name="optradio" value="Female"  >
                                    <label class="form-check-label">
                                       Female
                                    </label>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role">Select role:</label>
                                    <select class="form-select form-select-sm" id="user" name="role">
                                        
                                    <option value="Salesperson">Salesperson</option>
                                        <option value="Branch Manager">Branch Manager</option>
                                        <option value="Warehouse Manager">Warehouse Manager</option>
                                       
                                        <option value="Administrator">Administrator</option>
                                    </select>
                             </div>
                               
                            </form>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="signup" class="btn btn-primary">Add user</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

        </form>
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

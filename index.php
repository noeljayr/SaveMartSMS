<?php
 include('connect.php');
 session_start();

 $_SESSION['copyright'] = "";
 ?>


<!doctype html>
<html lang="en">
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript"  src="../js/jquery/jquery-3.5.1.js"></script> 
    <script src="sweetalert2.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.css">
    <link rel="stylesheet" href="./signin.css">
    <title>SaveMart</title>
  

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <?php
         if(isset($_POST['login'])){
            $username = mysqli_real_escape_string($conn,$_POST['username']);
            $password = mysqli_real_escape_string($conn,$_POST['password']);
           
            
        $query = "SELECT * FROM users WHERE user_id='$username' AND password='$password' AND status = 'active'";
                $result=mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
              
                if(mysqli_num_rows($result)>0){
                    $_SESSION['userid']=$row['user_id'];
                    $_SESSION['fname']=$row['firstName'];
                    $_SESSION['lname']=$row['lastName'];
                    $_SESSION['role']=$row['role'];
                    if($row['role']=="Administrator"){
                        header('location:admin');
                    }elseif($row['role']=="Branch Manager"){
                        header('location:branch');
                    }elseif($row['role']=="Warehouse Manager"){
                        header('location:warehouse');
                    }elseif($row['role']=="Salesperson"){
                        header('location:sales/index.php');
                    }
               
                
                }else{
                  $_SESSION['fmessage'] = "Invalid username or password!";
                  $_SESSION['msg_type'] = "danger";
                 
                  
                   
            }
        }
    ?>
    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">

  
  <form method="POST" name="login">
    <img class="mb-4" src="./smLogo1.png" alt="" width="72" height="72">
    
    <h1 class="h3 mb-3 fw-normal">Login</h1>
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

        
    <div class="form-floating">
      <input type="text" class="form-control"   name="username" placeholder="Username" required>
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <div>
          <a href="reset pwrd.php">Forgot password</a>
      </div>
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit"  name="login">Login</button>
  
  </form>
  
</main>

<script src="js/bootstrap.min.js"></script>
    
  </body>
</html>

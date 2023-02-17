<?php
$page = 'reports';
include('../inc/header.php');
include('./w_navigation.php');
$rquery  = "SELECT product_data.product_name,product_data.product_ID, request_data.quantity, request_data.status, request_data.req_id, request_data.date, users.firstName, users.lastName FROM  product_data INNER JOIN request_data ON product_data.product_ID =  request_data.product_id  INNER JOIN users ON request_data.user_id = users.user_id WHERE request_data.status != 'Pending'"; 

$reqresult = mysqli_query($conn, $rquery);



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
                <div class="card card-outline card-primary">
                
                <div class="card-header">

<div class="card-tools">
         <div class="row align-items-end">
                    <form action="" method="post">
                        <div class="input-group input-group-sm mb-3" style="width: 30%;">
                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width: 25%">Start date: </span>
                            
                                <input class="form-control" type="text" name="start" value="<?php echo date('Y-m-d');?>">
                        </div>
                        
                        <div class="input-group input-group-sm mb-3" style="width: 30%;">
                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width: 25%">End date: </span>
                                
                                <input class="form-control" type="text" name="end"value=" <?php echo date('Y-m-d');?>">
                        </div>
         </div>
                        <button type="submit" class="btn btn-success" name="submit" >Search</button>
                        </form></div>
     </div>
                <div class="card-body">
                <div class="container">
                <canvas id="myChart"></canvas>
                        <div class="table-responsive-sm" style="padding-top: 60px;">

                        
                        </div>
                
            <hr style="width: 100%;">
                        <div class="container">
                <?php
                    if(isset($_POST['submit'])){
                        $start = $_POST['start'];
                            $end = $_POST['end'];
                        $s = "' $start'";   $y = "' $end'";
                        $query = "SELECT sales.date, sales.quantity, product_data.product_name, product_data.price
                        FROM sales
                        INNER JOIN product_data
                        ON sales.product_ID=product_data.product_ID WHERE sales.date >= $s AND  sales.date <= $y";
                        $result = mysqli_query($conn, $query);
                        if($row = mysqli_num_rows($result) > 0){

                        ?>
                        <br/>
                       
                        <table class="table table-bordered table-striped" style="margin: 10px; margin-right: 30px;" id="tblMembers">
                        <thead>
                        <h2>Sales Table</h2>
                        <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        </tr>
                        </thead>
                            <?php
                            $i = 0; $total = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $i++;  

                                $total += $row["quantity"] * $row["price"];
                            $productName[] = $row['product_name'];
                                $quantity[] = $row['quantity'];
                        echo '
                        <tr>
                            <td>'.$i.'</td>
                            <td>'.$row["product_name"].'</td>
                            <td>'.$row["quantity"].'</td> 
                            <td>'.$row["price"].'</td> 
                            <td>'.$row["price"]*$row["quantity"].'</td>
                            <td>'.$row["date"].'</td>
                        </tr>
                        ';
                        ?>

                    
                                <?php
                            }
                        } else{ echo 'failed';}
                    ?>
                    <tr>
                        
                        <th colspan="4">Total</th> 
                        <td><?php echo "K ".$total; ?></td>
                    </tr>
                    
                        </table>
                            
                    <div class="form-group" style="padding: 20px;">
                                <input type="button" id="btnExport" class="btn btn-info" value="PDF">
                            </div>

                        <div>
                            
                        <hr>
                        <table id="requests" class="table table-bordered table-sm" style="width:100%"> 
                        <colgroup>
                                <col width="2%">
                                <col width="12%">
                                <col width="5%">
                                <col width="5%">
                                <col width="10%">
                                <col width="5%">
                                <col width="1%">
                            </colgroup>
                                    
                            
                            <thead>
                            <h2>Request Table</h2>
                                <tr align="center">
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Date created</th>
                                    <th>From</th>
                                
                                </tr>
                            </thead>
                            <?php

                            
                            $row_num = 0;
                            while($row = mysqli_fetch_array($reqresult)){
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
                                    
                                
                                

                        <?php  }
                    
                    
                        ?>

                    
                
                        </table>

                        <hr>
                        <div class="returnData" style="padding-top: 2px;">
                            <?php
                                    $returnquery = "SELECT product_return.quantity,  product_return.date, product_data.product_name, product_return.reason FROM product_return INNER JOIN product_data ON product_return.product_ID=product_data.product_ID WHERE product_return.date BETWEEN $s and $y";
                                    $rresult = mysqli_query($conn, $returnquery);
                                    if($row = mysqli_num_rows($rresult) > 0){

                                        ?>
                                        <br/>
                                        <table class="table table-bordered table-striped" style="margin: 10px; margin-right: 30px;" id="tbs">
                                        <thead>
                                        <h2>Returned products Table</h2>
                                        <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                        </tr>
                                        </thead>
                                            <?php
                                            $i = 0;
                                            while ($row = mysqli_fetch_assoc($rresult)) {
                                                $i++;  
                
                                               
                                            $productName[] = $row['product_name'];
                                                $quantity[] = $row['quantity'];
                                        echo '
                                        <tr>
                                            <td>'.$i.'</td>
                                            <td>'.$row["product_name"].'</td>
                                            <td>'.$row["quantity"].'</td> 
                                            <td>'.$row["reason"].'</td> 
                                            <td>'.$row["date"].'</td>
                                        </tr>
                                        ';

                                        
                                        ?>
                                        
                                    
                                                <?php
                                            }
                                        } else{ echo 'lol';}
                                    ?>

                            
                                        </table>
                                        <div class="form-group" style="padding: 2px;">
                                <input type="button" id="btnExportreturn" class="btn btn-info" value="PDF">
                            </div>
                        </div>



                </div>
    
                    <?php
                    }

                ?>
               </div>
</div>
</div>
<script type="text/javascript" src="../pdfmake.min.js"></script>
<script type="text/javascript" src="../html2canvas.min.js"></script>
<script type="text/javascript">
$("body").on("click", "#btnExport", function () {
html2canvas($('#tblMembers')[0], {
onrendered: function (canvas) {
var data = canvas.toDataURL();
var allMembersDataInformation = {
    content: [{
        image: data,
        width: 500
    }]
};
pdfMake.createPdf(allMembersDataInformation).download("salesreport.pdf");
}
});
});

$("body").on("click", "#btnExportreturn", function () {
html2canvas($('#tbs')[0], {
onrendered: function (canvas) {
var data = canvas.toDataURL();
var allMembersDataInformation = {
    content: [{
        image: data,
        width: 500
    }]
};
pdfMake.createPdf(allMembersDataInformation).download("returned.pdf");
}
});
});
</script>



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




                       
                
            </div>

            </div>

            </div>
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
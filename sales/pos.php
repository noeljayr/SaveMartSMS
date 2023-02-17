<?php

$page = 'pos';
include('../inc/header.php');
include('./s_navigation.php');

if(isset($_POST['finish'])){
			
    $data = serialize($_SESSION['list']);
    $test = unserialize($data);
    $count = count($test);

    for($n=0; $n<$count;$n++){
    $query = "INSERT INTO sales(`product_ID`, `quantity`)
    VALUES ('{$test[$n]['p_id']}','{$test[$n]['p_quantity']}')";
    $result = mysqli_query($conn, $query) or die("failed " .mysqli_error($conn));
            if($result){
                  
                $_SESSION['message'] = "Done!";
                $_SESSION['msg_type'] = "success";
                unset($_SESSION["list"]);
                $update = "UPDATE product_data
                SET quantity_available = quantity_available -'{$test[$n]['p_quantity']}'
                WHERE product_ID = '{$test[$n]['p_id']}'";
                $upresult = mysqli_query($conn, $update) or die("failed " .mysqli_error($conn));
            }
          
    }
}

?>
<style>
    .panel{
        padding: 50px;
    }
</style>

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
  <?php
            if(isset( $_SESSION['message'])):
                ?>
                       <div class="alert alert-<?=$_SESSION['msg_type']?> d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle" style=" font-size: 20px"></i>
                    
                        <div style="padding-left: 10px">
                            <?php   echo $_SESSION['message'] ?>
                            <?php  unset($_SESSION['message'])  ?>
                        </div>
                        </div>

            <?php endif; ?>  
   
     <div class="card card-outline card-primary">
     <div class="card-header">

            <div class="card-tools"></div>
     </div>

     <div class="card-body">
     <div class="container">
         
     <div class="table-responsive-sm">
         <?php
         
                    $limit = 6;
					$page = '';
					if(isset($_GET['page'])){
						$page = $_GET['page'];
					}else{
						$page = 1;
					}
					$start_from = ($page - 1) * $limit;
					$query = "SELECT * FROM product_data LIMIT $start_from, $limit";
					$result = mysqli_query($conn, $query);
					if($row = mysqli_num_rows($result) > 0){
                        ?>
                        <div class="outer">
                           
                                <div class="rec">
                                <form action="" method="POST">
            <div class="table table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total price</th>
                    <th>Action</th>
                <tr>
                <?php 
                if(isset($_POST["add"])){
                    if(isset($_SESSION["list"])){
                        $item_array_id = array_column($_SESSION["list"],"product_ID");
                        if(!in_array($_GET["product_ID"],$item_array_id)){
                            $count = count($_SESSION["list"]);
                            $item_array = array(
                                'p_id' => $_GET['product_ID'],
                                'p_name' => $_POST['product_name'],
                                'p_price' => $_POST['price'],
                                'p_quantity' => $_POST['quantity']
                            );
                            $_SESSION["list"][$count] = $item_array;
                            //echo "<script>alert('Product is added to the cart')</script>";
                            //echo "<script>window.location = 'pos.php'</script>";
                            
                        }else{
                            echo "
                                <script>
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Product is already added to the list'
                                })</script>";
                            echo "<script>window.location = 'pos.php'</script>";
                        }
                    }else{
                        $item_array = array(
                                'p_id' => $_GET['product_ID'],
                                'p_name' => $_POST['product_name'],
                                'p_price' => $_POST['price'],
                                'p_quantity' => $_POST['quantity']
                            );
                            $_SESSION["list"][0] = $item_array;
                    } 
                }	
                    if(!empty($_SESSION["list"])){
                        $total = 0;
                        foreach($_SESSION["list"] as $key => $value){
                            ?>
                            <tr>
                                <?php $value["p_id"];?>
                                <td><?php echo $value["p_name"];?></td>
                                <td style="width: 0.2%;"><?php echo $value["p_quantity"];?></td>
                                <td><?php echo "K ".number_format($value["p_price"],2);?></td>
                                <td >K <?php echo number_format($value["p_price"]*$value["p_quantity"],2);?></td>
                                <td style="width: 0.2%;"><a href = "?action=delete&p_id=<?php echo $value["p_id"];?>"><span class="btn  btn-sm btn-danger">X</span></a></td>
                            </tr>
                            <?php
                            $total = $total + ($value["p_quantity"]*$value["p_price"]);
                        }
                            ?>
                            <tr>
                                <td colspan = "3" align = "right">Total</td>
                                <th align = "right">K <?php echo number_format($total,2);?></td>
                                <td></td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
            </div>
                <input type="submit" class="btn btn-primary" name="finish" onclick="PrintTable()"   value="Complete">
               
            </form>	
 <style id="table_style" type="text/css">
    
    table
    {
        border: 1px solid #ccc;
        border-collapse: collapse;
    }
    table th
    {
        background-color: #F7F7F7;
        color: #333;
        font-weight: bold;
    }
    table th, table td
    {
        padding: 5px;
        border: 1px solid #ccc;
    }
</style>

            </div>
    
                                </div>

                        </div>
                            <div class="tablePOS">
                            <form action="" method="POST" style="margin-bottom: 8px;">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm" name="search" placeholder="Scan Barcode">
                                            <div class="input-group-btn">
                                            <button class="btn btn-success" type="submit" name="submit" style="margin-top: 0px;"> 
                                            <i class="bi bi-upc-scan"></i>
                                            </button>
                                            </div>
                                            
                                        </div>
                                        
                                        </form> 
                                        <table class="table table-bordered table-sm" id="myList" style="width:100%">
                                                    <tr>
                                                        <th>Product name</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                    </tr>
                                                    <?php
                                            while($row = mysqli_fetch_assoc($result)){
                                                
                                                ?> 
                                                <form action="?action=add&product_ID=<?php echo $row['product_ID'];?>" method="POST">
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']?>" readonly></td>
                                                        <td style="width: 15%;"><input type="number" min="1" class="form-control" name="quantity" value="1"></td>
                                                        <td style="width: 20%;"><input type="text"  class="form-control" name="price" value="<?php echo $row['price']?>" readonly></td>
                                                        <td><input type="submit" class="btn btn-sm btn-primary" name="add" value="+"></td>
                                                    </tr>
                                                </form>		
                                                    
                                            <?php
                                                }?>
                                    </table>
                           
                        
                        
                    <?php
					}
					$page_query = "SELECT * FROM product_data";
					$page_result = mysqli_query($conn, $page_query);
					$total_records = mysqli_num_rows($page_result);
					$total_pages = ceil($total_records/$limit);
                    echo "<div class= 'paginationpos'>";
                    echo "<ul>";
					for($i=1;$i<=$total_pages;$i++){
						echo "
						<li><a href = 'pos.php?page=".$i."'>".$i."</a></li>
						";
					}
                    echo "</ul>";
                    echo "</div>";
					?>
			
            <div id="dvContents" class="receipt"  style="width: 60%; display: none; float: right;">
                            
                                <div class="rec">
                                <form action="" method="POST">
            <div  class="table table-responsive">
            <table id="dvContents"  class="table table-bordered table-striped">

            <colgroup>
                                
                                <col width="7%">
                                <col width="5%">
                                <col width="5%">
                               
            </colgroup>
                <tr>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                   
                    
                <tr>
                <?php 
                if(isset($_POST["adde"])){
                    if(isset($_SESSION["list"])){
                        $item_array_id = array_column($_SESSION["list"],"product_ID");
                        if(!in_array($_GET["product_ID"],$item_array_id)){
                            $count = count($_SESSION["list"]);
                            $item_array = array(
                                'p_id' => $_GET['product_ID'],
                                'p_name' => $_POST['product_name'],
                                'p_price' => $_POST['price'],
                                'p_quantity' => $_POST['quantity']
                            );
                            $_SESSION["list"][$count] = $item_array;
                            //echo "<script>alert('Product is added to the cart')</script>";
                            //echo "<script>window.location = 'pos.php'</script>";
                            
                        }else{
                            echo "
                                <script>
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Product is already added to the list'
                                })</script>";
                            echo "<script>window.location = 'pos.php'</script>";
                        }
                    }else{
                        $item_array = array(
                                'p_id' => $_GET['product_ID'],
                                'p_name' => $_POST['product_name'],
                                'p_price' => $_POST['price'],
                                'p_quantity' => $_POST['quantity']
                            );
                            $_SESSION["list"][0] = $item_array;
                    } 
                }	
                    if(!empty($_SESSION["list"])){
                        $total = 0;
                        foreach($_SESSION["list"] as $key => $value){
                            ?>
                            <tr>
                                <?php $value["p_id"];?>
                                <td><?php echo $value["p_name"];?></td>
                                <td style="width: 0.2%;"><?php echo $value["p_quantity"];?></td>
                                <td><?php echo "K ".number_format($value["p_price"],2);?></td>
                                
                                   </tr>
                            <?php
                            $total = $total + ($value["p_quantity"]*$value["p_price"]);
                        }
                            ?>
                            <tr>
                                <td colspan = "2" >Total</td>
                                <td align = "">K <?php echo number_format($total,2);?></td>
                               
                            </tr>
                            <tr>
                                <td colspan = "2" >Date</td>
                                <td align = ""> <p id="date"></p><script>
                                n =  new Date();
y = n.getFullYear();
m = n.getMonth() + 1;
d = n.getDate();
document.getElementById("date").innerHTML = m + "/" + d + "/" + y;</script></td>
                               
                            </tr>
                        <?php
                    }
                ?>
            </table>
            </div>
               
            </form>	
            </div>
    
                                </div>
            </div>
            <?php
            if(isset($_POST['submit'])){
             $query1 = $_POST['search'];
            $query = "SELECT * FROM product_data WHERE product_ID = '$query1'";
					$result = mysqli_query($conn, $query);
					if($row = mysqli_num_rows($result) > 0){
                        ?>
                        
                        <div class="table">
                            
                        </div>
                        <table class="table table-bordered table-sm" id="myList" style="width:100%">
                            <tr>
                                <th>Product name</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>   
                            <?php
					while($row = mysqli_fetch_assoc($result)){
						
                        ?> 
                        <form action="?action=add&product_ID=<?php echo $row['product_ID'];?>" method="POST">
							<tr>
                                <td><input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']?>" readonly></td>
                                <td><input type="number" class="form-control" name="quantity" min="1" value="1"></td>
                                <td><input type="text" class="form-control" name="price" value="<?php echo $row['price']?>" readonly></td>
                                <td><input type="submit" class="btn btn-sm btn-primary" name="add" value="Add"></td>
                            </tr>
                        </form>		
							
					<?php
						}?>
                        
                    </table>
                        
                        
                        <?php
					}
         }
         ?>
            </div>
     </div>
     </div>
     </div>
     </div>
</div>

<?php
    if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION["list"] as $key => $value){
                if($value["p_id"] == $_GET["p_id"]){
                    unset($_SESSION["list"][$key]);
                    //echo "<script>alert('Product removed')</script>";
                    echo "<script>window.location = 'pos.php'</script>"; 
                }
            }
        }
    }
?>

<script type="text/javascript">
    function PrintTable() {
        var printWindow = window.open('', '', 'height=200,width=400');
        printWindow.document.write('<html><head><title>SaveMart Receipt</title>');
 
        //Print the Table CSS.
        var table_style = document.getElementById("table_style").innerHTML;
        printWindow.document.write('<style type = "text/css">');
        printWindow.document.write(table_style);
        printWindow.document.write('</style>');
        printWindow.document.write('</head>');
 
        //Print the DIV contents i.e. the HTML Table.
        printWindow.document.write('<body>');
        var divContents = document.getElementById("dvContents").innerHTML;
        printWindow.document.write(divContents);
        printWindow.document.write('</body>');
 
        printWindow.document.write('</html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

<script>
        $(document).ready(function() {
        $('#receipt').DataTable(); 
       
   
} );
    </script>
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
    function printDiv() {
        var divToPrint = document.getElementById('printTable');
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.document.write('<link rel="stylesheet" type="text/css" href="path_to_your_css_file">') 
        newWin.print();
        newWin.close();
   }
</script>

<script>
    

    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myList tr td input").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });

</script>
<?php include('../inc/footer.php');?>
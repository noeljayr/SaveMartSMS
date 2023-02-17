<?php
$page = 'requests';
include('../inc/header.php');
include('./b_navigation.php');


$result = mysqli_query($conn, $query);
$wquery  = "SELECT user_id, firstName, lastName FROM `users` WHERE `role` = 'Warehouse Manager'";
$wresult = mysqli_query($conn, $wquery);

$pquery  = "SELECT product_ID, product_name FROM `product_data` ";
$presult = mysqli_query($conn, $pquery);

?>

<div class = "main">
        <div class="topbar">
                <div class="toggle">
                    <i class="fas fa-bars"></i>
                    
                </div>
                <div class="navtitle">
                    <a href="index.php"> SaveMart Stock Management System: Branch Manager</a>
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
        <h4 class="card-title">New Stock Refill request</h4>
    </div>
    <div class="card-body">
      
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="container-fluid">
                <div class="row">
               
                 <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                 <div class="container-fluid">
                    <div class="row">
                    <div class="col-md-6">
                        
                         
                            
                
                 </div>
                </div>
                <hr>
                <fieldset>
                    <legend class="text-info" style="font-size: 1.3rem; margin-left: 10px">Product Section</legend>
                    <div class="row align-items-end">
                           
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="item_id" class="control-label"> Product name</label>
                                <select class="form-select " class="product" name="pr_name[]" id="select_box">
                                <?php 
                                    while( $phouse = mysqli_fetch_array(
                                        $presult,MYSQLI_ASSOC)):;
                                    
                                ?>
                                
                                    <option value="<?php echo $phouse['product_ID']; ?>">
                                    <?php echo $phouse['product_name']; ?>
                                    </option>
                                <?php
                                    endwhile;
                                ?>
                            </select>
                            </div>
                        </div>
                        
                                
                         
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty" class="control-label">Quantity</label>
                                <input min="1" type="number" step="any" class="form-control rounded-0" name = "qty[]" id="qty" required>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="form-group">
                                <button  class="btn btn-flat btn-sm btn-primary" id="add_to_list" onclick="addtolist()">Add to List</button>
                            </div>
                        </div>
                </fieldset>
                <hr>

                <form action="./send.php" method="POST">
                            <table class="table  table-bordered" id="list" style="text-align: center;">
                        
                        <thead>
                            <tr class="text-dark bg-light">
                                <th class="text-center py-1 px-2"  style="width: 5%;"></th>
                                <th class="text-center py-1 px-2">Product</th>
                                <th class="text-center py-1 px-2">Quantity</th>
                                        
                            </tr>
                        </thead>
                        <tbody ></tbody>
                        
                        </table>
                                <div class="card-footer py-1 text-center">
                                        <button class="btn btn-flat btn-primary" type="submit" name="send">Send</button> 
                                        <a class="btn btn-flat btn-dark" href="./requests.php">Cancel</a>
                                </div>
                </form>
                
                  
                </div>
            </div>
       
    </div>
    
</div>

     </div>

      
        
</div>

          <form method="POST" action="">
         
 
    
</form>   
<script>
     
     const tbodyEl = document.querySelector("tbody");
     const tableEl = document.querySelector("table");

     function addtolist(){

       
       
        const name = document.querySelector('#select_box').selectedIndex;
        const name2 = document.getElementById("select_box").options;
        var product_name = name2[name].text;
        const product_id = document.getElementById("select_box").value;

       
        
        const quat = document.getElementById("qty").value;

        

        tbodyEl.innerHTML += `
            <tr>
                <td><button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button></td>
                <input class='form-control'id='input'type = 'hidden' name= 'product_id[]'value='${product_id}' readonly>
                <td><input class='form-control'id='input' name= 'product_name[]'value='${product_name}' readonly>
                </td>
                <td><input class='form-control'id='input' name= 'quantity[]' value='${quat}' readonly>
                </td>
                

              
            </tr>
        `;
            
        
     }

     function deleterow(e){
        if(!e.target.classList.contains('btn')){
            return;
        }
        const btn = e.target;
        btn.closest("tr").remove();
     }

     tableEl.addEventListener("click", deleterow);
    

</script> 

                    <!-- expand body script -->
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


                    <!-- select menu -->
<script>

    var select_box_element = document.querySelector('#select_box');

    dselect(select_box_element, {
        search: true
    });
    var select_box_element = document.querySelector('#wselect_box');

    dselect(select_box_element, {
        search: true
    });
</script>

    

<?php
include('../inc/footer.php');

?>
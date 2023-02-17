 






<!-- Logout Modal -->
<div class="modal fade" id="logoutmodal" tabindex="-1" aria-labelledby="logoutmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-muted" id="exampleModalLabel">Logout</h5>
        
        <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
        <h3>Are you sure you want to logout?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
        <a href="?action=logout" style="float: left" class="btn btn-danger">Yes</a>
      </div>
    </div>
  </div>
</div>
    <!-- logout modal -->



<script>
        $(document).ready(function() {
        $('#products_data').DataTable(); 
      
        $('#user_data').DataTable();

        $(document).ready(function() {
    $('#requests').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {   
                extend: 'print',
                messageTop: 'REQUESTS'
            }
        ]
    } );
} );
   
} );
    </script>

<script src="../js/dataTables.bootstrap5.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>  
</body>
</html>
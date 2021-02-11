<?php /* Template Name: Forgot Customer Template */ 
get_header(); ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-flex align-items-center">
            <h1>Forgot Customers</h1>
            <button type="button" class="ml-2 btn btn-primary send-email-multiple" style="display: none;">Send Email</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="all-customer" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><input type="checkbox" name="select_all" class="select-all"></th>
                      <th>Name</th>
                      <th>Emaiil</th>
                      <th>Phone</th>  
                      <th>Follow up Date</th>
                      <th>Sales Name</th>
                      <th>Follow up Progress</th>
                      <th>Priority</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th><input type="checkbox" name="select_all" class="select-all"></th>
                      <th>Name</th>
                      <th>Emaiil</th>
                      <th>Phone</th>  
                      <th>Follow up Date</th>
                      <th>Sales Name</th>
                      <th>Follow up Progress</th>
                      <th>Priority</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php

  $sales_users = get_users( array(
    'role__in' => array('sales')
  ) );

  $html = '';
  if( current_user_can('administrator') ){
    $html .= '<label>User: ';
    $html .= '<select class="form-control form-control-sm" style="display: inline-block;width: auto;margin: 0 10px;" name="sales_user" id="sales_user">';
      $html .= '<option value="all">All</option>';
      foreach ( $sales_users as $sales_user ) {
        $html .= '<option value="'.$sales_user->ID.'">'.$sales_user->display_name.'</option>';
      }
    $html .= '</select>';
    $html .= '</label>';
  }

?>
<div class="modal fade" id="view-discussions">
  <div class="modal-dialog modal-lg">
    <div class="modal-content card">
      <div class="modal-header">
        <h4 class="modal-title">Discussions</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body discussions-body">
        
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit-customer">
  <div class="modal-dialog modal-xl">
    <div class="modal-content card">
      <div class="modal-header">
        <h4 class="modal-title">Edit Customer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body edit-customer-body"></div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  (function($){

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    var all_customer = $("#all-customer").DataTable({
      "ordering": false,
      "lengthMenu": [10, 25, 50, 100],
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url":'<?php echo admin_url('admin-ajax.php'); ?>',
          "type": 'POST',
          "data": function ( d ) {
            d.action = 'get_all_customers';
            d.author = ( $('#sales_user').length && $('#sales_user option:selected').val() != '' ) ? $('#sales_user').find(":selected").val() : 'all';
            d.time   = 'past';
            d.time   = 'past';
            d.status = 'pending';
          }/*,beforeSend: function() {
              all_customer.settings()[0].jqXHR.abort()
          }*/
          //"data": {action:'get_all_customers',author:( $('#sales_user').length && $('#sales_user option:selected').val() != '' ) ? $('#sales_user').find(":selected").val() : 'all' }
      },
      drawCallback: function( settings ) {
        if( $('#sales_user').length < 1 ){
          var html = '<?php echo $html; ?>';
          $(html).prependTo(".dataTables_filter");
        }
      },
      initComplete: function( settings ) {
        $('.sorting_1').attr('colspan', 1);
      }
    });

    // setInterval( function () {
    //     all_customer.ajax.reload();
    // }, 3000 );

    $(document).on('change', '#sales_user', function() {
      console.log($('#sales_user').find(":selected").val());
      all_customer.ajax.reload();
    });

    $(document).on( "click" ,'.view-discussions', function(e){

      e.preventDefault();
      $this = $(this);

      $('#view-discussions').modal();
      $('.discussions-body').html('<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');

      $.ajax({
        type : "POST",
        dataType : "json",
        url : '<?php echo admin_url('admin-ajax.php'); ?>',
        data : {action: 'get_discussions',id:$this.data('id')},
        success: function(response) {
          $('.discussions-body').html(response.data.html);
        },error: function (request, status, error) {
          console.log(request.responseText);
          $('.discussions-body').html('');
        }
      });

    });

     $(document).on( "click" ,'.edit-customer', function(e){

      e.preventDefault();
      $this = $(this);

      $('#edit-customer').modal();
      $('.edit-customer-body').html('<div class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');

      $.ajax({
        type : "POST",
        dataType : "json",
        url : '<?php echo admin_url('admin-ajax.php'); ?>',
        data : {action: 'edit_customer',id:$this.data('id')},
        success: function(response) {
          $('.edit-customer-body').html(response.data.html);
        },error: function (request, status, error) {
          console.log(request.responseText);
          $('.edit-customer-body').html('');
        }
      });

    });

    $('#edit-customer').on('hidden.bs.modal', function () {
        all_customer.ajax.reload();
    });

    $(document).on( "click" ,'.delete-customer', function(e){
      e.preventDefault();
      $this = $(this);

      Swal.fire({
            text: "Are you sure you want to delete this customer?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText : 'No'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            type : "POST",
            dataType : "json",
            url : '<?php echo admin_url('admin-ajax.php'); ?>',
            data : {action: 'delete_customer',id:$this.data('id')},
            success: function(response) {
              if( response.success ){
                $this.parents('tr').fadeOut("normal", function() {
                    $(this).remove();
                });
                Toast.fire({
                  icon: 'success',
                  title: response.data.message
                });
                all_customer.ajax.reload();
              }else{
                Toast.fire({
                  icon: 'error',
                  title: response.data.message
                });
              }
            },error: function (request, status, error) {
              console.log(request.responseText);
            }
          });
        }else{
          return false;
        } 
      });

    });

    $(document).on( "click" ,'.send-email-single', function(e){
      
      e.preventDefault();
      $this = $(this);

      $($this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Sending...').prop('disabled', true);

        $.ajax({
          type : "POST",
          dataType : "json",
          url : '<?php echo admin_url('admin-ajax.php'); ?>',
          data : {action: 'send_email',id:$this.data('id')},
          success: function(response) {
            if( response.success ){
              Toast.fire({
                icon: 'success',
                title: response.data.message
              });
            }else{
              Toast.fire({
                icon: 'error',
                title: response.data.message
              });
            }
            $($this).html('Send Email').prop('disabled', false);
          },error: function (request, status, error) {
            console.log(request.responseText);
            $($this).html('Send Email').prop('disabled', false);
          }
        });
        
    });

    $(document).on('change','input:checkbox[name=customer_id]', function() {
      console.log('dsds');
        var customer_ids = $("input:checkbox[name=customer_id]:checked").map(function(){ return $(this).val() }).get();
        if( customer_ids.length > 0 ) {
          $('.send-email-multiple').show();
        }else{
          $('.send-email-multiple').hide();
        }
    });

    $(document).on( "click" ,'.send-email-multiple', function(e){
      
      e.preventDefault();
      $this = $(this);

      $($this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Sending...').prop('disabled', true);

        var customer_ids = $("input:checkbox[name=customer_id]:checked").map(function(){ return $(this).val() }).get();

        $.ajax({
          type : "POST",
          dataType : "json",
          url : '<?php echo admin_url('admin-ajax.php'); ?>',
          data : {action: 'send_email',id:customer_ids},
          success: function(response) {
            if( response.success ){
              Toast.fire({
                icon: 'success',
                title: response.data.message
              });
            }else{
              Toast.fire({
                icon: 'error',
                title: response.data.message
              });
            }
            $($this).html('Send Email').prop('disabled', false);
          },error: function (request, status, error) {
            console.log(request.responseText);
            $($this).html('Send Email').prop('disabled', false);
          }
        });
        
    });

    $('.select-all').click(function(){
      if($(this).prop("checked")) {
        $("input:checkbox[name=customer_id]").prop("checked", true);
      } else {
        $("input:checkbox[name=customer_id]").prop("checked", false);
      }
      var customer_ids = $("input:checkbox[name=customer_id]:checked").map(function(){ return $(this).val() }).get();
      if( customer_ids.length > 0 ) {
        $('.send-email-multiple').show();
      }else{
        $('.send-email-multiple').hide();
      }
    });

  })(jQuery);
</script>
<?php get_footer(); ?>

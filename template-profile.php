<?php /* Template Name: Profile Template */ 
get_header(); ?>
<style type="text/css">
  .form-group.required .col-form-label:after { 
    color: #d00;
    content: "*";
    position: absolute;
    margin-left: 8px;
    top:7px;
    font-family: 'Glyphicons Halflings';
    font-weight: normal;
    font-size: 14px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <?php $wp_get_current_user = wp_get_current_user(); ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <form class="form-horizontal" id="user-profile" method="post">
                <div class="form-group row required">
                  <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="<?php echo get_user_meta( $wp_get_current_user->ID, 'first_name', true ); ?>">
                  </div>
                </div>
                <div class="form-group row required">
                  <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="<?php echo get_user_meta( $wp_get_current_user->ID, 'last_name', true ); ?>">
                  </div>
                </div>
                <div class="form-group row required">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $wp_get_current_user->data->user_email; ?>">
                  </div>
                </div>
                <div class="form-group row required">
                  <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="phone" value="<?php echo get_user_meta( $wp_get_current_user->ID, 'phone', true ); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger" id="update-user-profile">Update profile</button>
                  </div>
                </div>
              </form>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
  
<script>
  (function($){

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $(document).ready(function(){

      var user_profile = $("#user-profile").validate({
        rules: {
          first_name: {
              required: true
          },
          last_name: {
              required: true
          },
          email: {
              required: true,
              email: true
          },
          phone: {
              required: true
          }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.parent().append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }

      });

      $(document).on('submit', '#user-profile', function(e) {
        
        e.preventDefault();

        $('#update-user-profile').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Updating profile...').prop('disabled', true);

        $.ajax({
              type : "POST",
              dataType : "json",
              url : '<?php echo admin_url('admin-ajax.php'); ?>',
              data : {
                action: 'update_user_profile',
                profile_data:$('#user-profile').serialize(),
                security : '<?php echo wp_create_nonce('security'); ?>'
              },
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
                $('#update-user-profile').html('Update profile').prop('disabled', false);
              },error: function (request, status, error) {
                console.log(request.responseText);
                $('#update-user-profile').html('Update profile').prop('disabled', false);
              }
          });
      });
    });

  })(jQuery);
</script>
<?php get_footer(); ?>

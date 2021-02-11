<?php /* Template Name: Forgot Password Template */ 
if( is_user_logged_in() ){
  wp_safe_redirect( home_url('/dashboard/') );
  exit();
}
get_header('login'); ?>

<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo home_url(); ?>"><b>Orolifestyle</b> Sales</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form method="post" id="forgot_password_form">
        <div class="alert alert-danger" role="alert" style="display: none;"></div>
        <div class="alert alert-success" role="alert" style="display: none;"></div>
        <div class="form-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" id="request_new_password">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?php echo home_url('/login/'); ?>">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script type="text/javascript">
  (function($){
    $(document).ready(function(){
      
      var forgot_password_form = $("#forgot_password_form").validate({
        rules: {
          email: {
              required: true,
              email: true
          }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }

      });

      $(document).on('submit', '#forgot_password_form', function(e) {

        e.preventDefault();

        $('#request_new_password').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Requesting...').prop('disabled', true);

        $this = $(this);
        $this.find('.alert-danger').html('').hide();
        $this.find('.alert-success').html('').hide();

        $.ajax({
            type : "POST",
            dataType : "json",
            url : '<?php echo admin_url('admin-ajax.php'); ?>',
            data : {
              action: 'request_new_password',
              forgot_password_data:$('#forgot_password_form').serialize(),
              security : '<?php echo wp_create_nonce('security'); ?>'
            },
            success: function(response) {
              if( response.success ){
                $this.find('.alert-success').html(response.data.message).show();
                $('.customer_form').trigger("reset");
              }else{
                $this.find('.alert-danger').html(response.data.message).show();
              }
              $('#request_new_password').html('Request new password').prop('disabled', false);
            },error: function (request, status, error) {
              console.log(request.responseText);
              $('#request_new_password').html('Request new password').prop('disabled', false);
          }
        });
      });

    });
  })(jQuery);
</script>
<?php get_footer('login'); ?>

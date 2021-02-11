<?php /* Template Name: Login Template */ 
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
      <p class="login-box-msg">Sign in</p>

      <form method="post" id="login_form">
        <div class="alert alert-danger" role="alert" style="display: none;"></div>
        <div class="form-group mb-3 email">
          <input type="email" class="form-control" placeholder="Email" name="email" required>
        </div>
        <div class="form-group mb-3 password">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
        <div class="row">
          <div class="col-6">
            <a href="<?php echo home_url('/forgot-password/'); ?>">I forgot my password</a>
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block" id="user_login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
<script type="text/javascript">
  (function($){
    $(document).ready(function(){
      
      var login_form = $("#login_form").validate({
        rules: {
          email: {
              required: true,
              email: true
          },
          password: { required: true },
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

      $(document).on('submit', '#login_form', function(e) {

        e.preventDefault();

        $('#user_login').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Sign In...').prop('disabled', true);

        $this = $(this);
        $this.find('.alert').html('').hide();

        $.ajax({
              type : "POST",
              dataType : "json",
              url : '<?php echo admin_url('admin-ajax.php'); ?>',
              data : {
                action: 'login_user',
                login_data:$('#login_form').serialize(),
                security : '<?php echo wp_create_nonce('security'); ?>'
              },
              success: function(response) {
                if( response.success ){
                  window.location.replace( response.data.redirect );
                }else{
                  $this.find('.alert').html(response.data.message).show();
                  $('#user_login').html('Sign In').prop('disabled', false);
                }
              },error: function (request, status, error) {
                console.log(request.responseText);
                $('#user_login').html('Sign In').prop('disabled', false);
            }
          });
      });

    });
  })(jQuery);
</script>
<?php get_footer('login'); ?>

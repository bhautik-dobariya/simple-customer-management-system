<?php /* Template Name: Email Settings Template */ 
get_header(); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-flex align-items-center">
            <h1>Email Settings</h1>
            <button type="button" class="ml-2 btn btn-primary send-email-to-all">Send Email To All</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  Email Template
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body pad">
                <div class="mb-3">
                  <form method="post" id="email-template-form">
                    <div class="form-group">
                      <label>From Email</label>
                      <input type="text" name="email_from" class="form-control" value="<?php echo get_option( 'email_from_'.get_current_user_id() ); ?>">
                    </div>
                    <div class="form-group">
                      <label>Subject</label>
                      <input type="text" name="email_subject" class="form-control" value="<?php echo get_option( 'email_subject_'.get_current_user_id() ); ?>">
                    </div>
                    <div class="form-group">
                      <label>Body</label>
                      <textarea class="textarea" name="email_template" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        <?php echo get_option( 'email_template_'.get_current_user_id() ); ?>
                      </textarea>
                      <button type="button" class="btn btn-primary save-email-template">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
  (function ($) {

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });


    $(document).ready(function($) {
      // Summernote
      $('.textarea').summernote({
        height:500,                 // set editor height
        minHeight: 500,             // set minimum height of editor
        maxHeight: 500,       
        disableResizeEditor: true,
        focus: true,
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['insert', ['link']],
        ]
      });

      $(document).on( "click" ,'.send-email-to-all', function(e){
      
        e.preventDefault();
        $this = $(this);

        $($this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Sending...').prop('disabled', true);

          var customer_ids = 'all';

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
              $($this).html('Send Email To All').prop('disabled', false);
            },error: function (request, status, error) {
              console.log(request.responseText);
              $($this).html('Send Email To All').prop('disabled', false);
            }
          });
          
      });

      $(document).on( "click" ,'.save-email-template', function(e){
      
        e.preventDefault();
        $this = $(this);

        $($this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Saving...').prop('disabled', true);

          $.ajax({
            type : "POST",
            dataType : "json",
            url : '<?php echo admin_url('admin-ajax.php'); ?>',
            data : {action: 'save_email_template',data:$('#email-template-form').serialize()},
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
              $($this).html('Save').prop('disabled', false);
            },error: function (request, status, error) {
              console.log(request.responseText);
              $($this).html('Save').prop('disabled', false);
            }
          });
          
      });

    });
  })(jQuery);
</script>
<?php get_footer(); ?>

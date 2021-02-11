<?php /* Template Name: Add Customer Template */ 
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
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Customer</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
              <form class="customer_form card card-body" method="post">
                 <div class="form-group row required">
                    <label for="name" class="col-sm-2 col-form-label">Name of Person :</label>
                    <div class="col-sm-3 mb-2 mb-md-0">
                       <input type="text" name="customer[first_name]" class="form-control" id="first_name" value="" placeholder="First Name">
                    </div>
                    <div class="col-sm-3 mb-2 mb-md-0">
                       <input type="text" name="customer[last_name]"  class="form-control" id="last_name" value="" placeholder="Last Name">
                    </div>
                    <div class="col-sm-3">
                       <input type="email" name="customer[email]" class="form-control" id="email" value="" placeholder="Email">
                    </div>
                 </div>
                 <div class="form-group row required">
                    <label for="primary_number" class="col-sm-2 col-form-label">Contact Number :</label>
                    <div class="col-sm-2 mb-2 mb-md-0">
                       <input type="text" class="form-control" name="customer[code]" id="code" placeholder="Code"> 
                    </div>
                    <div class="col-sm-4 mb-2 mb-md-0">
                       <input type="number" name="customer[primary_number]" class="form-control" id="primary_number" value="" placeholder="Primary Number">
                    </div>
                    <div class="col-sm-4">
                       <input type="number" name="customer[secondary_number]" class="form-control" id="secondary_number" value="" placeholder="Secondary Number">
                    </div>
                 </div>
                 <div class="space"></div>
                 <div class="form-group row">
                    <label for="business_name" class="col-sm-2 col-form-label">Organization & Business Name :</label>
                    <div class="col-sm-10">
                       <input type="text" name="customer[business_name]" class="form-control" id="business_name" value="">
                    </div>
                 </div>
                  <div class="form-group row">
                    <label for="designation" class="col-sm-2 col-form-label">Designation :</label>
                    <div class="col-sm-10">
                       <input type="text" name="customer[designation]" class="form-control" id="designation" value="">
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="gst_no" class="col-sm-2 col-form-label">GST No & Other Registration No :</label>
                    <div class="col-sm-10">
                       <input type="text" name="customer[gst_no]" class="form-control" id="gst_no" value="">
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="business_establishments_date" class="col-sm-2 col-form-label">Business Establishments Date :</label>
                    <div class="col-sm-10">
                       <input type="text" class="form-control datetimepicker-input" name="customer[business_establishments_date]" id="business_establishments_date" data-toggle="datetimepicker" data-target="#business_establishments_date"/>
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="address1" class="col-sm-2 col-form-label">Address 1 :</label>
                    <div class="col-sm-10">
                       <input type="text" name="customer[address1]" class="form-control" id="address1_first_line" value="">
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="address2" class="col-sm-2 col-form-label">Address 2 :</label>
                    <div class="col-sm-10">
                       <input type="text" name="customer[address2]" class="form-control" id="address2_first_line" value="">
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="business_types" class="col-sm-2">Business Types</label>
                    <div class="col-sm-10">
                      <?php
                      $business_types = get_terms( array(
                        'taxonomy' => 'business-types',
                        'hide_empty' => false
                      ) );
                      if ( ! empty( $business_types ) && ! is_wp_error( $business_type ) ){
                        foreach ( $business_types as $business_type ) { ?>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" name="category[<?php echo $business_type->taxonomy; ?>][]" type="checkbox" id="<?php echo $business_type->taxonomy; ?>_<?php echo $business_type->slug; ?>" value="<?php echo $business_type->term_id; ?>">
                            <label class="form-check-label" for="<?php echo $business_type->taxonomy; ?>_<?php echo $business_type->slug; ?>"><?php echo $business_type->name; ?></label>
                         </div>
                        <?php }
                      }?>
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="category" class="col-sm-12">Category :</label>
                    <label for="category" class="col-sm-2">1. Western :</label>
                    <div class="col-sm-10">
                      <?php
                      $westerns = get_terms( array(
                        'taxonomy' => 'western',
                        'hide_empty' => false
                      ) );
                      if ( ! empty( $westerns ) && ! is_wp_error( $westerns ) ){
                        foreach ( $westerns as $western ) { ?>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" name="category[<?php echo $western->taxonomy; ?>][]" type="checkbox" id="<?php echo $western->taxonomy; ?>_<?php echo $western->slug; ?>" value="<?php echo $western->term_id; ?>">
                            <label class="form-check-label" for="<?php echo $western->taxonomy; ?>_<?php echo $western->slug; ?>"><?php echo $western->name; ?></label>
                         </div>
                        <?php }
                      }?>
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="category" class="col-sm-2">2. Long Growns :</label>
                    <div class="col-sm-10">
                       <?php
                        $long_growns = get_terms( array(
                          'taxonomy' => 'long-growns',
                          'hide_empty' => false
                        ) );
                        if ( ! empty( $long_growns ) && ! is_wp_error( $long_growns ) ){
                          foreach ( $long_growns as $long_grown ) { ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="category[<?php echo $long_grown->taxonomy; ?>][]" type="checkbox" id="<?php echo $long_grown->taxonomy; ?>_<?php echo $long_grown->slug; ?>" value="<?php echo $long_grown->term_id; ?>">
                              <label class="form-check-label" for="<?php echo $long_grown->taxonomy; ?>_<?php echo $long_grown->slug; ?>"><?php echo $long_grown->name; ?></label>
                           </div>
                          <?php }
                        }?>
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="category" class="col-sm-2">3. Lahengas :</label>
                    <div class="col-sm-10">
                      <?php
                        $lahengas = get_terms( array(
                          'taxonomy' => 'lahengas',
                          'hide_empty' => false
                        ) );
                        if ( ! empty( $lahengas ) && ! is_wp_error( $lahengas ) ){
                          foreach ( $lahengas as $lahenga ) { ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="category[<?php echo $lahenga->taxonomy; ?>][]" type="checkbox" id="<?php echo $lahenga->taxonomy; ?>_<?php echo $lahenga->slug; ?>" value="<?php echo $lahenga->term_id; ?>">
                              <label class="form-check-label" for="<?php echo $lahenga->taxonomy; ?>_<?php echo $lahenga->slug; ?>"><?php echo $lahenga->name; ?></label>
                           </div>
                          <?php }
                       }?>
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="category" class="col-sm-2">4. Tops And T-Shirts :</label>
                    <div class="col-sm-10">
                      <?php
                        $tops_and_t_shirts = get_terms( array(
                          'taxonomy' => 'tops-and-t-shirts',
                          'hide_empty' => false
                        ) );
                        if ( ! empty( $tops_and_t_shirts ) && ! is_wp_error( $tops_and_t_shirts ) ){
                          foreach ( $tops_and_t_shirts as $tops_and_t_shirt ) { ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="category[<?php echo $tops_and_t_shirt->taxonomy; ?>][]" type="checkbox" id="<?php echo $tops_and_t_shirt->taxonomy; ?>_<?php echo $tops_and_t_shirt->slug; ?>" value="<?php echo $tops_and_t_shirt->term_id; ?>">
                              <label class="form-check-label" for="<?php echo $tops_and_t_shirt->taxonomy; ?>_<?php echo $tops_and_t_shirt->slug; ?>"><?php echo $tops_and_t_shirt->name; ?></label>
                           </div>
                          <?php }
                       }?>
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="category" class="col-sm-2">5. Kurtis :</label>
                    <div class="col-sm-10">
                      <?php
                        $kurtis = get_terms( array(
                          'taxonomy' => 'kurtis',
                          'hide_empty' => false
                        ) );
                        if ( ! empty( $kurtis ) && ! is_wp_error( $kurtis ) ){
                          foreach ( $kurtis as $kurti ) { ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="category[<?php echo $kurti->taxonomy; ?>][]" type="checkbox" id="<?php echo $kurti->taxonomy; ?>_<?php echo $kurti->slug; ?>" value="<?php echo $kurti->term_id; ?>">
                              <label class="form-check-label" for="<?php echo $kurti->taxonomy; ?>_<?php echo $kurti->slug; ?>"><?php echo $kurti->name; ?></label>
                           </div>
                          <?php }
                       }?>
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="category" class="col-sm-2">6. Shirts :</label>
                    <div class="col-sm-10">
                       <?php
                        $shirts = get_terms( array(
                          'taxonomy' => 'shirts',
                          'hide_empty' => false
                        ) );
                        if ( ! empty( $shirts ) && ! is_wp_error( $shirts ) ){
                          foreach ( $shirts as $shirt ) { ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="category[<?php echo $shirt->taxonomy; ?>][]" type="checkbox" id="<?php echo $shirt->taxonomy; ?>_<?php echo $shirt->slug; ?>" value="<?php echo $shirt->term_id; ?>">
                              <label class="form-check-label" for="<?php echo $shirt->taxonomy; ?>_<?php echo $shirt->slug; ?>"><?php echo $shirt->name; ?></label>
                           </div>
                          <?php }
                       }?>
                    </div>
                 </div>
                 <div class="form-group row">
                    <label for="special_requirements" class="col-sm-12 col-form-label">7. Special Requirements</label>
                    <div class="col-sm-12">
                       <textarea class="form-control" name="customer[special_requirements]" rows="4" id="special_requirements"></textarea>
                    </div>
                 </div>
                 <!-- <div class="form-group row">
                    <label for="code" class="col-sm-1 col-form-label">Code :</label>
                    <div class="col-sm-2">
                       <input type="text" class="form-control" name="customer[code]" id="code" value="">
                    </div>
                    <label for="wn" class="col-sm-1 col-form-label">WN.</label>
                    <div class="col-sm-3">
                       <input type="number" class="form-control" name="customer[wn]" id="wn" value="">
                    </div>
                 </div> -->
                 <div class="form-group discussions">
                   <div class="card card-body discussion"> 
                    <div class="form-group row">
                      <label for="discussion1" class="col-form-label">Discussion 01:</label> 
                   </div>
                   <div class="form-group row">
                      <label for="code" class="col-form-label">Date :</label>
                      <div class="col-sm-2">
                         <input type="text" class="form-control datetimepicker-input discussion-date" id="discussion-date1" name="customer[discussion][1][date]" data-toggle="datetimepicker" data-target="#discussion-date1" aria-invalid="false">
                      </div>
                      <label for="wn" class="col-form-label">Description.</label>
                      <div class="col-sm-8">
                         <textarea class="form-control" rows="4" name="customer[discussion][1][description]" id="discussion"></textarea>
                      </div>
                    </div>
                  </div>
                 </div>
                 <div class="form-group row">
                    <div class="col-sm-12">
                       <button class="btn btn-primary" type="button" id="add_more_discussions">Add more discussion</button>
                    </div>
                 </div>
                 <?php

                    $sales_users = get_users( array(
                      'role__in' => array('sales')
                    ) );

                  if( current_user_can('administrator') ){ ?>
                   <div class="form-group row">
                      <div class="col-sm-3">
                          <label>Sales User</label>
                          <select class="form-control" name="customer[author]">
                            <?php foreach ( $sales_users as $sales_user ) { ?>
                              <option value="<?php echo $sales_user->ID; ?>"><?php echo $sales_user->display_name; ?></option>
                            <?php } ?>
                          </select>
                      </div>
                      <div class="col-sm-3">
                          <label for="follow_up_date">Follow up Date :</label>
                          <input type="text" class="form-control datetimepicker-input" name="customer[follow_up_date]" id="follow_up_date" data-toggle="datetimepicker" data-target="#follow_up_date"/>
                      </div>
                   </div>
                  <?php }else{ ?>
                    <div class="form-group row">
                      <div class="col-sm-3">
                          <label for="follow_up_date">Follow up Date :</label>
                          <input type="text" class="form-control datetimepicker-input" name="customer[follow_up_date]" id="follow_up_date" data-toggle="datetimepicker" data-target="#follow_up_date"/>
                      </div>
                    </div>
                 <?php } ?>
                 <div class="form-group row required">
                    <div class="col-sm-3">
                        <label class="col-form-label">Priority</label>
                        <select class="form-control" name="customer[priority]">
                          <option value="high">High</option>
                          <option value="medium">Medium</option>
                          <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Status</label>
                        <select class="form-control" name="customer[status]">
                          <option value="pending">Pending</option>
                          <option value="complete">Complete</option>
                        </select>
                    </div>
                 </div>
                 <div class="form-group row">
                    <div class="col-sm-12">
                       <button class="btn btn-primary" type="submit" id="add_customer">Add customer</button>
                    </div>
                 </div>
              </form>
           </div>
        </div>
      </div>
    </section>
</div>
<script type="text/javascript">
  (function($){

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $.validator.setDefaults({ ignore: '' });

    $(document).ready(function(){

      var customer_form = $(".customer_form").validate({
        rules: {
          "customer[first_name]": {
              required: true
          },
          "customer[last_name]": {
              required: true
          },
          "customer[email]": {
              email: true
          },
          "customer[primary_number]": {
              required: true,
              maxlength: 10,
              minlength: 10
          },
          "customer[secondary_number]": {
              maxlength: 10,
              minlength: 10
          },
          "customer[follow_up_date]": {
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

      $(document).on('submit', '.customer_form', function(e) {

        e.preventDefault();

          $('#add_customer').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Adding customer...').prop('disabled', true);

          $.ajax({
            type : "POST",
            dataType : "json",
            url : '<?php echo admin_url('admin-ajax.php'); ?>',
            data : {
              action: 'add_customer',
              customer_data:$('.customer_form').serialize(),
              security : '<?php echo wp_create_nonce('security'); ?>'
            },
            success: function(response) {
              if( response.success ){
                Toast.fire({
                  icon: 'success',
                  title: response.data.message
                });
                $('.customer_form').trigger("reset");
              }else{
                Toast.fire({
                  icon: 'error',
                  title: response.data.message
                });
              }
              $('#add_customer').html('Add customer').prop('disabled', false);
            },error: function (request, status, error) {
              console.log(request.responseText);
              $('#add_customer').html('Add customer').prop('disabled', false);
            }
        });
         
      });

      /*$(document).on('blur','#primary_number, #secondary_number',function(){
        if( $(this).next('.invalid-phone-number').length ){
          $(this).addClass('is-invalid');
          $(this).next('.invalid-phone-number').show();
        }
      });

      $(document).on('keyup','#primary_number, #secondary_number',function(){
        check_phone_number($(this));
      });

      function check_phone_number($this){
        
        if( $this.val().length == 10 ){

          $this.next('.spinner-border').remove();
          $this.next('.invalid-phone-number').remove();
          $this.next('.invalid-phone-number').hide();
          $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').insertAfter($this)
          
          $.ajax({
            type : "POST",
            dataType : "json",
            url : '<?php //echo admin_url('admin-ajax.php'); ?>',
            data : {
              action: 'check_phone_number',
              security : '<?php //echo wp_create_nonce('security'); ?>',
              phone: $this.val()
            },
            success: function(response) {
              if( response.success ){
                $this.next('.spinner-border').remove();
                $this.next('.invalid-phone-number').remove();
              }else{
                $this.next('.spinner-border').remove();
                $this.next('.invalid-phone-number').remove();
                $this.next('.invalid-phone-number').hide();
                $this.addClass('is-invalid');
                $('<span class="error invalid-feedback invalid-phone-number">'+response.data.message+'</span>').insertAfter($this)
                $this.next('.invalid-phone-number').show();
              }
              
            },error: function (request, status, error) {
              console.log(request.responseText);
            }
          });
        }else{
          $this.next('.invalid-phone-number').remove();
        } 
      }*/

    //Date time picker
    $('#business_establishments_date').datetimepicker({
      format: 'DD-MM-YYYY'
    });

    //Date time picker
    $('#follow_up_date').datetimepicker({
      sideBySide: true,
      format: 'DD-MM-YYYY hh:mm A'
    });

    //Date time picker
    $('.discussion-date').datetimepicker({
      sideBySide: true,
      format: 'DD-MM-YYYY hh:mm A'
    });

    var i = $('.discussion').length;

    $('#add_more_discussions').click(function() {

      if( $('.discussion').length < 7 ){
        i++;
        var html = '<div class="card card-body discussion">';
              html += '<div class="form-group row">';
                html += '<label for="discussion'+i+'" class="col-form-label">Discussion 0'+i+':</label>';
              html += '</div>';
              html += '<div class="form-group row">';
                  html += '<label for="code" class="col-form-label">Date :</label>';
                  html += '<div class="col-sm-2">';
                     html += '<input type="text" class="form-control datetimepicker-input discussion-date" id="discussion-date'+i+'" name="customer[discussion]['+i+'][date]" data-toggle="datetimepicker" data-target="#discussion-date'+i+'" aria-invalid="false">';
                  html += '</div>';
                  html += '<label for="wn" class="col-form-label">Description.</label>';
                  html += '<div class="col-sm-8">';
                     html += '<textarea class="form-control" rows="4" name="customer[discussion]['+i+'][description]" id="discussion"></textarea>';
                  html += '</div>';
              html += '</div>';
            html += '</div>';

          $('.discussions').append(html);

          //$(html).insertBefore();
          
          //Date time picker
          $('#discussion-date'+i).datetimepicker({
            sideBySide: true,
            format: 'DD-MM-YYYY hh:mm A'
          });
      }
      
    });

  });

})(jQuery);
</script>
<?php get_footer(); ?>

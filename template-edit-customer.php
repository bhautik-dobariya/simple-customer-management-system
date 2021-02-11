<?php /* Template Name: Edit Customer Template */ 
get_header(); 
$id = get_query_var('id');
if( $id == '' || empty( get_post( $id ) ) ){ ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-3">
            <div class="card bg-danger">
              <div class="card-body">
                Sorry, this customer is not available in system.
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
<?php } else{ ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Customer - <?php echo get_the_title( $id ); ?></h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
             <div class="col-sm-12">
                <form class="customer_form card card-body" method="post">
                   <div class="form-group row">
                      <label for="name" class="col-sm-2 col-form-label">Name of Person :</label>
                      <div class="col-sm-3 mb-2 mb-md-0">
                         <input type="text" name="customer[first_name]" class="form-control" id="first_name" value="<?php echo get_post_meta( $id, 'first_name', true ); ?>" placeholder="First Name">
                      </div>
                      <div class="col-sm-3 mb-2 mb-md-0">
                         <input type="text" name="customer[last_name]"  class="form-control" id="last_name" value="<?php echo get_post_meta( $id, 'last_name', true ); ?>" placeholder="Last Name">
                      </div>
                      <div class="col-sm-3">
                         <input type="email" name="customer[email]" class="form-control" id="email" value="<?php echo get_post_meta( $id, 'email', true ); ?>" placeholder="Email">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="designation" class="col-sm-2 col-form-label">Designation :</label>
                      <div class="col-sm-10">
                         <input type="text" name="customer[designation]" class="form-control" id="designation" value="<?php echo get_post_meta( $id, 'designation', true ); ?>">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="primary_number" class="col-sm-2 col-form-label">Contact Number :</label>
                      <div class="col-sm-5 mb-2 mb-md-0">
                         <input type="number" name="customer[primary_number]" class="form-control" id="primary_number" value="<?php echo get_post_meta( $id, 'primary_number', true ); ?>" placeholder="Primary Number">
                      </div>
                      <div class="col-sm-5">
                         <input type="number" name="customer[secondary_number]" class="form-control" id="secondary_number" value="<?php echo get_post_meta( $id, 'secondary_number', true ); ?>" placeholder="Secondary Number">
                      </div>
                   </div>
                   <div class="space"></div>
                   <div class="form-group row">
                      <label for="business_name" class="col-sm-2 col-form-label">Organization & Business Name :</label>
                      <div class="col-sm-10">
                         <input type="text" name="customer[business_name]" class="form-control" id="business_name" value="<?php echo get_post_meta( $id, 'business_name', true ); ?>">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="gst_no" class="col-sm-2 col-form-label">GST No & Other Registration No :</label>
                      <div class="col-sm-10">
                         <input type="text" name="customer[gst_no]" class="form-control" id="gst_no" value="<?php echo get_post_meta( $id, 'gst_no', true ); ?>">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="business_establishments_date" class="col-sm-2 col-form-label">Business Establishments Date :</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control datetimepicker-input" name="customer[business_establishments_date]" id="business_establishments_date" data-toggle="datetimepicker" data-target="#business_establishments_date" value=""/>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="address1" class="col-sm-2 col-form-label">Address 1 :</label>
                      <div class="col-sm-10">
                         <input type="text" name="customer[address1]" class="form-control" id="address1_first_line" value="<?php echo get_post_meta( $id, 'address1', true ); ?>">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="address2" class="col-sm-2 col-form-label">Address 2 :</label>
                      <div class="col-sm-10">
                         <input type="text" name="customer[address2]" class="form-control" id="address2_first_line" value="<?php echo get_post_meta( $id, 'address2', true ); ?>">
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
                          $business_types_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'business-types' ));
                          foreach ( $business_types as $business_type ) { 
                            $checked = ( !empty( $business_types_selected ) && in_array( $business_type->term_id, $business_types_selected ) ) ? "checked" : "" ;
                            ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="category[<?php echo $business_type->taxonomy; ?>][]" type="checkbox" id="<?php echo $business_type->taxonomy; ?>_<?php echo $business_type->slug; ?>" value="<?php echo $business_type->term_id; ?>" <?php echo $checked; ?>>
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
                          $western_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'western' ));
                          foreach ( $westerns as $western ) { 
                            $checked = ( !empty( $western_selected ) && in_array( $western->term_id, $western_selected ) ) ? "checked" : "" ;
                            ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="category[<?php echo $western->taxonomy; ?>][]" type="checkbox" id="<?php echo $western->taxonomy; ?>_<?php echo $western->slug; ?>" value="<?php echo $western->term_id; ?>" <?php echo $checked; ?>>
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
                            $long_growns_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'long-growns' ));
                            foreach ( $long_growns as $long_grown ) { 
                              $checked = ( !empty( $long_growns_selected ) && in_array( $long_grown->term_id, $long_growns_selected ) ) ? "checked" : "" ;
                              ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[<?php echo $long_grown->taxonomy; ?>][]" type="checkbox" id="<?php echo $long_grown->taxonomy; ?>_<?php echo $long_grown->slug; ?>" value="<?php echo $long_grown->term_id; ?>" <?php echo $checked; ?>>
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
                            $lahengas_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'lahengas' ));
                            foreach ( $lahengas as $lahenga ) { 
                              $checked = ( !empty( $lahengas_selected ) && in_array( $lahenga->term_id, $lahengas_selected ) ) ? "checked" : "" ;
                              ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[<?php echo $lahenga->taxonomy; ?>][]" type="checkbox" id="<?php echo $lahenga->taxonomy; ?>_<?php echo $lahenga->slug; ?>" value="<?php echo $lahenga->term_id; ?>" <?php echo $checked; ?>>
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
                            $tops_and_t_shirts_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'tops-and-t-shirts' ));
                            foreach ( $tops_and_t_shirts as $tops_and_t_shirt ) { 
                              $checked = ( !empty( $tops_and_t_shirts_selected ) && in_array( $tops_and_t_shirt->term_id, $tops_and_t_shirts_selected ) ) ? "checked" : "" ;
                              ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[<?php echo $tops_and_t_shirt->taxonomy; ?>][]" type="checkbox" id="<?php echo $tops_and_t_shirt->taxonomy; ?>_<?php echo $tops_and_t_shirt->slug; ?>" value="<?php echo $tops_and_t_shirt->term_id; ?>" <?php echo $checked; ?>>
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
                            $kurtis_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'kurtis' ));
                            foreach ( $kurtis as $kurti ) { 
                              $checked = ( !empty( $kurtis_selected ) && in_array( $kurti->term_id, $kurtis_selected ) ) ? "checked" : "" ;
                              ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[<?php echo $kurti->taxonomy; ?>][]" type="checkbox" id="<?php echo $kurti->taxonomy; ?>_<?php echo $kurti->slug; ?>" value="<?php echo $kurti->term_id; ?>" <?php echo $checked; ?>>
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
                            $shirts_selected = array_map(function ( $arr ) { return $arr->term_id; }, get_the_terms( $id, 'shirts' ));
                            foreach ( $shirts as $shirt ) {
                              $checked = ( !empty( $shirts_selected ) && in_array( $shirt->term_id, $shirts_selected ) ) ? "checked" : "" ;
                              ?>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="category[<?php echo $shirt->taxonomy; ?>][]" type="checkbox" id="<?php echo $shirt->taxonomy; ?>_<?php echo $shirt->slug; ?>" value="<?php echo $shirt->term_id; ?>" <?php echo $checked; ?>>
                                <label class="form-check-label" for="<?php echo $shirt->taxonomy; ?>_<?php echo $shirt->slug; ?>"><?php echo $shirt->name; ?></label>
                             </div>
                            <?php }
                         }?>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="special_requirements" class="col-sm-12 col-form-label">7. Special Requirements</label>
                      <div class="col-sm-12">
                         <textarea class="form-control" name="customer[special_requirements]" rows="4" id="special_requirements"><?php echo get_post_meta( $id, 'special_requirements', true ); ?></textarea>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="code" class="col-sm-1 col-form-label">Code :</label>
                      <div class="col-sm-5">
                         <input type="text" class="form-control" name="customer[code]" id="code" value="<?php echo get_post_meta( $id, 'code', true ); ?>">
                      </div>
                      <label for="wn" class="col-sm-1 col-form-label">WN.</label>
                      <div class="col-sm-5">
                         <input type="number" class="form-control" name="customer[wn]" id="wn" value="<?php echo get_post_meta( $id, 'wn', true ); ?>">
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="follow_up_date" class="col-sm-1 col-form-label">Follow up Date :</label>
                      <div class="col-sm-5">
                         <input type="text" class="form-control datetimepicker-input" name="customer[follow_up_date]" id="follow_up_date" data-toggle="datetimepicker" data-target="#follow_up_date" value="" />
                      </div>
                   </div>
                   <div class="form-group discussions">

                      <?php

                      // global $wpdb;

                      // $table = $wpdb->prefix.'customer_dicussion';

                      $customer_dicussion = get_post_meta( $id, 'discussions', true );

                      if( !empty( $customer_dicussion ) ){
                        foreach ($customer_dicussion as $key => $dicussion) { ?>

                        <div class="card card-body discussion"> 
                          <div class="form-group row">
                            <label for="discussion<?php echo $key; ?>" class="col-form-label">Discussion 0<?php echo $key; ?>:</label> 
                         </div>
                         <div class="form-group row">
                            <label for="code" class="col-form-label">Date :</label>
                            <div class="col-sm-2">
                               <input type="text" class="form-control datetimepicker-input discussion-date" id="discussion-date<?php echo $key; ?>" name="customer[discussion][<?php echo $key; ?>][date]" data-toggle="datetimepicker" data-target="#discussion-date<?php echo $key; ?>" aria-invalid="false">
                            </div>
                            <label for="wn" class="col-form-label">Description.</label>
                            <div class="col-sm-9">
                               <textarea class="form-control" rows="4" name="customer[discussion][<?php echo $key; ?>][description]" id="discussion"><?php echo $dicussion['description']; ?></textarea>
                            </div>
                          </div>
                        </div>

                      <?php } } else{  ?>
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
                            <div class="col-sm-9">
                               <textarea class="form-control" rows="4" name="customer[discussion][1][description]" id="discussion"></textarea>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
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
                              <option value="<?php echo $sales_user->ID; ?>" <?php echo $sales_user->ID == get_post_field( 'post_author', $id ) ? 'selected' : '' ; ?>><?php echo $sales_user->display_name; ?></option>
                            <?php } ?>
                          </select>
                      </div>
                   </div>
                  <?php } ?>
                   <div class="form-group row required">
                    <div class="col-sm-3">
                        <label>Priority</label>
                        <select class="form-control" name="customer[priority]">
                          <option value="high" <?php echo get_post_meta( $id, 'priority', true ) == 'high' ? 'selected' : '' ; ?>>High</option>
                          <option value="medium" <?php echo get_post_meta( $id, 'priority', true ) == 'medium' ? 'selected' : '' ; ?>>Medium</option>
                          <option value="low" <?php echo get_post_meta( $id, 'priority', true ) == 'low' ? 'selected' : '' ; ?>>Low</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Status</label>
                        <select class="form-control" name="customer[status]">
                          <option value="pending" <?php echo get_post_meta( $id, 'status', true ) == 'pending' ? 'selected' : '' ; ?>>Pending</option>
                          <option value="complete" <?php echo get_post_meta( $id, 'status', true ) == 'complete' ? 'selected' : '' ; ?>>Complete</option>
                        </select>
                    </div>
                 </div>
                   <div class="form-group row">
                      <div class="col-sm-12"> 
                        <button class="btn btn-primary" type="submit" id="update_customer">Update customer</button>
                      </div>
                   </div>
                   <input type="hidden" name="id" value="<?php echo $id; ?>">
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
              required: true
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

        $('#update_customer').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Updating customer...').prop('disabled', true);

        $.ajax({
              type : "POST",
              dataType : "json",
              url : '<?php echo admin_url('admin-ajax.php'); ?>',
              data : {
                action: 'edit_customer',
                customer_data:$('.customer_form').serialize(),
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
                $('#update_customer').html('Update customer').prop('disabled', false);
              },error: function (request, status, error) {
                console.log(request.responseText);
                $('#update_customer').html('Update customer').prop('disabled', false);
              }
          });
      });
    });

    //Date time picker
    $('#business_establishments_date').datetimepicker({
      format: 'DD-MM-YYYY'
    });

    $('#business_establishments_date').val('<?php echo get_post_meta( $id, 'business_establishments_date', true ); ?>');

    //Date range picker
    $('#follow_up_date').datetimepicker({
      sideBySide: true,
      format: 'DD-MM-YYYY hh:mm A'
    });

    $('#follow_up_date').val('<?php echo date('d-m-Y h:i A', get_post_meta( $id, 'follow_up_date', true ) ); ?>');

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
                  html += '<div class="col-sm-9">';
                     html += '<textarea class="form-control" rows="4" name="customer[discussion]['+i+'][description]" id="discussion"></textarea>';
                  html += '</div>';
              html += '</div>';
            html += '</div>';

          $('.discussions').append(html);

          //$(html).insertBefore();
          
          console.log(i);
          //Date time picker
          $('#discussion-date'+i).datetimepicker({
            sideBySide: true,
            format: 'DD-MM-YYYY hh:mm A'
          });
      }
      
    });

    <?php if( !empty( $customer_dicussion ) ){
      foreach ($customer_dicussion as $key => $dicussion) { ?>
        $('#discussion-date<?php echo $key; ?>').datetimepicker({
          sideBySide: true,
          format: 'DD-MM-YYYY hh:mm A'
        });
        $('#discussion-date<?php echo $key; ?>').val('<?php echo date('d-m-Y h:i A', $dicussion['date'] ); ?>');
    <?php } } ?>

  })(jQuery);
</script>
<?php } ?>
<?php get_footer(); ?>

<?php /* Template Name: Dashboard Template */ 
get_header(); ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div> --><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="<?php echo home_url('/all-customer/'); ?>">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo get_total_customers(); ?></h3>
                  <p>Total Customer</p>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="<?php echo home_url('/todays-customer/'); ?>">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo get_todays_customers(); ?></h3>
                  <p>Todays' Customer</p>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="<?php echo home_url('/forgot-customer/'); ?>">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo get_forget_customers(); ?></h3>
                  <p>Forgot Customer</p>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="<?php echo home_url('/complete-customer/'); ?>">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo get_complete_customers(); ?></h3>
                  <p>Complete Customer</p>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.control-sidebar -->
<?php get_footer(); ?>

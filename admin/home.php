<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<hr>
<?php if($_settings->userdata('type') != 3): ?>
<div class="row">
	<div class="col-12 col-sm-3 col-md-3">
		<div class="info-box">
		  <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-cogs"></i></span>
		  <div class="info-box-content">
			<a href="<?php echo base_url ?>admin/?page=services" alt="" style="color:#000 !important;">
			<span class="info-box-text">Total Services</span>
			<span class="info-box-number">
			  <?php 
				$service = $conn->query("SELECT * FROM service_list where delete_flag = 0 and `status` = 1")->num_rows;
				echo format_num($service);
			  ?>
			  <?php ?>
			</span>
			</a>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  <!-- /.col -->
	  <div class="col-12 col-sm-3 col-md-3">
		<div class="info-box">
		  <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-microchip"></i></span>
		  <div class="info-box-content">
			<a href="<?php echo base_url ?>admin/?page=products" alt="" style="color:#000 !important;">
			<span class="info-box-text">Total Products</span>
			<span class="info-box-number">
			  <?php 
				$service = $conn->query("SELECT * FROM product_list where delete_flag = 0 and `status` = 1")->num_rows;
				echo format_num($service);
			  ?>
			  <?php ?>
			</span>
			</a>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  <!-- /.col -->
	  <div class="col-12 col-sm-3 col-md-3">
		<div class="info-box">
		  <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-building"></i></span>
		  <div class="info-box-content">
			<a href="<?php echo base_url ?>admin/?page=quotations" alt="" style="color:#000 !important;">
			<span class="info-box-text">Total Quotations</span>
			<span class="info-box-number">
			  <?php 
				$service = $conn->query("SELECT * FROM quotation_list")->num_rows;
				echo format_num($service);
			  ?>
			  <?php ?>
			</span>
			</a>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  <!-- /.col -->
	  
	  <div class="col-12 col-sm-3 col-md-3">
		<div class="info-box">
		  <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-clipboard-list"></i></span>
		  <div class="info-box-content">
			<a href="<?php echo base_url ?>admin/?page=transactions" alt="" style="color:#000 !important;">
			<span class="info-box-text">Total Invoices</span>
			<span class="info-box-number">
			  <?php 
				$service = $conn->query("SELECT * FROM transaction_list")->num_rows;
				echo format_num($service);
			  ?>
			  <?php ?>
			</span>
			</a>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  <!-- /.col -->
	  
	  
	  <div class="col-12 col-sm-4 col-md-4">
		<div class="info-box">
		  <span class="info-box-icon bg-gradient-navy border elevation-1"><i class="fas fa-bullhorn"></i></span>
		  <div class="info-box-content">
			<a href="<?php echo base_url ?>admin/?page=transactions" alt="" style="color:#000 !important;">
			<span class="info-box-text">Pending Transaction</span>
			<span class="info-box-number">
			  <?php 						
				if($_settings->userdata('type') == 3):
				  $total = $conn->query("SELECT * FROM transaction_list where `status` = 0 and tech_id = '{$_settings->userdata('id')}' ")->num_rows;
				else:
				  $total = $conn->query("SELECT * FROM transaction_list where `status` = 0 ")->num_rows;
				endif;
				echo format_num($total);
			  ?>
			  <?php ?>
			</span>
			</a>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  <!-- /.col -->
	  <div class="col-12 col-sm-4 col-md-4">
		<div class="info-box">
		  <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-spinner"></i></span>

		  <div class="info-box-content">
			<a href="<?php echo base_url ?>admin/?page=transactions" alt="" style="color:#000 !important;">
			<span class="info-box-text">On-Progress</span>
			<span class="info-box-number">
			  <?php 
				if($_settings->userdata('type') == 3):
				  $total = $conn->query("SELECT * FROM transaction_list where `status` = 1 and tech_id = '{$_settings->userdata('id')}' ")->num_rows;
				else:
				  $total = $conn->query("SELECT * FROM transaction_list where `status` = 1 ")->num_rows;
				endif;
				echo format_num($total);
			  ?>
			  <?php ?>
			</span>
			</a>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  
	  <div class="col-12 col-sm-4 col-md-4">
		<div class="info-box">
		  <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-check-square"></i></span>

		  <div class="info-box-content">
			<a href="<?php echo base_url ?>admin/?page=transactions" alt="" style="color:#000 !important;">
			<span class="info-box-text">Completed</span>
			<span class="info-box-number">
			  <?php 
				if($_settings->userdata('type') == 3):
				  $total = $conn->query("SELECT * FROM transaction_list where `status` = 2 and tech_id = '{$_settings->userdata('id')}' ")->num_rows;
				else:
				  $total = $conn->query("SELECT * FROM transaction_list where `status` = 2 ")->num_rows;
				endif;
				echo format_num($total);
			  ?>
			  <?php ?>
			</span>
			</a>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  
	  <div class="col-12 col-sm-4 col-md-4">
		<div class="info-box">
		  <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-money-bill"></i></span>

		  <div class="info-box-content">
			<a href="<?php echo base_url ?>admin/?page=transactions" alt="" style="color:#000 !important;">
			<span class="info-box-text">Paid</span>
			<span class="info-box-number">
			  <?php 
				if($_settings->userdata('type') == 3):
				  $total = $conn->query("SELECT * FROM transaction_list where `status` = 3 and tech_id = '{$_settings->userdata('id')}' ")->num_rows;
				else:
				  $total = $conn->query("SELECT * FROM transaction_list where `status` = 3 ")->num_rows;
				endif;
				echo format_num($total);
			  ?>
			  <?php ?>
			</span>
			</a>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  
	  <div class="col-12 col-sm-4 col-md-4">
		<div class="info-box">
		  <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-ban"></i></span>

		  <div class="info-box-content">
			<a href="<?php echo base_url ?>admin/?page=transactions" alt="" style="color:#000 !important;">
			<span class="info-box-text">Cancelled</span>
			<span class="info-box-number">
			  <?php 
				if($_settings->userdata('type') == 3):
				  $total = $conn->query("SELECT * FROM transaction_list where `status` = 4 and tech_id = '{$_settings->userdata('id')}' ")->num_rows;
				else:
				  $total = $conn->query("SELECT * FROM transaction_list where `status` = 4 ")->num_rows;
				endif;
				echo format_num($total);
			  ?>
			  <?php ?>
			</span>
			</a>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  
	  
	  <div class="col-12 col-sm-4 col-md-4">
		<div class="info-box">
		  <span class="info-box-icon bg-gradient-navy elevation-1"><i class="fas fa-bookmark"></i></span>

		  <div class="info-box-content">
			<a href="<?php echo base_url ?>admin/?page=complaint" alt="" style="color:#000 !important;">
			<span class="info-box-text">Complaints</span>
			<span class="info-box-number">
			  <?php 
				$total = $conn->query("SELECT * FROM complaints where delete_flag = '0'")->num_rows;
				echo format_num($total);
			  ?>
			  <?php ?>
			</span>
			</a>
		  </div>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	  </div>
	  
	  <!-- /.col -->
	</div>
<?php endif; ?>

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
<?php
	// ---------- Business overview data ----------
	$m_start = date('Y-m-01'); $m_end = date('Y-m-t');
	$pm_start = date('Y-m-01', strtotime('first day of last month')); $pm_end = date('Y-m-t', strtotime('first day of last month'));
	$one = function($sql) use ($conn){ $r = $conn->query($sql)->fetch_row(); return $r[0] ? $r[0] : 0; };

	$sales_month = $one("SELECT SUM(amount_with_gst) FROM transaction_list WHERE status <> 4 AND invoice_date BETWEEN '{$m_start}' AND '{$m_end}'");
	$sales_prev  = $one("SELECT SUM(amount_with_gst) FROM transaction_list WHERE status <> 4 AND invoice_date BETWEEN '{$pm_start}' AND '{$pm_end}'");
	$collected   = $one("SELECT SUM(amount) FROM payment WHERE status = '0' AND payment_date BETWEEN '{$m_start}' AND '{$m_end}'");
	$gst_month   = $one("SELECT SUM(cgst_amt + sgst_amt) FROM transaction_list WHERE status <> 4 AND invoice_type = 'GST' AND invoice_date BETWEEN '{$m_start}' AND '{$m_end}'");
	$purch_month = $one("SELECT SUM(amount_with_gst) FROM purchase_list WHERE status <> 3 AND purchase_date BETWEEN '{$m_start}' AND '{$m_end}'");
	$purch_bills = $one("SELECT COUNT(*) FROM purchase_list WHERE status <> 3 AND purchase_date BETWEEN '{$m_start}' AND '{$m_end}'");

	// Due = bill amount - payments entered (cancelled bills not counted)
	$inv_due_sql = "SELECT t.id, t.customer_id, t.amount_with_gst - COALESCE(p.paid, 0) AS due FROM transaction_list t
		LEFT JOIN (SELECT tran_id, SUM(amount) paid FROM payment WHERE status = '0' GROUP BY tran_id) p ON p.tran_id = t.id WHERE t.status <> 4";
	$pur_due_sql = "SELECT pl.id, pl.amount_with_gst - COALESCE(p.paid, 0) AS due FROM purchase_list pl
		LEFT JOIN (SELECT purchase_id, SUM(amount) paid FROM purchase_payment WHERE status = '0' GROUP BY purchase_id) p ON p.purchase_id = pl.id WHERE pl.status <> 3";
	$receivable     = $one("SELECT SUM(due) FROM ({$inv_due_sql}) d");
	$receivable_cnt = $one("SELECT COUNT(*) FROM ({$inv_due_sql}) d WHERE due > 0.5");
	$payable        = $one("SELECT SUM(due) FROM ({$pur_due_sql}) d");
	$payable_cnt    = $one("SELECT COUNT(*) FROM ({$pur_due_sql}) d WHERE due > 0.5");

	$sales_change = $sales_prev > 0 ? round(($sales_month - $sales_prev) / $sales_prev * 100) : null;
	$prev_label = date('M', strtotime('first day of last month'));

	// Sales vs Purchases, last 6 months
	$months = array();
	for($i = 5; $i >= 0; $i--) $months[date('Y-m', strtotime("first day of -{$i} month"))] = array('sales' => 0, 'purchases' => 0);
	$chart_from = array_keys($months)[0].'-01';
	$q = $conn->query("SELECT DATE_FORMAT(invoice_date,'%Y-%m') ym, SUM(amount_with_gst) amt FROM transaction_list WHERE status <> 4 AND invoice_date >= '{$chart_from}' GROUP BY ym");
	while($r = $q->fetch_assoc()) if(isset($months[$r['ym']])) $months[$r['ym']]['sales'] = round($r['amt']);
	$q = $conn->query("SELECT DATE_FORMAT(purchase_date,'%Y-%m') ym, SUM(amount_with_gst) amt FROM purchase_list WHERE status <> 3 AND purchase_date >= '{$chart_from}' GROUP BY ym");
	while($r = $q->fetch_assoc()) if(isset($months[$r['ym']])) $months[$r['ym']]['purchases'] = round($r['amt']);

	// Invoice status counts
	$status_counts = array(0, 0, 0, 0, 0);
	$q = $conn->query("SELECT status, COUNT(*) c FROM transaction_list GROUP BY status");
	while($r = $q->fetch_assoc()) if(isset($status_counts[$r['status']])) $status_counts[$r['status']] = (int)$r['c'];

	$top_due = $conn->query("SELECT c.cus_name, SUM(d.due) due FROM ({$inv_due_sql}) d INNER JOIN customer_list c ON c.id = d.customer_id GROUP BY c.id HAVING due > 0.5 ORDER BY due DESC LIMIT 5");
	$top_products = $conn->query("SELECT pr.name, SUM(tp.qty) qty, SUM(tp.product_total) amt FROM transaction_products tp INNER JOIN transaction_list t ON t.id = tp.transaction_id INNER JOIN product_list pr ON pr.id = tp.product_id WHERE t.status <> 4 GROUP BY pr.id ORDER BY amt DESC LIMIT 5");
	$recent = $conn->query("SELECT t.id, t.invoice_date, t.code, t.amount_with_gst, t.status, c.cus_name FROM transaction_list t LEFT JOIN customer_list c ON c.id = t.customer_id ORDER BY t.invoice_date DESC, t.id DESC LIMIT 5");

	// Stock alerts (same rule as the Stock Report page)
	$stock = $conn->query("SELECT SUM(closing <= 0) out_cnt, SUM(closing BETWEEN 1 AND 5) low_cnt FROM (
		SELECT p.opening_stock
		+ COALESCE((SELECT SUM(pp.qty) FROM purchase_products pp INNER JOIN purchase_list pl ON pl.id = pp.purchase_id WHERE pp.product_id = p.id AND pl.status <> 3 AND pl.purchase_date >= COALESCE(p.opening_stock_date, '1000-01-01')), 0)
		- COALESCE((SELECT SUM(tp.qty) FROM transaction_products tp INNER JOIN transaction_list t ON t.id = tp.transaction_id WHERE tp.product_id = p.id AND t.status <> 4 AND t.invoice_date >= COALESCE(p.opening_stock_date, '1000-01-01')), 0) AS closing
		FROM product_list p WHERE p.delete_flag = 0) s")->fetch_assoc();

	$status_badges = array(
		0 => '<span class="badge badge-default border px-3 rounded-pill">Pending</span>',
		1 => '<span class="badge badge-primary px-3 rounded-pill">On-Progress</span>',
		2 => '<span class="badge badge-success px-3 rounded-pill">Done</span>',
		3 => '<span class="badge badge-success bg-gradient-teal px-3 rounded-pill">Paid</span>',
		4 => '<span class="badge badge-danger px-3 rounded-pill">Cancelled</span>',
	);
	$admin_url = base_url.'admin/';
?>
	<h4 class="mt-2 mb-3 text-navy">Business Overview &mdash; <?= date('F Y') ?></h4>
	<div class="row">
		<div class="col-lg-4 col-md-6 col-12">
			<div class="small-box bg-gradient-navy">
				<div class="inner"><h3>&#8377;<?= format_num($sales_month, 0) ?></h3><p>Sales This Month</p></div>
				<div class="icon"><i class="fas fa-chart-line"></i></div>
				<a href="<?= $admin_url ?>?page=transactions" class="small-box-footer">
					<?php if($sales_change !== null): ?><?= $sales_change >= 0 ? '&#9650;' : '&#9660;' ?> <?= abs($sales_change) ?>% vs <?= $prev_label ?> (&#8377;<?= format_num($sales_prev, 0) ?>)<?php else: ?>No sales last month<?php endif; ?>
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-12">
			<div class="small-box bg-gradient-success">
				<div class="inner"><h3>&#8377;<?= format_num($collected, 0) ?></h3><p>Collected This Month</p></div>
				<div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
				<a href="<?= $admin_url ?>?page=transactions" class="small-box-footer">Payments received <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-12">
			<div class="small-box bg-gradient-warning">
				<div class="inner"><h3>&#8377;<?= format_num($receivable, 0) ?></h3><p>Customers Owe</p></div>
				<div class="icon"><i class="fas fa-file-invoice-dollar"></i></div>
				<a href="<?= $admin_url ?>?page=transactions" class="small-box-footer"><?= format_num($receivable_cnt) ?> invoices unpaid <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-12">
			<div class="small-box bg-gradient-info">
				<div class="inner"><h3>&#8377;<?= format_num($purch_month, 0) ?></h3><p>Purchases This Month</p></div>
				<div class="icon"><i class="fas fa-shopping-cart"></i></div>
				<a href="<?= $admin_url ?>?page=purchases" class="small-box-footer"><?= format_num($purch_bills) ?> purchase bills <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-12">
			<div class="small-box bg-gradient-danger">
				<div class="inner"><h3>&#8377;<?= format_num($payable, 0) ?></h3><p>We Owe Suppliers</p></div>
				<div class="icon"><i class="fas fa-truck"></i></div>
				<a href="<?= $admin_url ?>?page=purchases" class="small-box-footer"><?= format_num($payable_cnt) ?> bills unpaid <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-12">
			<div class="small-box bg-gradient-secondary">
				<div class="inner"><h3>&#8377;<?= format_num($gst_month, 0) ?></h3><p>GST Collected (<?= date('M') ?>)</p></div>
				<div class="icon"><i class="fas fa-percent"></i></div>
				<a href="<?= $admin_url ?>?page=report" class="small-box-footer">CGST + SGST on GST invoices <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-12">
			<div class="card card-outline card-navy">
				<div class="card-header"><h3 class="card-title">Sales vs Purchases (last 6 months)</h3></div>
				<div class="card-body"><div style="height:280px"><canvas id="salesPurchaseChart"></canvas></div></div>
			</div>
		</div>
		<div class="col-lg-4 col-12">
			<div class="card card-outline card-navy">
				<div class="card-header"><h3 class="card-title">Invoice Status</h3></div>
				<div class="card-body"><div style="height:280px"><canvas id="statusChart"></canvas></div></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6 col-12">
			<div class="card card-outline card-navy">
				<div class="card-header"><h3 class="card-title">Top 5 Customers &ndash; Amount Due</h3></div>
				<div class="card-body p-0">
					<table class="table table-sm table-striped mb-0">
						<?php if($top_due->num_rows == 0): ?><tr><td class="text-center text-muted py-3">Nothing due</td></tr><?php endif; ?>
						<?php while($r = $top_due->fetch_assoc()): ?>
						<tr><td class="px-3"><?= $r['cus_name'] ?></td><td class="text-right px-3">&#8377;<?= format_num($r['due'], 2) ?></td></tr>
						<?php endwhile; ?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-12">
			<div class="card card-outline card-navy">
				<div class="card-header"><h3 class="card-title">Top 5 Selling Products</h3></div>
				<div class="card-body p-0">
					<table class="table table-sm table-striped mb-0">
						<?php if($top_products->num_rows == 0): ?><tr><td class="text-center text-muted py-3">No sales yet</td></tr><?php endif; ?>
						<?php while($r = $top_products->fetch_assoc()): ?>
						<tr><td class="px-3"><?= $r['name'] ?></td><td class="text-right text-nowrap"><?= $r['qty'] ?> pcs</td><td class="text-right px-3">&#8377;<?= format_num($r['amt'], 2) ?></td></tr>
						<?php endwhile; ?>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-12">
			<div class="card card-outline card-navy">
				<div class="card-header">
					<h3 class="card-title">Recent Invoices</h3>
					<div class="card-tools"><a href="<?= $admin_url ?>?page=transactions" class="btn btn-tool">View all</a></div>
				</div>
				<div class="card-body p-0">
					<table class="table table-sm table-hover mb-0">
						<?php while($r = $recent->fetch_assoc()): ?>
						<tr style="cursor:pointer" onclick="location.href='<?= $admin_url ?>?page=transactions/view_details&id=<?= $r['id'] ?>'">
							<td class="px-3 text-nowrap"><?= !empty($r['invoice_date']) ? date("M d", strtotime($r['invoice_date'])) : '' ?></td>
							<td class="text-nowrap"><?= $r['code'] ?></td>
							<td><?= $r['cus_name'] ?></td>
							<td class="text-right text-nowrap">&#8377;<?= format_num($r['amount_with_gst'], 2) ?></td>
							<td class="text-center px-3"><?= isset($status_badges[$r['status']]) ? $status_badges[$r['status']] : '' ?></td>
						</tr>
						<?php endwhile; ?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-12">
			<div class="card card-outline card-navy">
				<div class="card-header"><h3 class="card-title">Stock Alerts</h3></div>
				<div class="card-body">
					<a href="<?= $admin_url ?>?page=stock_report&stock_status=Out" class="d-flex justify-content-between align-items-center mb-2 text-dark">
						<span><i class="fas fa-times-circle text-danger mr-2"></i>Out of Stock</span>
						<span class="badge badge-danger px-3 py-2"><?= (int)$stock['out_cnt'] ?></span>
					</a>
					<a href="<?= $admin_url ?>?page=stock_report&stock_status=Low" class="d-flex justify-content-between align-items-center text-dark">
						<span><i class="fas fa-exclamation-triangle text-warning mr-2"></i>Low Stock (1&ndash;5)</span>
						<span class="badge badge-warning px-3 py-2"><?= (int)$stock['low_cnt'] ?></span>
					</a>
					<small class="text-muted d-block mt-3">Set each product's Opening Stock in Product List for accurate figures.</small>
				</div>
			</div>
		</div>
	</div>
<script>
	// Chart.js is loaded in the footer, so build the charts once the page has fully loaded.
	window.addEventListener('load', function(){
		var rupee = function(v){ return '₹' + Number(v).toLocaleString('en-IN'); };
		new Chart(document.getElementById('salesPurchaseChart'), {
			type: 'bar',
			data: {
				labels: <?= json_encode(array_map(function($ym){ return date('M Y', strtotime($ym.'-01')); }, array_keys($months))) ?>,
				datasets: [
					{ label: 'Sales', backgroundColor: '#001f3f', data: <?= json_encode(array_column(array_values($months), 'sales')) ?> },
					{ label: 'Purchases', backgroundColor: '#fd7e14', data: <?= json_encode(array_column(array_values($months), 'purchases')) ?> }
				]
			},
			options: {
				maintainAspectRatio: false,
				tooltips: { callbacks: { label: function(t, d){ return d.datasets[t.datasetIndex].label + ': ' + rupee(t.yLabel); } } },
				scales: { yAxes: [{ ticks: { beginAtZero: true, callback: rupee } }] }
			}
		});
		new Chart(document.getElementById('statusChart'), {
			type: 'doughnut',
			data: {
				labels: ['Pending', 'On-Progress', 'Done', 'Paid', 'Cancelled'],
				datasets: [{ data: <?= json_encode($status_counts) ?>, backgroundColor: ['#adb5bd', '#007bff', '#28a745', '#20c997', '#dc3545'] }]
			},
			options: { maintainAspectRatio: false, legend: { position: 'right' } }
		});
	});
</script>
<?php endif; ?>

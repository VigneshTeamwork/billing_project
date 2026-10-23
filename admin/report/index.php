<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
$is_purchase = isset($_POST['report_submit']) && isset($_POST['report_type']) && $_POST['report_type'] == 'Purchase';
?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Report </h3>
		<div class="card-tools">
			<!--<a href="./?page=transactions/manage_transaction" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>-->
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<form action="" id="report-form" method="POST">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group mb-3">
							<label for="report_type" class="control-label">Report Type</label>
							<select id="report_type" name="report_type" class="form-control form-control-sm rounded">
								<option value="" disabled selected></option>
								<option value="Quotation" <?php if(isset($_POST['report_type'])){ if($_POST['report_type'] == 'Quotation'){ echo "selected"; } } ?>>Quotation</option>
								<option value="Invoice" <?php if(isset($_POST['report_type'])){ if($_POST['report_type'] == 'Invoice'){ echo "selected"; } }else{ echo "selected"; } ?> >Invoice</option>
								<option value="Purchase" <?php if(isset($_POST['report_type'])){ if($_POST['report_type'] == 'Purchase'){ echo "selected"; } } ?>>Purchase</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group mb-3">
							<label for="invoice_type" class="control-label">Invoice Type</label>
							<select id="invoice_type" name="invoice_type" class="form-control form-control-sm rounded">
								<option value="" disabled selected></option>
								<option value="All" <?php if(isset($_POST['invoice_type'])){ if($_POST['invoice_type'] == 'All'){ echo "selected"; } }else{ echo "selected"; } ?>>All</option>
								<option value="GST" <?php if(isset($_POST['invoice_type'])){ if($_POST['invoice_type'] == 'GST'){ echo "selected"; } } ?>>GST</option>
								<option value="Non-GST" <?php if(isset($_POST['invoice_type'])){ if($_POST['invoice_type'] == 'Non-GST'){ echo "selected"; } } ?> >Non-GST</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 sale-filter">
						<div class="form-group mb-3">
							<label for="customer_id" class="control-label">Select Customer</label>
							<select id="customer_id" name="customer_id" class="form-control form-control-sm rounded">
								<option value="" disabled selected></option>
								<?php
								$service_qry = $conn->query("SELECT * FROM `customer_list` where delete_flag = 0 and `status` = 1 order by `cus_name`");
								while($row = $service_qry->fetch_assoc()): ?>
								<option value="<?= $row['id'] ?>" <?= isset($_POST['customer_id']) && $row['id'] == $_POST['customer_id'] ? 'selected' : '' ?>><?= $row['cus_name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 purchase-filter">
						<div class="form-group mb-3">
							<label for="supplier_id" class="control-label">Select Supplier</label>
							<select id="supplier_id" name="supplier_id" class="form-control form-control-sm rounded">
								<option value="" disabled selected></option>
								<?php
								$supplier_qry = $conn->query("SELECT * FROM `supplier_list` where delete_flag = 0 and `status` = 1 order by `sup_name`");
								while($row = $supplier_qry->fetch_assoc()): ?>
								<option value="<?= $row['id'] ?>" <?= isset($_POST['supplier_id']) && $row['id'] == $_POST['supplier_id'] ? 'selected' : '' ?>><?= $row['sup_name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group mb-3">
							<label for="from_date" class="control-label">From Date</label>
							<input type="date" id="from_date" name="from_date" class="form-control form-control-sm rounded" placeholder="From Date" value="<?php if(isset($_POST['from_date'])){ echo $_POST['from_date']; }else{ echo date('Y-m-d'); } ?>">
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group mb-3">
							<label for="to_date" class="control-label">To Date</label>
							<input type="date" id="to_date" name="to_date" class="form-control form-control-sm rounded" placeholder="To Date" value="<?php if(isset($_POST['to_date'])){ echo $_POST['to_date']; }else{ echo date('Y-m-d'); } ?>">
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 sale-filter">
						<div class="form-group mb-3">
							<label for="tech_id" class="control-label">Select Assign</label>
							<select name="tech_id" id="tech_id" class="form-control form-control rounded-0">
								<option value="" disabled <?= !isset($_POST['tech_id']) ? "selected" : "" ?>></option>
								<?php
								$tech_qry = $conn->query("SELECT *,concat(firstname,' ', lastname) as `name` FROM `users` where `type` = 3 order by `name` asc");
								while($row = $tech_qry->fetch_array()):
								?>
								<option value="<?= $row['id'] ?>" <?= isset($_POST['tech_id']) && $_POST['tech_id'] == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group mb-3">
							<button type="submit" name="report_submit" class="btn btn-primary rounded-0" style="float:right;margin-bottom:10px;">Submit</button>
						</div>
					</div>
				</div>
			</form>
			<table class="table table-hover table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th><?= $is_purchase ? 'Purchase Date' : 'Date' ?></th>
						<th>Code</th>
						<th><?= $is_purchase ? 'Supplier' : 'Client' ?></th>
						<th>Bill Type</th>
						<th class='text-right'>Amount</th>
						<th class='text-right'>Paid Amount</th>
						<th class='text-right'>Balance Amount</th>
						<th><?= $is_purchase ? 'Supplier Bill No' : 'Technician' ?></th>
						<th class="text-center">Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$table_condition = '';
					$view_condition = '';
					$overall_total_amt = 0;
					$overall_paid_amt = 0;
					$overall_bal_amt = 0;
					if(isset($_POST['report_submit'])){
						$report_type = isset($_POST['report_type']) ? $_POST['report_type'] : 'Invoice';
						if($report_type == 'Quotation'){
							$table_condition = "`quotation_list`";
							$view_condition = "quotations";
							$date_col = "quotation_date";
							$order_by = "quotation_date desc, id desc";
						}else if($report_type == 'Purchase'){
							$table_condition = "`purchase_list`";
							$view_condition = "purchases";
							$date_col = "purchase_date";
							$order_by = "purchase_date desc, id desc";
						}else{
							$table_condition = "`transaction_list`";
							$view_condition = "transactions";
							$date_col = "invoice_date";
							$order_by = "invoice_date desc, id desc";
						}

						$where = array();
						if(!empty($_POST['invoice_type']) && $_POST['invoice_type'] != 'All')
							$where[] = "invoice_type = '".$conn->real_escape_string($_POST['invoice_type'])."'";
						if($is_purchase){
							if(!empty($_POST['supplier_id']))
								$where[] = "supplier_id = '".(int)$_POST['supplier_id']."'";
						}else{
							if(!empty($_POST['customer_id']))
								$where[] = "customer_id = '".(int)$_POST['customer_id']."'";
							if(!empty($_POST['tech_id']))
								$where[] = "tech_id = '".(int)$_POST['tech_id']."'";
						}
						if(!empty($_POST['from_date']))
							$where[] = "{$date_col} >= '".date("Y-m-d", strtotime($_POST['from_date']))."'";
						if(!empty($_POST['to_date']))
							$where[] = "{$date_col} <= '".date("Y-m-d", strtotime($_POST['to_date']))."'";
						$where_condition = count($where) ? implode(' and ', $where) : '1=1';

						$qry = $conn->query("SELECT * FROM {$table_condition} where {$where_condition} order by {$order_by}");

						// Name lookups, loaded once.
						$names = array();
						$name_qry = $is_purchase
							? $conn->query("SELECT id, sup_name as `name` FROM `supplier_list`")
							: $conn->query("SELECT id, cus_name as `name` FROM `customer_list`");
						while($n = $name_qry->fetch_assoc()) $names[$n['id']] = $n['name'];
						$techs = array();
						$tech_qry = $conn->query("SELECT id, firstname FROM `users` where type = 3");
						while($t = $tech_qry->fetch_assoc()) $techs[$t['id']] = $t['firstname'];

						$status_labels = $is_purchase ? array(
							0 => '<span class="badge badge-default border px-3 rounded-pill">Pending</span>',
							1 => '<span class="badge badge-primary px-3 rounded-pill">Received</span>',
							2 => '<span class="badge badge-success bg-gradient-teal px-3 rounded-pill">Paid</span>',
							3 => '<span class="badge badge-danger px-3 rounded-pill">Cancelled</span>',
						) : array(
							0 => '<span class="badge badge-default border px-3 rounded-pill">Pending</span>',
							1 => '<span class="badge badge-primary px-3 rounded-pill">On-Progress</span>',
							2 => '<span class="badge badge-success px-3 rounded-pill">Done</span>',
							3 => '<span class="badge badge-success bg-gradient-teal px-3 rounded-pill">Paid</span>',
							4 => '<span class="badge badge-danger px-3 rounded-pill">Cancelled</span>',
						);

						$i = 1;
						while($row = $qry->fetch_assoc()):
							$overall_total_amt = $overall_total_amt + $row['amount_with_gst'];
							if($is_purchase){
								$row_date = $row['purchase_date'];
								$party_id = $row['supplier_id'];
								$paid_amt = $conn->query("SELECT COALESCE(SUM(amount),0) as paid from `purchase_payment` where purchase_id = '{$row['id']}' and status = '0'")->fetch_assoc()['paid'];
							}else{
								$row_date = isset($row['invoice_date']) ? $row['invoice_date'] : (isset($row['quotation_date']) ? $row['quotation_date'] : '');
								$party_id = $row['customer_id'];
								$paid_amt = $conn->query("SELECT COALESCE(SUM(amount),0) as paid from `payment` where tran_id = '{$row['id']}' and status = '0'")->fetch_assoc()['paid'];
							}
							$bal_amt = $row['amount_with_gst'] - $paid_amt;
							$overall_paid_amt += $paid_amt;
							$overall_bal_amt += $bal_amt;
						?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><p class="m-0 truncate-1"><?= !empty($row_date) ? date("M d, Y", strtotime($row_date)) : date("M d, Y H:i", strtotime($row['date_updated'])) ?></p></td>
							<td><p class="m-0 truncate-1"><?= $row['code'] ?></p></td>
							<td><p class="m-0 truncate-1"><?= isset($names[$party_id]) ? $names[$party_id] : '' ?></p></td>
							<td><p class="m-0 truncate-1"><?= $row['invoice_type'] ?></p></td>
							<td class='text-right'><?= format_num($row['amount_with_gst']) ?></td>
							<td class='text-right'><?= format_num($paid_amt) ?></td>
							<td class='text-right'><?= format_num($bal_amt) ?></td>
							<td><p class="m-0 truncate-1"><?= $is_purchase ? $row['supplier_bill_no'] : (isset($techs[$row['tech_id']]) ? $techs[$row['tech_id']] : '') ?></p></td>
							<td class="text-center"><?= isset($status_labels[$row['status']]) ? $status_labels[$row['status']] : '' ?></td>
							<td align="center" class="text-nowrap">
								<a class="btn btn-default bg-gradient-light btn-flat btn-sm" href="?page=<?php echo $view_condition; ?>/view_details&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
								<a class="btn btn-default bg-gradient-light btn-flat btn-sm payment" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-module="<?php echo $view_condition; ?>"><span class="fa fa-money-bill text-dark"></span> Payment</a>
							</td>
						</tr>
					<?php endwhile;
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan='5' class="text-right">Total</td>
						<td class="text-right"><?= format_num($overall_total_amt) ?></td>
						<td class="text-right"><?= format_num($overall_paid_amt) ?></td>
						<td class="text-right"><?= format_num($overall_bal_amt) ?></td>
						<td colspan='3'></td>
					</tr>
				</tfoot>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	// Purchase reports filter by supplier; invoice/quotation reports by customer and technician.
	function toggle_filters(){
		var is_purchase = $('#report_type').val() == 'Purchase';
		$('.purchase-filter').toggle(is_purchase);
		$('.sale-filter').toggle(!is_purchase);
	}
	$(function(){
		$('select#report_type').select2({
            placeholder:"Select Report Type here",
            width:'100%',
            containerCssClass:'form-control form-control-sm rounded-0'
        })
		$('select#invoice_type').select2({
            placeholder:"Select Invoice Type here",
            width:'100%',
            containerCssClass:'form-control form-control-sm rounded-0'
        })
		$('select#customer_id').select2({
            placeholder:"Select Customer here",
            width:'100%',
            containerCssClass:'form-control form-control-sm rounded-0'
        })
		$('select#supplier_id').select2({
            placeholder:"Select Supplier here",
            width:'100%',
            containerCssClass:'form-control form-control-sm rounded-0'
        })
		$('select#tech_id').select2({
            placeholder:"Select technician here",
            width:'100%',
            containerCssClass:'form-control form-control-sm rounded-0'
        })
		toggle_filters();
		$('#report_type').on('change', toggle_filters);
	});
	$(document).ready(function(){
		$('.payment').click(function(){
			var id = $(this).attr("data-id");
			var module = $(this).attr("data-module") == 'purchases' ? 'purchases' : 'transactions';
			uni_modal("Payment", module + "/payment.php?id="+id)
		})

		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [5] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})

</script>

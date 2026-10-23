<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
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
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group mb-3">
							<label for="customer_id" class="control-label">Select Customer</label>
							<select id="customer_id" name="customer_id" class="form-control form-control-sm rounded">
								<option value="" disabled selected></option>
								<?php 
								$service_qry = $conn->query("SELECT * FROM `customer_list` where delete_flag = 0 and `status` = 1 order by `cus_name`");
								while($row = $service_qry->fetch_assoc()): ?>
								<?php 
								if(isset($_POST['customer_id'])){
									if($row['id'] == $_POST['customer_id']){
										?>
										<option value="<?= $row['id'] ?>" data-price = "<?= $row['cus_name'] ?>" selected ><?= $row['cus_name'] ?></option>
										<?php
									}else{
										?>
										<option value="<?= $row['id'] ?>" data-price = "<?= $row['cus_name'] ?>" ><?= $row['cus_name'] ?></option>
										<?php
									}
								}else{
									?>
									<option value="<?= $row['id'] ?>" data-price = "<?= $row['cus_name'] ?>" ><?= $row['cus_name'] ?></option>
									<?php
								}
								
								?>
								
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
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group mb-3">
							<label for="customer_id" class="control-label">Select Assign</label>
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
				<!--<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="25%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
				</colgroup>-->
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Code</th>
						<th>Client</th>
						<th>Bill Type</th>
						<th class='text-right'>Amount</th>
						<th class='text-right'>Paid Amount</th>
						<th class='text-right'>Balance Amount</th>
						<th>Technician</th>
						<th class="text-center">Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$table_condition = '';
					$view_condition = '';
					$where_condition = '';
					$overall_total_amt = 0;
					$overall_paid_amt = 0;
					$overall_bal_amt = 0;
					if(isset($_POST['report_submit'])){
						
						if(isset($_POST['report_type'])){
							if(!empty($_POST['report_type'])){
								if($_POST['report_type'] == 'Invoice'){
									$table_condition = "`transaction_list`";	
									$view_condition = "transactions";	
								}else if($_POST['report_type'] == 'Quotation'){
									$table_condition = "`quotation_list`";	
									$view_condition = "quotations";	
								}else{
									$table_condition = "`transaction_list`";
									$view_condition = "transactions";
								}
							}
						}
						
						if(isset($_POST['invoice_type'])){
							if(!empty($_POST['invoice_type']) && $_POST['invoice_type'] != 'All'){
								$where_condition.= "invoice_type = '{$_POST['invoice_type']}' and ";
							}
						}
						
						if(isset($_POST['customer_id'])){
							if(!empty($_POST['customer_id'])){
								$where_condition.= "customer_id = '{$_POST['customer_id']}' and ";
							}
						}
						
						if(isset($_POST['tech_id'])){
							if(!empty($_POST['tech_id'])){
								$where_condition.= "tech_id = '{$_POST['tech_id']}' and ";
							}
						}
						
						// Invoices use the user-entered invoice date; quotations still use their creation date.
						$date_col = $view_condition == 'transactions' ? "invoice_date" : "DATE(date_created)";
						if(isset($_POST['from_date'])){
							if(!empty($_POST['from_date'])){
								$from_date = date("Y-m-d", strtotime($_POST['from_date']));
								$where_condition.= "{$date_col} >= '{$from_date}' and ";
							}
						}

						if(isset($_POST['to_date'])){
							if(!empty($_POST['to_date'])){
								$to_date = date("Y-m-d", strtotime($_POST['to_date']));
								$where_condition.= "{$date_col} <= '{$to_date}' ";
							}
						}

						$qry = $conn->query("SELECT * FROM {$table_condition} where {$where_condition} order by ".($view_condition == 'transactions' ? "invoice_date desc, id desc" : "unix_timestamp(date_updated) desc"));
						
						/*if($_settings->userdata('type') == 3):
						$qry = $conn->query("SELECT * FROM `transaction_list` where tech_id = '{$_settings->userdata('id')}' order by unix_timestamp(date_updated) desc ");
						else:
						$qry = $conn->query("SELECT * FROM `transaction_list` order by unix_timestamp(date_updated) desc ");
						endif;*/
						
						$i = 1;
						while($row = $qry->fetch_assoc()):
							$overall_total_amt = $overall_total_amt + $row['amount_with_gst'];
						?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><p class="m-0 truncate-1"><?= !empty($row['invoice_date']) ? date("M d, Y", strtotime($row['invoice_date'])) : date("M d, Y H:i", strtotime($row['date_updated'])) ?></p></td>
							<td><p class="m-0 truncate-1"><?= $row['code'] ?></p></td>
							<td><p class="m-0 truncate-1">
							<?php
							$customer_qry = $conn->query("SELECT * FROM `customer_list` where delete_flag = 0 and `status` = 1 order by `cus_name`");
							while($cus_row = $customer_qry->fetch_assoc()):
								if($cus_row['id'] == $row['customer_id']){
									echo $cus_row['cus_name'];
								}
							endwhile;
							?>
							</p></td>
							<!--<td><p class="m-0 truncate-1">
							<?php
							/*$customer_qry = $conn->query("SELECT * FROM `customer_list` where delete_flag = 0 and `status` = 1 order by `cus_name`");
							while($cus_row = $customer_qry->fetch_assoc()):
								if($cus_row['id'] == $row['customer_id']){
									echo $cus_row['cus_mob_no'];
								}
							endwhile;*/
							?>
							</p></td>-->
							<td><p class="m-0 truncate-1"><?= $row['invoice_type'] ?></p></td>
							<td class='text-right'><?= format_num($row['amount_with_gst']) ?></td>
							
							<?php
							$paid_amt = 0;
							$bal_amt = 0;
							$tran_qry = $conn->query("SELECT * from `payment` where tran_id = '{$row['id']}' and status = '0'");
							if($tran_qry->num_rows > 0){
								while($pay_row = $tran_qry->fetch_assoc()):
									$paid_amt+=$pay_row['amount'];
								endwhile;
							}
							$total_amt = $row['amount_with_gst'];
							/*if($paid_amt != '' || $paid_amt != null){
								$paid_amt = $paid_amt;
							}*/
							$bal_amt = $total_amt - $paid_amt;
							
							$overall_paid_amt+=$paid_amt;
							$overall_bal_amt+=$bal_amt;
							?>
							<td class='text-right'><?= format_num($paid_amt) ?></td>
							<td class='text-right'><?= format_num($bal_amt) ?></td>
							
							<td><p class="m-0 truncate-1">
							<?php
							$customer_qry = $conn->query("SELECT * FROM `users` where type = 3 order by `firstname`");
							while($cus_row = $customer_qry->fetch_assoc()):
								if($cus_row['id'] == $row['tech_id']){
									echo $cus_row['firstname'];
								}
							endwhile;
							?>
							</p></td>
							<td class="text-center">
								<?php 
								switch($row['status']){
									case 0:
										echo '<span class="badge badge-default border px-3 rounded-pill">Pending</span>';
										break;
									case 1:
										echo '<span class="badge badge-primary px-3 rounded-pill">On-Progress</span>';
										break;
									case 2:
										echo '<span class="badge badge-success px-3 rounded-pill">Done</span>';
										break;
									case 3:
										echo '<span class="badge badge-success bg-gradient-teal px-3 rounded-pill">Paid</span>';
										break;
									case 4:
										echo '<span class="badge badge-danger px-3 rounded-pill">Cancelled</span>';
										break;
								}
								?>
                            </td>
							<td align="center">
								<a class="btn btn-default bg-gradient-light btn-flat btn-sm" href="?page=<?php echo $view_condition; ?>/view_details&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
								
								<a class="btn btn-default bg-gradient-light btn-flat btn-sm payment" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-money-bill text-dark"></span> Payment</a>
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
		$('select#tech_id').select2({
            placeholder:"Select technician here",
            width:'100%',
            containerCssClass:'form-control form-control-sm rounded-0'
        })
	});
	$(document).ready(function(){
		$('.payment').click(function(){
			var id = $(this).attr("data-id");
			uni_modal("Payment", "transactions/payment.php?id="+id)
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
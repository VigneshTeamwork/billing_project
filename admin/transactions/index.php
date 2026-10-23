<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">List of Transactions</h3>
		<div class="card-tools">
			<?php if($_settings->userdata('type') != 3) { ?>
			<a href="./?page=transactions/manage_transaction" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
			<?php } ?>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="5%">
					<!--<col width="15%">-->
					<col width="10%">
					<col width="10%">
					<col width="7%">
					<col width="7%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Invoice Date</th>
						<th>Code</th>
						<th>Client</th>
						<th>Bill Type</th>
						<th class='text-right'>Amount</th>
						<th class='text-right'>Paid Amount</th>
						<th class='text-right'>Balance Amount</th>
						<th class="text-center">Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						if($_settings->userdata('type') == 3):
						$qry = $conn->query("SELECT * FROM `transaction_list` where tech_id = '{$_settings->userdata('id')}' order by invoice_date desc, id desc ");
						else:
						$qry = $conn->query("SELECT * FROM `transaction_list` order by invoice_date desc, id desc ");
						endif;
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><p class="m-0 truncate-1"><?= date("M d, Y", strtotime($row['invoice_date'])) ?></p></td>
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
							?>
							<td class='text-right'><?= format_num($paid_amt) ?></td>
							<td class='text-right'><?= format_num($bal_amt) ?></td>
							
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
								<a class="btn btn-default bg-gradient-light btn-flat btn-sm" href="?page=transactions/view_details&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
								
								<a class="btn btn-default bg-gradient-light btn-flat btn-sm payment" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-money-bill text-dark"></span> Payment</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
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
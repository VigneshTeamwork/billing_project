<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
$purchase_status = array(
	0 => '<span class="badge badge-default border px-3 rounded-pill">Pending</span>',
	1 => '<span class="badge badge-primary px-3 rounded-pill">Received</span>',
	2 => '<span class="badge badge-success bg-gradient-teal px-3 rounded-pill">Paid</span>',
	3 => '<span class="badge badge-danger px-3 rounded-pill">Cancelled</span>',
);
?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">List of Purchases</h3>
		<div class="card-tools">
			<a href="./?page=purchases/manage_purchase" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Purchase Date</th>
						<th>Code</th>
						<th>Supplier</th>
						<th>Supplier Bill No</th>
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
					$qry = $conn->query("SELECT p.*, s.sup_name, (SELECT COALESCE(SUM(pp.amount),0) FROM `purchase_payment` pp where pp.purchase_id = p.id and pp.status = '0') as paid_amt FROM `purchase_list` p left join `supplier_list` s on p.supplier_id = s.id order by p.purchase_date desc, p.id desc ");
					while($row = $qry->fetch_assoc()):
						$bal_amt = $row['amount_with_gst'] - $row['paid_amt'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><p class="m-0 truncate-1"><?= date("M d, Y", strtotime($row['purchase_date'])) ?></p></td>
							<td><p class="m-0 truncate-1"><?= $row['code'] ?></p></td>
							<td><p class="m-0 truncate-1"><?= $row['sup_name'] ?></p></td>
							<td><p class="m-0 truncate-1"><?= $row['supplier_bill_no'] ?></p></td>
							<td><p class="m-0 truncate-1"><?= $row['invoice_type'] ?></p></td>
							<td class='text-right'><?= format_num($row['amount_with_gst']) ?></td>
							<td class='text-right'><?= format_num($row['paid_amt']) ?></td>
							<td class='text-right'><?= format_num($bal_amt) ?></td>
							<td class="text-center"><?= isset($purchase_status[$row['status']]) ? $purchase_status[$row['status']] : '' ?></td>
							<td align="center" class="text-nowrap">
								<a class="btn btn-default bg-gradient-light btn-flat btn-sm" href="?page=purchases/view_details&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
								<a class="btn btn-default bg-gradient-light btn-flat btn-sm payment" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-money-bill text-dark"></span> Payment</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.payment').click(function(){
			uni_modal("Payment", "purchases/payment.php?id="+$(this).attr("data-id"))
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [10] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
</script>

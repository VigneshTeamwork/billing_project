<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `purchase_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
	$paid_amt = $conn->query("SELECT COALESCE(SUM(amount),0) as paid from `purchase_payment` where purchase_id = '{$_GET['id']}' and status = '0'")->fetch_assoc()['paid'];
	$total_amt = $amount_with_gst;
	$balance_amt = $total_amt - $paid_amt;
}
?>
<div class="container-fluid">
	<div class="table-responsive">
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Date</th>
					<th>Type</th>
					<th class='text-right'>Amount</th>
					<th>Desc</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 1;
					$pay_qry = $conn->query("SELECT * from `purchase_payment` where purchase_id = '{$_GET['id']}' and status = '0'");
					while($row = $pay_qry->fetch_assoc()):
				?>
					<tr>
						<td class="text-center"><?php echo $i++; ?></td>
						<td><?= date("M d, Y", strtotime($row['payment_date'])) ?></td>
						<td><?= $row['payment_type'] ?></td>
						<td class='text-right'><?= format_num($row['amount']) ?></td>
						<td><?= $row['payment_desc'] ?></td>
						<td align="center">
							<a class="btn btn-danger bg-gradient-light btn-flat btn-sm payment_delete" href="javascript:void(0)" data-id="<?php echo $row['payment_id'] ?>"><span class="fa fa-trash text-dark"></span> Delete</a>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	<?php if($balance_amt != 0): ?>
		<form action="" id="payment-form">
			<input type="hidden" name="purchase_id" value="<?= isset($id) ? $id : '' ?>">
			<div class="form-group mb-3">
				<label class="control-label">Bill Amount : <?= isset($total_amt) ? $total_amt : '' ?></label>
			</div>
			<div class="form-group mb-3">
				<label class="control-label">Paid Amount : <?= isset($paid_amt) ? $paid_amt : '0.00' ?></label>
			</div>
			<div class="form-group mb-3">
				<label class="control-label">Balance Amount : <?= isset($balance_amt) ? $balance_amt : '' ?></label>
			</div>
			<div class="form-group mb-3">
				<label for="payment_date" class="control-label">Date</label>
				<input type="date" class="form-control rounded-0" placeholder="Date" name="payment_date" id="payment_date" required />
			</div>
			<div class="form-group mb-3">
				<label for="amount" class="control-label">Amount</label>
				<input type="number" step="any" class="form-control rounded-0" placeholder="Amount" name="amount" id="amount" onchange="check_amount(this.value)" required />
			</div>
			<div class="form-group mb-3">
				<label for="payment_type" class="control-label">Type</label>
				<select name="payment_type" id="payment_type" class="form-control rounded-0" required>
					<option value="Cash">Cash</option>
					<option value="Card">Card</option>
					<option value="Net Banking">Net Banking</option>
					<option value="Others">Others</option>
				</select>
			</div>
			<div class="form-group mb-3">
				<label for="payment_desc" class="control-label">Description</label>
				<textarea class="form-control rounded-0" placeholder="Description" name="payment_desc" id="payment_desc"></textarea>
			</div>
		</form>
	<?php endif; ?>
</div>
<script>
	function check_amount(given_amt){
		var balance_amt = <?= isset($balance_amt) ? $balance_amt : 0 ?>;
		if(parseFloat(given_amt) > parseFloat(balance_amt)){
			document.getElementById("amount").value = "";
			alert('Given Amount is Greater Then For balance Amount')
		}
	}
	$(document).ready(function(){
		$('.payment_delete').click(function(){
			$('#uni_modal').hide();
			_conf("Are you sure to delete this Payment permanently?","delete_purchase_payment",[$(this).attr('data-id')])
		})
		$('#payment-form').submit(function(e){
			e.preventDefault();
			var _this = $(this)
			$('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_purchase_payment",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.reload()
					}else if(resp.status == 'failed' && !!resp.msg){
						var el = $('<div>')
							el.addClass("alert alert-danger err-msg").text(resp.msg)
							_this.prepend(el)
							el.show('slow')
							$("html, body, .modal").scrollTop(0);
							end_loader()
					}else{
						alert_toast("An error occured",'error');
						end_loader();
					}
				}
			})
		})
	})
	function delete_purchase_payment($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_purchase_payment",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>

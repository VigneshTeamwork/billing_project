<?php 
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `quotation_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="convert-to-invoice-form">
        <input type="hidden" name="quotation_id" value="<?= isset($id) ? $id : '' ?>">
        <input type="hidden" name="user_id" value="<?= isset($user_id) ? $user_id : '' ?>">
        <input type="hidden" name="invoice_type" value="<?= isset($invoice_type) ? $invoice_type : '' ?>">
        <input type="hidden" name="customer_id" value="<?= isset($customer_id) ? $customer_id : '' ?>">
        <input type="hidden" name="sub_amount" value="<?= isset($sub_amount) ? $sub_amount : '' ?>">
        <input type="hidden" name="dis_amt" value="<?= isset($dis_amt) ? $dis_amt : '' ?>">
        <input type="hidden" name="cgst" value="<?= isset($cgst) ? $cgst : '' ?>">
        <input type="hidden" name="sgst" value="<?= isset($sgst) ? $sgst : '' ?>">
        <input type="hidden" name="cgst_amt" value="<?= isset($cgst_amt) ? $cgst_amt : '' ?>">
        <input type="hidden" name="sgst_amt" value="<?= isset($sgst_amt) ? $sgst_amt : '' ?>">
        <input type="hidden" name="amount_with_gst" value="<?= isset($amount_with_gst) ? $amount_with_gst : '' ?>">
        <input type="hidden" name="amount" value="<?= isset($amount) ? $amount : '' ?>">
        <input type="hidden" name="status" value="<?= isset($status) ? $status : '' ?>">
		<?php 
		$ts_service_query = $conn->query("SELECT * FROM `quotation_services` where `quotation_id` = '{$_GET['id']}' ");
		while($row = $ts_service_query->fetch_assoc()):
		?>
		<input type="hidden" name="service_id[]" value="<?= isset($row['service_id']) ? $row['service_id'] : '' ?>">
		<input type="hidden" name="service_qty[]" value="<?= isset($row['qty']) ? $row['qty'] : '' ?>">
		<input type="hidden" name="service_price[]" value="<?= isset($row['price']) ? $row['price'] : '' ?>">
		<input type="hidden" name="service_dis_type[]" value="<?= isset($row['service_dis_type']) ? $row['service_dis_type'] : '' ?>">
		<input type="hidden" name="service_discount_amt[]" value="<?= isset($row['service_discount_amt']) ? $row['service_discount_amt'] : '' ?>">
		<input type="hidden" name="service_discount[]" value="<?= isset($row['service_discount']) ? $row['service_discount'] : '' ?>">
		<input type="hidden" name="service_total[]" value="<?= isset($row['service_total']) ? $row['service_total'] : '' ?>">
		<?php endwhile; ?>
		
		<?php 
		$ts_product_query = $conn->query("SELECT * FROM `quotation_products` where `quotation_id` = '{$_GET['id']}' ");
		while($row = $ts_product_query->fetch_assoc()):
		?>
		<input type="hidden" name="product_id[]" value="<?= isset($row['product_id']) ? $row['product_id'] : '' ?>">
		<input type="hidden" name="product_qty[]" value="<?= isset($row['qty']) ? $row['qty'] : '' ?>">
		<input type="hidden" name="product_price[]" value="<?= isset($row['price']) ? $row['price'] : '' ?>">
		<input type="hidden" name="product_dis_type[]" value="<?= isset($row['product_dis_type']) ? $row['product_dis_type'] : '' ?>">
		<input type="hidden" name="product_discount_amt[]" value="<?= isset($row['product_discount_amt']) ? $row['product_discount_amt'] : '' ?>">
		<input type="hidden" name="product_discount[]" value="<?= isset($row['product_discount']) ? $row['product_discount'] : '' ?>">
		<input type="hidden" name="product_total[]" value="<?= isset($row['product_total']) ? $row['product_total'] : '' ?>">
		<?php endwhile; ?>
        <div class="form-group mb-3">
            <label for="status" class="control-label">Aru You Sure to Want Quotation to Invoice Convert ?</label>
        </div>
		<div class="form-group mb-3">
            <?php if($_settings->userdata('type') == 3 && !isset($id)): ?>
                            
			<?php endif; ?>
			<?php if($_settings->userdata('type') != 3): ?>
			<fieldset>
				<legend>Assign</legend>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<select name="tech_id" id="tech_id" class="form-control form-control rounded-0" required >
							<option value="" disabled <?= !isset($tech_id) ? "selected" : "" ?>></option>
							<option value="" <?= isset($tech_id) && in_array($tech_id,[null,""]) ? "selected" : "" ?>>Unset</option>
							<?php 
							$tech_qry = $conn->query("SELECT *,concat(firstname,' ', lastname) as `name` FROM `users` where `type` = 3 order by `name` asc");
							while($row = $tech_qry->fetch_array()):
							?>
							<option value="<?= $row['id'] ?>" <?= isset($tech_id) && $tech_id == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>
			</fieldset>
			<?php endif; ?>
        </div>
    </form>
</div>
<script>
	$(function(){
		$('select#tech_id').select2({
			placeholder:"Select technician here",
			width:'100%',
			containerCssClass:'form-control form-control-sm rounded-0'
		})
	});
	$(document).ready(function(){
		$('#convert-to-invoice-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=convert_to_invoice",
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
						//location.reload()
						location.href = "./?page=transactions/view_details&id="+resp.tid
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
</script>
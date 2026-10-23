<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `quotation_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }else{
        echo '<script> alert("Unknown Quotation\'s ID."); location.replace("./?page=quotations"); </script>';
    }
}
?>
<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-outline rounded-0 shadow blur">
            <div class="card-header">
                <h5 class="card-title"><?= isset($id) ? "Update ". $code . " Quotation" : "New Quotation" ?></h5>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="quotation-form">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                        <input type="hidden" name="sub_amount" value="<?= isset($sub_amount) ? $sub_amount : 0 ?>">
						<input type="hidden" name="dis_amt" value="<?= isset($dis_amt) ? $dis_amt : 0 ?>">
						<input type="hidden" name="cgst_amt" value="<?= isset($cgst_amt) ? $cgst_amt : 0 ?>">
						<input type="hidden" name="sgst_amt" value="<?= isset($sgst_amt) ? $sgst_amt : 0 ?>">
                        <input type="hidden" name="amount" value="<?= isset($amount) ? $amount : '' ?>">
                        <input type="hidden" name="amount_with_gst" value="<?= isset($amount_with_gst) ? $amount_with_gst : 0 ?>">
						<div class="row">
                            
                        </div>
                        <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group mb-3">
                                    <label for="invoice_type" class="control-label">Quotation Type</label>
									<select id="invoice_type" name="invoice_type" class="form-control form-control-sm rounded">
										<option value="" disabled selected></option>
										<option value="GST" <?php if(isset($invoice_type)){ if($invoice_type == 'GST'){ echo "selected"; } } ?>>GST</option>
										<option value="Non-GST" <?php if(isset($invoice_type)){ if($invoice_type == 'Non-GST'){ echo "selected"; } }else{ echo "selected"; } ?> >Non-GST</option>
									</select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group mb-3">
                                    <label for="quotation_date" class="control-label">Quotation Date</label>
                                    <input type="date" name="quotation_date" id="quotation_date" class="form-control form-control-sm rounded-0" value="<?= isset($quotation_date) ? $quotation_date : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group mb-3">
                                    <label for="customer_id" class="control-label">Select Customer</label>
									<select id="customer_id" name="customer_id" class="form-control form-control-sm rounded">
										<option value="" disabled selected></option>
										<?php 
										$service_qry = $conn->query("SELECT * FROM `customer_list` where delete_flag = 0 and `status` = 1 order by `cus_name`");
										while($row = $service_qry->fetch_assoc()): ?>
										<?php 
										if(isset($customer_id)){
											if($row['id'] == $customer_id){
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
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <fieldset>
                                    <legend>Services</legend>
                                    <div class="row align-items-end">
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
                                            <div class="form-group mb-0">
                                                <label for="service_sel" class="control-label">Select Service</label>
                                                <select id="service_sel" class="form-control form-control-sm rounded">
                                                    <option value="" disabled selected></option>
                                                    <?php 
                                                    $service_qry = $conn->query("SELECT * FROM `service_list` where delete_flag = 0 and `status` = 1 order by `name`");
                                                    while($row = $service_qry->fetch_assoc()):
                                                    ?>
                                                    <option value="<?= $row['id'] ?>" data-price = "<?= $row['price'] ?>"><?= $row['name'] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                            <button class="btn btn-default bg-gradient-navy btn-sm rounded-0" type="button" id="add_service"><i class="fa fa-plus"></i> Add</button>
                                        </div>
                                    </div>
                                    <div class="clear-fix mb-2"></div>
                                    <table class="table table-striped table-bordered" id="service-list">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="25%">
                                            <col width="10%">
                                            <col width="20%">
                                            <col width="20%">
                                            <col width="10%">
                                            <col width="10%">
                                        </colgroup>
                                        <thead>
                                            <tr class="bg-gradient-navy">
                                                <th class="text-center"></th>
                                                <th class="text-center">Service</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Price</th>
												<th class="text-center">Dis.Type</th>
												<th class="text-center">Discount</th>
												<th class="text-center">Line Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $service_amount = 0;
                                            if(isset($id)):
                                            $ts_qry = $conn->query("SELECT ts.*, s.name as `service` FROM `quotation_services` ts inner join `service_list` s on ts.service_id = s.id where ts.`quotation_id` = '{$id}' ");
                                            while($row = $ts_qry->fetch_assoc()):
                                                $service_amount += $row['service_total'];
                                            ?>
                                            <tr>
                                                <td class="text-center">
                                                    <button class="btn btn-outline-danger btn-sm rounded-0 rem-service" type="button"><i class="fa fa-times"></i></button>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="service_id[]" value="<?= $row['service_id'] ?>">
                                                    <input type="hidden" name="service_price[]" value="<?= $row['price'] ?>">
                                                    <input type="hidden" name="service_total[]" value="<?= $row['service_total'] ?>">
                                                    <span class="service_name"><?= $row['service'] ?></span>
                                                </td>
												<td class="">
													<input type="number" min="1" class="form-control form-control-sm rounded-0 text-right" name="service_qty[]" value="<?= $row['qty'] ?>">
												</td>
												<td class="text-right service_price"><?= format_num($row['price']) ?></td>
												<td class="text-right service_dis_type">
													<select id="service_dis_type" name="service_dis_type[]" class="form-control form-control-sm rounded">
														<option value="" selected>Select Discount Type</option>
														<option value="Percentage" <?php if(!empty($row['service_dis_type'])){ if($row['service_dis_type'] == 'Percentage'){ echo "selected"; } } ?>>Percentage</option>
														<option value="Fixed Amount" <?php if(!empty($row['service_dis_type'])){ if($row['service_dis_type'] == 'Fixed Amount'){ echo "selected"; } } ?>>Fixed Amount</option>
													</select>
												</td>
												<td class="text-right service">
													<input type="hidden" name="service_discount_amt[]" class="form-control form-control-sm rounded" value="<?= !empty($row['service_discount_amt']) ? $row['service_discount_amt'] : 0 ?>">
													<input type="text" name="service_discount[]" class="form-control form-control-sm rounded" value="<?= !empty($row['service_discount']) ? $row['service_discount'] : 0 ?>">
												</td>
                                                <td class="text-right service_total"><?= format_num($row['service_total']) ?></td>
                                            </tr>
                                            <?php endwhile; ?>
                                            <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-gradient-secondary">
                                                <th colspan="6" class="text-right">Total</th>
                                                <th class="text-right" id="service_total"><?= isset($service_amount) ? format_num($service_amount): 0 ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <fieldset>
                                    <legend>Products</legend>
                                    <div class="row align-items-end">
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
                                            <div class="form-group mb-0">
                                                <label for="product_sel" class="control-label">Select Product</label>
                                                <select id="product_sel" class="form-control form-control-sm rounded">
                                                    <option value="" disabled selected></option>
                                                    <?php 
                                                    $product_qry = $conn->query("SELECT * FROM `product_list` where delete_flag = 0 and `status` = 1 order by `name`");
                                                    while($row = $product_qry->fetch_assoc()):
                                                    ?>
                                                    <option value="<?= $row['id'] ?>" data-price = "<?= $row['price'] ?>"><?= $row['name'] ?> - <?= $row['product_code'] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                            <button class="btn btn-default bg-gradient-navy btn-sm rounded-0" type="button" id="add_product"><i class="fa fa-plus"></i> Add</button>
                                        </div>
                                    </div>
                                    <div class="clear-fix mb-2"></div>
                                    <table class="table table-striped table-bordered" id="product-list">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="25%">
                                            <col width="10%">
                                            <col width="20%">
                                            <col width="20%">
                                            <col width="10%">
                                            <col width="10%">
                                        </colgroup>
                                        <thead>
                                            <tr class="bg-gradient-navy">
                                                <th class="text-center"></th>
                                                <th class="text-center">Item Name</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Price</th>
												<th class="text-center">Dis.Type</th>
												<th class="text-center">Discount</th>
												<th class="text-center">Line Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $product_total = 0;
                                            if(isset($id)):
                                            $tp_qry = $conn->query("SELECT tp.*, p.name as `product` FROM `quotation_products` tp inner join `product_list` p on tp.product_id = p.id where tp.`quotation_id` = '{$id}' ");
                                            while($row = $tp_qry->fetch_assoc()):
                                                //$product_total += ($row['price'] * $row['qty']);
                                                $product_total += $row['product_total'];
                                        ?>
                                            <tr>
                                                <td class="text-center">
                                                    <button class="btn btn-outline-danger btn-sm rounded-0 rem-product" type="button"><i class="fa fa-times"></i></button>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="product_id[]" value="<?= $row['product_id'] ?>">
                                                    <input type="hidden" name="product_price[]" value="<?= $row['price'] ?>">
                                                    <input type="hidden" name="product_total[]" value="<?= $row['product_total'] ?>">
                                                    <span class="product_name"><?= $row['product'] ?></span>
                                                </td>
                                                <td class="">
													<input type="number" min="1" class="form-control form-control-sm rounded-0 text-right" name="product_qty[]" value="<?= $row['qty'] ?>">
												</td>
                                                <td class="text-right product_price"><?= $row['price'] ?></td>
												<td class="text-right product_dis_type">
													<select id="product_dis_type" name="product_dis_type[]" class="form-control form-control-sm rounded">
														<option value="" selected>Select Discount Type</option>
														<option value="Percentage" <?php if(!empty($row['product_dis_type'])){ if($row['product_dis_type'] == 'Percentage'){ echo "selected"; } } ?>>Percentage</option>
														<option value="Fixed Amount" <?php if(!empty($row['product_dis_type'])){ if($row['product_dis_type'] == 'Fixed Amount'){ echo "selected"; } } ?>>Fixed Amount</option>
													</select>
												</td>
												<td class="text-right product">
													<input type="hidden" name="product_discount_amt[]" class="form-control form-control-sm rounded" value="<?= !empty($row['product_discount_amt']) ? $row['product_discount_amt'] : 0 ?>">
													<input type="text" name="product_discount[]" class="form-control form-control-sm rounded" value="<?= !empty($row['product_discount']) ? $row['product_discount'] : 0 ?>">
												</td>
                                                <td class="text-right product_total"><?= format_num($row['product_total']) ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                        <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-gradient-secondary">
                                                <th colspan="6" class="text-right">Total</th>
                                                <th class="text-right" id="product_total"><?= isset($product_total) ? format_num($product_total): 0 ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </fieldset>
                            </div>
                        </div>
                        <div class="clear-fix mb-3"></div>
                        
						<table class="table table-striped table-bordered">
							<tr>
								<td style="width:75%;"><h5 class="text-navy text-right">Sub Total: </h5></td>
								<td style="width:25%;"><h5 class="text-navy text-right"><b id="sub_amount"><?= isset($sub_amount) ? format_num($sub_amount) : "0.00" ?></b></h5></td>
							</tr>
							<tr>
								<td><h5 class="text-navy text-right">Discount Amount: </h5></td>
								<td><h5 class="text-navy text-right"><b id="dis_amt"><?= isset($dis_amt) ? format_num($dis_amt) : "0.00" ?></b></h5></td>
							</tr>
							<tr class="gst_segment">
								<td>
								<h5 class="text-navy text-right" style>CGST:</h5>
								<input type="number" name="cgst" id="cgst" class="form-control form-control-sm rounded-0 text-right" value="<?= isset($cgst) ? $cgst : 0 ?>" style="width:10%;float:right;">
								</td>
								<td><h5 class="text-navy text-right"><b id="cgst_amt"><?= isset($cgst_amt) ? $cgst_amt : 0 ?></b></h5></td>
							</tr>
							<tr class="gst_segment">
								<td>
								<h5 class="text-navy text-right">SGST: </h5>
								<input type="number" name="sgst" id="sgst" class="form-control form-control-sm rounded-0 text-right" value="<?= isset($sgst) ? $sgst : 0 ?>" style="width:10%;float:right;">
								</td>
								<td><h5 class="text-navy text-right"><b id="sgst_amt"><?= isset($sgst_amt) ? $sgst_amt : 0 ?></b></h5></td>
							</tr>
							<tr>
								<td><h5 class="text-navy text-right">Grand Total: </h5></td>
								<?php
								if(isset($invoice_type)){
									if($invoice_type == 'GST'){
										?>
										<td><h5 class="text-navy text-right"><b id="amount"><?= isset($amount_with_gst) ? format_num($amount_with_gst) : "0.00" ?></b></h5></td>
										<?php
									}else{
										?>
										<td><h5 class="text-navy text-right"><b id="amount"><?= isset($amount) ? format_num($amount) : "0.00" ?></b></h5></td>
										<?php
									}
								}else{
									?>
									<td><h5 class="text-navy text-right"><b id="amount"><?= isset($amount) ? format_num($amount) : "0.00" ?></b></h5></td>
									<?php
								}
								?>
								
							</tr>
						</table>
                        <hr>
						<input type="hidden" name="tech_id" value="">
                    </form>
                </div>
            </div>
            <div class="card-footer py-2 text-right">
                <button class="btn btn-primary rounded-0" form="quotation-form">Save Quotation</button>
                <?php if(!isset($id)): ?>
                <a class="btn btn-default border rounded-0" href="./?page=quotations">Cancel</a>
                <?php else: ?>
                <a class="btn btn-default border rounded-0" href="./?page=quotations/view_details&id=<?= $id ?>">Cancel</a>
                <?php endif; ?> 
            </div>
        </div>
    </div>
</div>
<noscript id="service-clone">
    <tr>
        <td class="text-center">
            <button class="btn btn-outline-danger btn-sm rounded-0 rem-service" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td>
            <input type="hidden" name="service_id[]" value="">
            <input type="hidden" name="service_price[]" value="0">
            <input type="hidden" name="service_total[]" value="0">
            <span class="service_name"></span>
        </td>
		<td class=""><input type="number" min="1" class="form-control form-control-sm rounded-0 text-right" name="service_qty[]" value="1"></td>
        <td class="text-right service_price"></td>
		<td class="text-right service_dis_type">
			<select id="service_dis_type" name="service_dis_type[]" class="form-control form-control-sm rounded">
				<option value="" selected>Select Discount Type</option>
				<option value="Percentage">Percentage</option>
				<option value="Fixed Amount">Fixed Amount</option>
			</select>
		</td>
		<td class="text-right service">
			<input type="hidden" name="service_discount_amt[]" class="form-control form-control-sm rounded" value="0">
			<input type="number" name="service_discount[]" class="form-control form-control-sm rounded" value="0">
		</td>
        <td class="text-right service_total"></td>
    </tr>
</noscript>
<noscript id="product-clone">
    <tr>
        <td class="text-center">
            <button class="btn btn-outline-danger btn-sm rounded-0 rem-product" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="">
            <input type="hidden" name="product_price[]" value="0">
            <input type="hidden" name="product_total[]" value="0">
            <span class="product_name"></span>
        </td>
        <td class=""><input type="number" min="1" class="form-control form-control-sm rounded-0 text-right" name="product_qty[]" value="1"></td>
        <td class="text-right product_price"></td>
		<td class="text-right product_dis_type">
			<select id="product_dis_type" name="product_dis_type[]" class="form-control form-control-sm rounded">
				<option value="" selected>Select Discount Type</option>
				<option value="Percentage">Percentage</option>
				<option value="Fixed Amount">Fixed Amount</option>
			</select>
		</td>
		<td class="text-right product_discount">
			<input type="hidden" name="product_discount_amt[]" class="form-control form-control-sm rounded" value="0">
			<input type="number" name="product_discount[]" class="form-control form-control-sm rounded" value="0">
		</td>
        <td class="text-right product_total"></td>
    </tr>
</noscript>
<script>
	var invoice_type = $('#invoice_type').val()
	if(invoice_type == 'Non-GST'){
		$('.gst_segment').hide()
	}else{
		$('.gst_segment').show()
	}
	$('#invoice_type').on('select change', function(){
		var invoice_type = $(this).val()
		if(invoice_type == 'Non-GST'){
			$('.gst_segment').hide()
		}else{
			$('.gst_segment').show()
		}
		calc_total_amount();
	})
	
	$('#cgst').on('input change', function(){
		var cgst = $(this).val();
		var total = $('[name="amount"]').val();
		var cgst_amt = parseFloat(total) * parseFloat(cgst) / 100;
		$('[name="cgst_amt"]').val(parseFloat(cgst_amt))
        $('#cgst_amt').text(parseFloat(cgst_amt).toLocaleString('en-US'))
		calc_total_amount();
	})
	
	$('#sgst').on('input change', function(){
		var sgst = $(this).val();
		var total = $('[name="amount"]').val();
		
		var sgst_amt = parseFloat(total) * parseFloat(sgst) / 100;
		
		$('[name="sgst_amt"]').val(parseFloat(sgst_amt))
        $('#sgst_amt').text(parseFloat(sgst_amt).toLocaleString('en-US'))
		calc_total_amount();
	})
	
    function calc_total_amount(){
        var service_dis_amt = 0;
        var product_dis_amt = 0;
        var sub_total = 0;
        var total = 0;		
		var cgst_amt = 0;
		var sgst_amt = 0;
		var gst_amt = 0;
		var total_with_gst = 0;
		
        /*$('#service-list tbody tr').each(function(){
            sub_total += parseFloat($(this).find('[name="service_price[]"]').val())
        })*/
		$('#service-list tbody tr').each(function(){
            var service_qty = $(this).find('[name="service_qty[]"]').val()
            service_qty = service_qty > 0 ? service_qty : 0
            sub_total += (parseFloat($(this).find('[name="service_price[]"]').val()) * parseFloat(service_qty))
        })
        $('#product-list tbody tr').each(function(){
            var qty = $(this).find('[name="product_qty[]"]').val()
            qty = qty > 0 ? qty : 0
            sub_total += (parseFloat($(this).find('[name="product_price[]"]').val()) * parseFloat(qty))
        })
		
		
		
		
		$('#service-list tbody tr').each(function(){
            total += parseFloat($(this).find('[name="service_total[]"]').val())
            service_dis_amt += parseFloat($(this).find('[name="service_discount_amt[]"]').val())
        })
        $('#product-list tbody tr').each(function(){
            total += parseFloat($(this).find('[name="product_total[]"]').val());
			product_dis_amt += parseFloat($(this).find('[name="product_discount_amt[]"]').val())
        })
		var dis_amt = parseFloat(service_dis_amt) + parseFloat(product_dis_amt)
		
		var invoice_type = $('#invoice_type').val()
		if(invoice_type == 'GST'){
			cgst_amt = $('[name="cgst_amt"]').val()
			sgst_amt = $('[name="sgst_amt"]').val()
			gst_amt = parseFloat(cgst_amt) + parseFloat(sgst_amt);
			total_with_gst = parseFloat(total) + parseFloat(gst_amt)
		}
		
		$('[name="sub_amount"]').val(parseFloat(sub_total))
        $('#sub_amount').text(parseFloat(sub_total).toLocaleString('en-US'))
		
		$('[name="dis_amt"]').val(parseFloat(dis_amt))
        $('#dis_amt').text(parseFloat(dis_amt).toLocaleString('en-US'))
		
        $('[name="amount"]').val(parseFloat(total))
        $('#amount').text(parseFloat(total).toLocaleString('en-US'))
		
		if(invoice_type == 'GST'){
			$('[name="amount_with_gst"]').val(parseFloat(total_with_gst))
			$('#amount').text(parseFloat(total_with_gst).toLocaleString('en-US'))
		}else{
			$('[name="amount_with_gst"]').val(parseFloat(total))
			$('#amount').text(parseFloat(total).toLocaleString('en-US'))
		}
		
		
    }
    function calc_service(){
        var total = 0;
        $('#service-list tbody tr').each(function(){
            //total += parseFloat($(this).find('[name="service_price[]"]').val())
            total += parseFloat($(this).find('[name="service_total[]"]').val())
        })
        $('#service_total').text(parseFloat(total).toLocaleString('en-US'))
        calc_total_amount()
    }
    function calc_product(){
        var total = 0;
        
        $('#product-list tbody tr').each(function(){
            /*var qty = $(this).find('[name="product_qty[]"]').val()
            qty = qty > 0 ? qty : 0
            total += (parseFloat($(this).find('[name="product_price[]"]').val()) * parseFloat(qty))*/
			total += parseFloat($(this).find('[name="product_total[]"]').val());
        })
        $('#product_total').text(parseFloat(total).toLocaleString('en-US'))
        calc_total_amount()
    }
    $(function(){
		// New quotation: default to today's date on this computer (server clock is set to a different timezone).
		if(!$('#quotation_date').val()) $('#quotation_date').val(new Date().toLocaleDateString('en-CA'))
		$('select#invoice_type').select2({
            placeholder:"Select Quotation Type here",
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
        $('#service_sel').select2({
            placeholder:"Select service here",
            width:'100%',
            containerCssClass:'form-control form-control-sm rounded-0'
        })
        $('#product_sel').select2({
            placeholder:"Select product here",
            width:'100%',
            containerCssClass:'form-control form-control-sm rounded-0'
        })
        $('#service-list tbody tr').find('.rem-service').click(function(){
            var tr = $(this).closest('tr')
            if(confirm("Are you sure to remove "+(tr.find('.service_name').text())+" from service list?") === true){
                tr.remove()
                calc_service()
            }
        })
        $('#product-list tbody tr').find('.rem-product').click(function(){
            var tr = $(this).closest('tr')
            if(confirm("Are you sure to remove "+(tr.find('.product_name').text())+" from product list?") === true){
                tr.remove()
                calc_product()
            }
        })
        $('#product-list tbody tr').find('[name="product_qty[]"]').on('input change', function(){
            var tr = $(this).closest('tr')
            var qty = $(this).val()
            qty = qty > 0 ? qty : 0
			var price = tr.find('input[name="product_price[]"]').val();
            var total = parseFloat(qty) * parseFloat(price)
            tr.find('.product_total').text(parseFloat(total).toLocaleString())
            calc_product()
        })
		
		$('#product-list tbody tr').find('[name="product_dis_type[]"]').on('select change', function(){
			var tr = $(this).closest('tr');
			var price = tr.find('input[name="product_price[]"]').val();
            var qty = tr.find('input[name="product_qty[]"]').val()
			var product_discount = tr.find('input[name="product_discount[]"]').val()
			var product_dis_type = tr.find('select[name="product_dis_type[]"]').val()
			var total = parseFloat(qty) * parseFloat(price)
			if(product_dis_type == 'Percentage'){
				var dis_value = parseFloat(total) * parseFloat(product_discount) / 100;
			}else if(product_dis_type == 'Fixed Amount'){
				var dis_value = parseFloat(product_discount);
			}else{
				var dis_value = 0;
			}
			var after_dis_total = parseFloat(total) - parseFloat(dis_value)
			tr.find('input[name="product_discount_amt[]"]').val(dis_value)
			tr.find('input[name="product_total[]"]').val(after_dis_total)
			tr.find('.product_total').text(parseFloat(after_dis_total).toLocaleString())
			calc_product()
        })
		
		$('#product-list tbody tr').find('[name="product_discount[]"]').on('select change', function(){
			var tr = $(this).closest('tr');
			var price = tr.find('input[name="product_price[]"]').val();
            var qty = tr.find('input[name="product_qty[]"]').val()
			var product_discount = tr.find('input[name="product_discount[]"]').val()
			var product_dis_type = tr.find('select[name="product_dis_type[]"]').val()
			var total = parseFloat(qty) * parseFloat(price)
			if(product_dis_type == 'Percentage'){
				var dis_value = parseFloat(total) * parseFloat(product_discount) / 100;
			}else if(product_dis_type == 'Fixed Amount'){
				var dis_value = parseFloat(product_discount);
			}else{
				var dis_value = 0;
			}
			var after_dis_total = parseFloat(total) - parseFloat(dis_value)
			tr.find('input[name="product_discount_amt[]"]').val(dis_value)
			tr.find('input[name="product_total[]"]').val(after_dis_total)
			tr.find('.product_total').text(parseFloat(after_dis_total).toLocaleString())
			calc_product()
        })
		
		$('#service-list tbody tr').find('[name="service_qty[]"]').on('input change', function(){
            var tr = $(this).closest('tr')
            var qty = $(this).val()
            qty = qty > 0 ? qty : 0
			var price = tr.find('input[name="service_price[]"]').val();
            var total = parseFloat(qty) * parseFloat(price)
            tr.find('.service_total').text(parseFloat(total).toLocaleString())
            calc_service()
        })
		
		$('#service-list tbody tr').find('[name="service_dis_type[]"]').on('select change', function(){
			var tr = $(this).closest('tr')
			var price = tr.find('input[name="service_price[]"]').val();
            var qty = tr.find('input[name="service_qty[]"]').val()
			var service_discount = tr.find('input[name="service_discount[]"]').val()
			var service_dis_type = tr.find('select[name="service_dis_type[]"]').val()
			var total = parseFloat(qty) * parseFloat(price)
			if(service_dis_type == 'Percentage'){
				var dis_value = parseFloat(total) * parseFloat(service_discount) / 100;
			}else if(service_dis_type == 'Fixed Amount'){
				var dis_value = parseFloat(service_discount);
			}else{
				var dis_value = 0;
			}
			var after_dis_total = parseFloat(total) - parseFloat(dis_value)
			tr.find('input[name="service_discount_amt[]"]').val(dis_value)
			tr.find('input[name="service_total[]"]').val(after_dis_total)
			tr.find('.service_total').text(parseFloat(after_dis_total).toLocaleString())
			calc_service()
        })
		
		$('#service-list tbody tr').find('[name="service_discount[]"]').on('select change', function(){
			var tr = $(this).closest('tr')
			var price = tr.find('input[name="service_price[]"]').val();
            var qty = tr.find('input[name="service_qty[]"]').val()
			var service_discount = tr.find('input[name="service_discount[]"]').val()
			var service_dis_type = tr.find('select[name="service_dis_type[]"]').val()
			var total = parseFloat(qty) * parseFloat(price)
			if(service_dis_type == 'Percentage'){
				var dis_value = parseFloat(total) * parseFloat(service_discount) / 100;
			}else if(service_dis_type == 'Fixed Amount'){
				var dis_value = parseFloat(service_discount);
			}else{
				var dis_value = 0;
			}
			var after_dis_total = parseFloat(total) - parseFloat(dis_value)
			tr.find('input[name="service_discount_amt[]"]').val(dis_value)
			tr.find('input[name="service_total[]"]').val(after_dis_total)
			tr.find('.service_total').text(parseFloat(after_dis_total).toLocaleString())
			calc_service()
        })

        $('#add_service').click(function(){
            if($('#service_sel').val() == null)
            return false;
            var id = $('#service_sel').val()
            if($('#service-list tbody tr input[name="service_id[]"][value="'+id+'"]').length > 0){
                alert("Service already on the list.")
                return false;
            }
            var name = $('#service_sel option[value="'+id+'"]').text()
            var price = $('#service_sel option[value="'+id+'"]').attr('data-price')
            var tr = $($('noscript#service-clone').html()).clone()
            tr.find('input[name="service_id[]"]').val(id)
            tr.find('input[name="service_price[]"]').val(price)
            tr.find('.service_name').text(name)
            tr.find('.service_price').text(parseFloat(price).toLocaleString())
            tr.find('.service_total').text(parseFloat(price).toLocaleString())
			tr.find('input[name="service_total[]"]').val(price)
            $('#service-list tbody').append(tr)
            calc_service()
            tr.find('.rem-service').click(function(){
                if(confirm("Are you sure to remove "+name+" from service list?") === true){
                    tr.remove()
                    calc_service()
                }
            })
			
			tr.find('[name="service_qty[]"]').on('input change', function(){
				var qty = $(this).val()
                qty = qty > 0 ? qty : 0
                
				var service_discount = tr.find('input[name="service_discount[]"]').val()
				service_discount = service_discount > 0 ? service_discount : 0
                var service_dis_type = tr.find('select[name="service_dis_type[]"]').val()
				var total = parseFloat(qty) * parseFloat(price)
				
				if(service_dis_type == 'Percentage'){
					var dis_value = parseFloat(total) * parseFloat(service_discount) / 100;
				}else if(service_dis_type == 'Fixed Amount'){
					var dis_value = parseFloat(service_discount);
				}else{
					var dis_value = 0;
				}
				
				var after_dis_total = parseFloat(total) - parseFloat(dis_value)
                tr.find('input[name="service_discount_amt[]"]').val(dis_value)
                tr.find('input[name="service_total[]"]').val(after_dis_total)
                tr.find('.service_total').text(parseFloat(after_dis_total).toLocaleString())
                calc_service()
            })
			
			tr.find('[name="service_dis_type[]"]').on('select change', function(){
				var qty = tr.find('input[name="service_qty[]"]').val()
				var service_discount = tr.find('input[name="service_discount[]"]').val()
                var service_dis_type = tr.find('select[name="service_dis_type[]"]').val()
				var total = parseFloat(qty) * parseFloat(price)
				if(service_dis_type == 'Percentage'){
					var dis_value = parseFloat(total) * parseFloat(service_discount) / 100;
				}else if(service_dis_type == 'Fixed Amount'){
					var dis_value = parseFloat(service_discount);
				}else{
					var dis_value = 0;
				}
				var after_dis_total = parseFloat(total) - parseFloat(dis_value)
                tr.find('input[name="service_discount_amt[]"]').val(dis_value)
                tr.find('input[name="service_total[]"]').val(after_dis_total)
                tr.find('.service_total').text(parseFloat(after_dis_total).toLocaleString())
                calc_service()
            })
			
			tr.find('[name="service_discount[]"]').on('input change', function(){
				var qty = tr.find('input[name="service_qty[]"]').val()
				var service_discount = tr.find('input[name="service_discount[]"]').val()
                var service_dis_type = tr.find('select[name="service_dis_type[]"]').val()
				var total = parseFloat(qty) * parseFloat(price)
				if(service_dis_type == 'Percentage'){
					var dis_value = parseFloat(total) * parseFloat(service_discount) / 100;
				}else if(service_dis_type == 'Fixed Amount'){
					var dis_value = parseFloat(service_discount);
				}else{
					var dis_value = 0;
				}
				var after_dis_total = parseFloat(total) - parseFloat(dis_value)
                tr.find('input[name="service_discount_amt[]"]').val(dis_value)
                tr.find('input[name="service_total[]"]').val(after_dis_total)
                tr.find('.service_total').text(parseFloat(after_dis_total).toLocaleString())
                calc_service()
            })
			
            $('#service_sel').val('').trigger("change")
        })
        $('#add_product').click(function(){
            if($('#product_sel').val() == null)
            return false;
            var id = $('#product_sel').val()
            if($('#product-list tbody tr input[name="product_id[]"][value="'+id+'"]').length > 0){
                alert("Product already on the list.")
                return false;
            }
            var name = $('#product_sel option[value="'+id+'"]').text()
            var price = $('#product_sel option[value="'+id+'"]').attr('data-price')
            var tr = $($('noscript#product-clone').html()).clone()
            tr.find('input[name="product_id[]"]').val(id)
            tr.find('input[name="product_price[]"]').val(price)
            tr.find('.product_name').text(name)
            tr.find('.product_price').text(parseFloat(price).toLocaleString())
            tr.find('.product_total').text(parseFloat(price).toLocaleString())
			tr.find('input[name="product_total[]"]').val(price)
            $('#product-list tbody').append(tr)
            calc_product()
            tr.find('.rem-product').click(function(){
                if(confirm("Are you sure to remove "+name+" from product list?") === true){
                    tr.remove()
                    calc_product()
                }
            })
            tr.find('[name="product_qty[]"]').on('input change', function(){
                /*var qty = $(this).val()
                qty = qty > 0 ? qty : 0
                var total = parseFloat(qty) * parseFloat(price)
                tr.find('.product_total').text(parseFloat(total).toLocaleString())
                calc_product()*/
				
				var qty = $(this).val()
                qty = qty > 0 ? qty : 0
                
				var product_discount = tr.find('input[name="product_discount[]"]').val()
				product_discount = product_discount > 0 ? product_discount : 0
                var product_dis_type = tr.find('select[name="product_dis_type[]"]').val()
				var total = parseFloat(qty) * parseFloat(price)
				
				if(product_dis_type == 'Percentage'){
					var dis_value = parseFloat(total) * parseFloat(product_discount) / 100;
				}else if(product_dis_type == 'Fixed Amount'){
					var dis_value = parseFloat(product_discount);
				}else{
					var dis_value = 0;
				}
				
				var after_dis_total = parseFloat(total) - parseFloat(dis_value)
                tr.find('input[name="product_discount_amt[]"]').val(dis_value)
                tr.find('input[name="product_total[]"]').val(after_dis_total)
                tr.find('.product_total').text(parseFloat(after_dis_total).toLocaleString())
                calc_product()
            })
			
			tr.find('[name="product_dis_type[]"]').on('select change', function(){
				var qty = tr.find('input[name="product_qty[]"]').val()
				var product_discount = tr.find('input[name="product_discount[]"]').val()
                var product_dis_type = tr.find('select[name="product_dis_type[]"]').val()
				var total = parseFloat(qty) * parseFloat(price)
				if(product_dis_type == 'Percentage'){
					var dis_value = parseFloat(total) * parseFloat(product_discount) / 100;
				}else if(product_dis_type == 'Fixed Amount'){
					var dis_value = parseFloat(product_discount);
				}else{
					var dis_value = 0;
				}
				var after_dis_total = parseFloat(total) - parseFloat(dis_value)
                tr.find('input[name="product_discount_amt[]"]').val(dis_value)
                tr.find('input[name="product_total[]"]').val(after_dis_total)
                tr.find('.product_total').text(parseFloat(after_dis_total).toLocaleString())
                calc_product()
            })
			
			tr.find('[name="product_discount[]"]').on('input change', function(){
				var qty = tr.find('input[name="product_qty[]"]').val()
				var product_discount = tr.find('input[name="product_discount[]"]').val()
                var product_dis_type = tr.find('select[name="product_dis_type[]"]').val()
				var total = parseFloat(qty) * parseFloat(price)
				if(product_dis_type == 'Percentage'){
					var dis_value = parseFloat(total) * parseFloat(product_discount) / 100;
				}else if(product_dis_type == 'Fixed Amount'){
					var dis_value = parseFloat(product_discount);
				}else{
					var dis_value = 0;
				}
				var after_dis_total = parseFloat(total) - parseFloat(dis_value)
                tr.find('input[name="product_discount_amt[]"]').val(dis_value)
				tr.find('input[name="product_total[]"]').val(after_dis_total)
                tr.find('.product_total').text(parseFloat(after_dis_total).toLocaleString())
                calc_product()
            })
			
            $('#product_sel').val('').trigger("change")
        })
        $('#product-list, #service-list').find('td, th').addClass('px-2 py-1 align-middle')
        $('#quotation-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_quotation",
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
						location.href = "./?page=quotations/view_details&id="+resp.tid
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body,.modal").scrollTop(0);
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
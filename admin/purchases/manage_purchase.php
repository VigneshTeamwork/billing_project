<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `purchase_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }else{
        echo '<script> alert("Unknown Purchase\'s ID."); location.replace("./?page=purchases"); </script>';
    }
}
// One product line; used for saved lines and as the template for new ones.
function purchase_product_row($r = array()){
    $r = array_merge(array('product_id' => '', 'product' => '', 'qty' => 1, 'price' => 0, 'product_dis_type' => '', 'product_discount' => 0, 'product_discount_amt' => 0, 'product_total' => 0), $r);
    ob_start(); ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-outline-danger btn-sm rounded-0 rem-product" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="<?= $r['product_id'] ?>">
            <input type="hidden" name="product_total[]" value="<?= $r['product_total'] ?>">
            <input type="hidden" name="product_discount_amt[]" value="<?= $r['product_discount_amt'] ?>">
            <span class="product_name"><?= $r['product'] ?></span>
        </td>
        <td><input type="number" min="1" class="form-control form-control-sm rounded-0 text-right" name="product_qty[]" value="<?= $r['qty'] ?>"></td>
        <td><input type="number" min="0" step="any" class="form-control form-control-sm rounded-0 text-right" name="product_price[]" value="<?= $r['price'] ?>"></td>
        <td>
            <select name="product_dis_type[]" class="form-control form-control-sm rounded">
                <option value="">Select Discount Type</option>
                <option value="Percentage" <?= $r['product_dis_type'] == 'Percentage' ? 'selected' : '' ?>>Percentage</option>
                <option value="Fixed Amount" <?= $r['product_dis_type'] == 'Fixed Amount' ? 'selected' : '' ?>>Fixed Amount</option>
            </select>
        </td>
        <td><input type="number" min="0" step="any" class="form-control form-control-sm rounded text-right" name="product_discount[]" value="<?= $r['product_discount'] !== '' ? $r['product_discount'] : 0 ?>"></td>
        <td class="text-right product_total"><?= format_num($r['product_total'], 2) ?></td>
    </tr>
    <?php return ob_get_clean();
}
?>
<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-outline rounded-0 shadow blur">
            <div class="card-header">
                <h5 class="card-title"><?= isset($id) ? "Update ". $code . " Purchase" : "New Purchase" ?></h5>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="purchase-form">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                        <input type="hidden" name="sub_amount" value="<?= isset($sub_amount) ? $sub_amount : 0 ?>">
						<input type="hidden" name="dis_amt" value="<?= isset($dis_amt) ? $dis_amt : 0 ?>">
						<input type="hidden" name="cgst_amt" value="<?= isset($cgst_amt) ? $cgst_amt : 0 ?>">
						<input type="hidden" name="sgst_amt" value="<?= isset($sgst_amt) ? $sgst_amt : 0 ?>">
                        <input type="hidden" name="amount" value="<?= isset($amount) ? $amount : 0 ?>">
                        <input type="hidden" name="amount_with_gst" value="<?= isset($amount_with_gst) ? $amount_with_gst : 0 ?>">
                        <div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="invoice_type" class="control-label">Bill Type</label>
									<select id="invoice_type" name="invoice_type" class="form-control form-control-sm rounded">
										<option value="GST" <?= isset($invoice_type) && $invoice_type == 'GST' ? 'selected' : '' ?>>GST</option>
										<option value="Non-GST" <?= !isset($invoice_type) || $invoice_type == 'Non-GST' ? 'selected' : '' ?>>Non-GST</option>
									</select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="supplier_id" class="control-label">Select Supplier</label>
									<select id="supplier_id" name="supplier_id" class="form-control form-control-sm rounded" required>
										<option value="" disabled <?= !isset($supplier_id) ? 'selected' : '' ?>></option>
										<?php
										$cur_sup = isset($supplier_id) ? (int)$supplier_id : 0;
										$sup_qry = $conn->query("SELECT * FROM `supplier_list` where (delete_flag = 0 and `status` = 1) or id = '{$cur_sup}' order by `sup_name`");
										while($row = $sup_qry->fetch_assoc()): ?>
										<option value="<?= $row['id'] ?>" <?= $row['id'] == $cur_sup ? 'selected' : '' ?>><?= $row['sup_name'] ?></option>
										<?php endwhile; ?>
									</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="supplier_bill_no" class="control-label">Supplier Bill No</label>
                                    <input type="text" name="supplier_bill_no" id="supplier_bill_no" class="form-control form-control-sm rounded-0" value="<?= isset($supplier_bill_no) ? htmlspecialchars($supplier_bill_no) : '' ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="bill_date" class="control-label">Bill Date</label>
                                    <input type="date" name="bill_date" id="bill_date" class="form-control form-control-sm rounded-0" value="<?= isset($bill_date) ? $bill_date : '' ?>">
                                </div>
                            </div>
                        </div>
                        <hr>
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
                                            <option value="<?= $row['id'] ?>" data-price="<?= $row['buy_price'] ?>"><?= $row['name'] ?> - <?= $row['product_code'] ?></option>
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
                                    <col width="15%">
                                    <col width="20%">
                                    <col width="10%">
                                    <col width="15%">
                                </colgroup>
                                <thead>
                                    <tr class="bg-gradient-navy">
                                        <th class="text-center"></th>
                                        <th class="text-center">Item Name</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Buy Price</th>
										<th class="text-center">Dis.Type</th>
										<th class="text-center">Discount</th>
										<th class="text-center">Line Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $product_total = 0;
                                    if(isset($id)):
                                    $pp_qry = $conn->query("SELECT pp.*, p.name as `product` FROM `purchase_products` pp inner join `product_list` p on pp.product_id = p.id where pp.`purchase_id` = '{$id}' ");
                                    while($row = $pp_qry->fetch_assoc()):
                                        $product_total += $row['product_total'];
                                        echo purchase_product_row($row);
                                    endwhile;
                                    endif;
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gradient-secondary">
                                        <th colspan="6" class="text-right">Total</th>
                                        <th class="text-right" id="product_total"><?= format_num($product_total, 2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </fieldset>
                        <div class="clear-fix mb-3"></div>
						<table class="table table-striped table-bordered">
							<tr>
								<td style="width:75%;"><h5 class="text-navy text-right">Sub Total: </h5></td>
								<td style="width:25%;"><h5 class="text-navy text-right"><b id="sub_amount"><?= isset($sub_amount) ? format_num($sub_amount, 2) : "0.00" ?></b></h5></td>
							</tr>
							<tr>
								<td><h5 class="text-navy text-right">Discount Amount: </h5></td>
								<td><h5 class="text-navy text-right"><b id="dis_amt"><?= isset($dis_amt) ? format_num($dis_amt, 2) : "0.00" ?></b></h5></td>
							</tr>
							<tr class="gst_segment">
								<td>
								<h5 class="text-navy text-right">CGST (%):</h5>
								<input type="number" step="any" name="cgst" id="cgst" class="form-control form-control-sm rounded-0 text-right" value="<?= isset($cgst) ? $cgst : 0 ?>" style="width:10%;float:right;">
								</td>
								<td><h5 class="text-navy text-right"><b id="cgst_amt"><?= isset($cgst_amt) ? format_num($cgst_amt, 2) : "0.00" ?></b></h5></td>
							</tr>
							<tr class="gst_segment">
								<td>
								<h5 class="text-navy text-right">SGST (%): </h5>
								<input type="number" step="any" name="sgst" id="sgst" class="form-control form-control-sm rounded-0 text-right" value="<?= isset($sgst) ? $sgst : 0 ?>" style="width:10%;float:right;">
								</td>
								<td><h5 class="text-navy text-right"><b id="sgst_amt"><?= isset($sgst_amt) ? format_num($sgst_amt, 2) : "0.00" ?></b></h5></td>
							</tr>
							<tr>
								<td><h5 class="text-navy text-right">Grand Total: </h5></td>
								<td><h5 class="text-navy text-right"><b id="grand_total"><?= isset($amount_with_gst) ? format_num($amount_with_gst, 2) : "0.00" ?></b></h5></td>
							</tr>
						</table>
                    </form>
                </div>
            </div>
            <div class="card-footer py-2 text-right">
                <button class="btn btn-primary rounded-0" form="purchase-form">Save Purchase</button>
                <?php if(!isset($id)): ?>
                <a class="btn btn-default border rounded-0" href="./?page=purchases">Cancel</a>
                <?php else: ?>
                <a class="btn btn-default border rounded-0" href="./?page=purchases/view_details&id=<?= $id ?>">Cancel</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<noscript id="product-clone"><?= purchase_product_row() ?></noscript>
<script>
	function num(v){ v = parseFloat(v); return isNaN(v) ? 0 : v; }
	function money(v){ return num(v).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}); }

	// Recalculate one product line from its qty, price and discount.
	function calc_row(tr){
		var line = num(tr.find('[name="product_qty[]"]').val()) * num(tr.find('[name="product_price[]"]').val());
		var discount = num(tr.find('[name="product_discount[]"]').val());
		var dis_type = tr.find('[name="product_dis_type[]"]').val();
		var dis_value = dis_type == 'Percentage' ? line * discount / 100 : (dis_type == 'Fixed Amount' ? discount : 0);
		var total = line - dis_value;
		tr.find('[name="product_discount_amt[]"]').val(dis_value);
		tr.find('[name="product_total[]"]').val(total);
		tr.find('.product_total').text(money(total));
	}

	function calc_total_amount(){
		var sub_total = 0, dis_amt = 0, total = 0;
		$('#product-list tbody tr').each(function(){
			sub_total += num($(this).find('[name="product_qty[]"]').val()) * num($(this).find('[name="product_price[]"]').val());
			dis_amt += num($(this).find('[name="product_discount_amt[]"]').val());
			total += num($(this).find('[name="product_total[]"]').val());
		});
		var is_gst = $('#invoice_type').val() == 'GST';
		var cgst_amt = is_gst ? total * num($('#cgst').val()) / 100 : 0;
		var sgst_amt = is_gst ? total * num($('#sgst').val()) / 100 : 0;
		var grand = total + cgst_amt + sgst_amt;

		$('#product_total').text(money(total));
		$('[name="sub_amount"]').val(sub_total);   $('#sub_amount').text(money(sub_total));
		$('[name="dis_amt"]').val(dis_amt);         $('#dis_amt').text(money(dis_amt));
		$('[name="cgst_amt"]').val(cgst_amt);       $('#cgst_amt').text(money(cgst_amt));
		$('[name="sgst_amt"]').val(sgst_amt);       $('#sgst_amt').text(money(sgst_amt));
		$('[name="amount"]').val(total);
		$('[name="amount_with_gst"]').val(grand);   $('#grand_total').text(money(grand));
	}

	function toggle_gst(){
		$('.gst_segment').toggle($('#invoice_type').val() == 'GST');
	}

    $(function(){
		$('select#invoice_type').select2({ width:'100%', containerCssClass:'form-control form-control-sm rounded-0' })
		$('select#supplier_id').select2({ placeholder:"Select Supplier here", width:'100%', containerCssClass:'form-control form-control-sm rounded-0' })
        $('#product_sel').select2({ placeholder:"Select product here", width:'100%', containerCssClass:'form-control form-control-sm rounded-0' })

		toggle_gst();
		$('#invoice_type').on('change', function(){ toggle_gst(); calc_total_amount(); })
		$('#cgst, #sgst').on('input change', calc_total_amount)

		$('#product-list').on('input change', 'input, select', function(){
			calc_row($(this).closest('tr'));
			calc_total_amount();
		})
		$('#product-list').on('click', '.rem-product', function(){
			var tr = $(this).closest('tr')
			if(confirm("Are you sure to remove "+(tr.find('.product_name').text())+" from product list?") === true){
				tr.remove()
				calc_total_amount()
			}
		})

        $('#add_product').click(function(){
            var id = $('#product_sel').val()
            if(id == null) return false;
            if($('#product-list tbody tr input[name="product_id[]"][value="'+id+'"]').length > 0){
                alert("Product already on the list.")
                return false;
            }
            var opt = $('#product_sel option[value="'+id+'"]')
            var tr = $($('noscript#product-clone').html()).clone()
            tr.find('input[name="product_id[]"]').val(id)
            tr.find('input[name="product_price[]"]').val(num(opt.attr('data-price')))
            tr.find('.product_name').text(opt.text())
            $('#product-list tbody').append(tr)
            tr.find('td').addClass('px-2 py-1 align-middle')
            calc_row(tr)
            calc_total_amount()
            $('#product_sel').val('').trigger("change")
        })
        $('#product-list').find('td, th').addClass('px-2 py-1 align-middle')

        $('#purchase-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			$('.err-msg').remove();
			if($('#product-list tbody tr').length == 0){
				alert("Please add at least one product.");
				return false;
			}
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_purchase",
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
						location.href = "./?page=purchases/view_details&id="+resp.pid
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

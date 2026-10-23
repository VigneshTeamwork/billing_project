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
        if(isset($user_id) && is_numeric($user_id)){
            $user = $conn->query("SELECT concat(firstname,' ', lastname) as `name` FROM `users` where id = '{$user_id}' ");
            if($user->num_rows > 0){
                $user_name = $user->fetch_array()['name'];
            }
        }
        $sup = $conn->query("SELECT * FROM `supplier_list` where id = '{$supplier_id}' ");
        if($sup->num_rows > 0){
            $sup_row = $sup->fetch_assoc();
            $supplier_name = $sup_row['sup_name'];
            $contact = $sup_row['sup_mob_no'];
            $email = $sup_row['sup_email_id'];
            $address = $sup_row['sup_address'];
        }
    }else{
        echo '<script> alert("Unknown Purchase\'s ID."); location.replace("./?page=purchases"); </script>';
    }
}else{
    echo '<script> alert("Purchase\'s ID is required to access the page."); location.replace("./?page=purchases"); </script>';
}
?>
<div class="content py-3">
    <div class="card card-outline card-navy rounded-0 shadow">
        <div class="card-header">
            <h4 class="card-title">Purchase Details: <b><?= isset($code) ? $code : "" ?></b></h4>
            <div class="card-tools">
                <a href="./?page=purchases" class="btn btn-default border btn-sm"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid" id="printout">
                <div class="row mb-0">
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Purchase Code</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($code) ? $code : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Purchase Date</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= !empty($purchase_date) ? date("M d, Y", strtotime($purchase_date)) : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Supplier Bill No</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($supplier_bill_no) ? $supplier_bill_no : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Bill Date</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= !empty($bill_date) ? date("M d, Y", strtotime($bill_date)) : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Supplier Name</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($supplier_name) ? $supplier_name : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Contact #</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($contact) ? $contact : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Email</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($email) ? $email : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Address</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($address) ? $address : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Status</b></div>
                    <div class="col-9 py-1 px-2 border mb-0">
                        <?php
                        switch(isset($status) ? $status : ''){
                            case 0:
                                echo '<span class="badge badge-default border px-3 rounded-pill">Pending</span>';
                                break;
                            case 1:
                                echo '<span class="badge badge-primary px-3 rounded-pill">Received</span>';
                                break;
                            case 2:
                                echo '<span class="badge badge-teal bg-gradient-teal px-3 rounded-pill">Paid</span>';
                                break;
                            case 3:
                                echo '<span class="badge badge-danger px-3 rounded-pill">Cancelled</span>';
                                break;
                        }
                        ?>
                    </div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Prepared By</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($user_name) ? $user_name : '' ?></div>
                </div>
                <div class="clear-fix mb-2"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <fieldset>
                        <legend>Products</legend>
                        <div class="clear-fix mb-2"></div>
                        <table class="table table-striped table-bordered" id="product-list">
                            <thead>
                                <tr class="bg-gradient-navy">
                                    <th class="text-center">Item Name</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Buy Price</th>
									<th class="text-center">Dis.Type</th>
									<th class="text-center">Discount</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $product_total = 0;
                                $pp_qry = $conn->query("SELECT pp.*, p.name as `product` FROM `purchase_products` pp inner join `product_list` p on pp.product_id = p.id where pp.`purchase_id` = '{$id}' ");
                                while($row = $pp_qry->fetch_assoc()):
                                    $product_total += $row['product_total'];
                            ?>
                                <tr>
                                    <td><?= $row['product'] ?></td>
                                    <td class="text-right"><?= $row['qty'] ?></td>
                                    <td class="text-right"><?= format_num($row['price'], 2) ?></td>
									<td class="text-right"><?= $row['product_dis_type'] ?></td>
                                    <td class="text-right"><?= format_num((float)$row['product_discount']) ?></td>
                                    <td class="text-right"><?= format_num($row['product_total'], 2) ?></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-secondary">
                                    <th colspan="5" class="text-right">Total</th>
                                    <th class="text-right"><?= format_num($product_total, 2) ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </fieldset>
                </div>
                <hr>
                <div class="clear-fix mb-3"></div>
                <h5 class="text-navy text-right">Sub Total: <b><?= isset($sub_amount) ? format_num($sub_amount, 2) : "0.00" ?></b></h5>
                <h5 class="text-navy text-right">Discount Amount: <b><?= isset($dis_amt) ? format_num($dis_amt, 2) : "0.00" ?></b></h5>
				<?php if($invoice_type == 'GST'): ?>
					<h5 class="text-navy text-right">CGST: <b><?= isset($cgst_amt) ? format_num($cgst_amt, 2) : "0.00" ?></b></h5>
					<h5 class="text-navy text-right">SGST: <b><?= isset($sgst_amt) ? format_num($sgst_amt, 2) : "0.00" ?></b></h5>
				<?php endif; ?>
                <h5 class="text-navy text-right">Grand Total: <b><?= isset($amount_with_gst) ? format_num($amount_with_gst, 2) : "0.00" ?></b></h5>
            </div>
            <hr>
            <div class="row justify-content-center">
                <button class="btn btn-primary bg-gradient-navy border col-lg-3 col-md-4 col-sm-12 col-xs-12 rounded-pill" id="update_status" type="button">Update Status</button>
                <a class="btn btn-primary bg-gradient-primary border col-lg-3 col-md-4 col-sm-12 col-xs-12 rounded-pill" href="./?page=purchases/manage_purchase&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Edit</a>
				<a href="./?page=purchases/print_details&id=<?= isset($id) ? $id : '' ?>" class="btn btn-light bg-gradient-light border col-lg-3 col-md-4 col-sm-12 col-xs-12 rounded-pill" target="_blank"><i class="fa fa-print"></i> Print</a>
                <?php if($_settings->userdata('type') == 1) { ?>
					<button class="btn btn-danger bg-gradient-danger border col-lg-3 col-md-4 col-sm-12 col-xs-12 rounded-pill" id="delete_purchase" type="button"><i class="fa fa-trash"></i> Delete Purchase</button>
				<?php }?>
				<button class="btn btn-primary bg-gradient-navy border col-lg-3 col-md-4 col-sm-12 col-xs-12 rounded-pill" id="share" onclick="sendWhatsapp('<?= isset($contact) ? $contact : '' ?>','<?php echo base_url ?>admin?page=purchases/print_details&id=<?= isset($id) ? $id : '' ?>')" type="button">Share</button>
            </div>
        </div>
    </div>
</div>
<script>
	function sendWhatsapp(supplierWhatsapp,temp) {
		var message = encodeURIComponent(temp);
		window.open("https://wa.me/" + supplierWhatsapp + "?text=" + message, "_blank");
	}
	$(function(){
		$('#update_status').click(function(){
			uni_modal("Update Purchase Status", "purchases/update_status.php?id=<?= isset($id) ? $id : '' ?>")
		})
		$('#delete_purchase').click(function(){
			_conf("Are you sure to delete this purchase permanently?","delete_purchase",[])
		})
	})
	function delete_purchase(){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_purchase",
			method:"POST",
			data:{id: '<?= isset($id) ? $id : "" ?>'},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace('./?page=purchases');
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>

<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `transaction_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
        if(isset($tech_id) && is_numeric($tech_id)){
            $tech = $conn->query("SELECT concat(firstname,' ', lastname) as `name` FROM `users` where id = '{$tech_id}' ");
            if($tech->num_rows > 0){
                $tech_name = $tech->fetch_array()['name'];
            }
        }
        if(isset($user_id) && is_numeric($user_id)){
            $user = $conn->query("SELECT concat(firstname,' ', lastname) as `name` FROM `users` where id = '{$user_id}' ");
            if($user->num_rows > 0){
                $user_name = $user->fetch_array()['name'];
            }
        }
    }else{
        echo '<script> alert("Unknown Transaction\'s ID."); location.replace("./?page=transactions"); </script>';
    }
}else{
    echo '<script> alert("Transaction\'s ID is required to access the page."); location.replace("./?page=transactions"); </script>';
}
?>
<div class="content py-3">
    <div class="card card-outline card-navy rounded-0 shadow">
        <div class="card-header">
            <h4 class="card-title">Transaction Details: <b><?= isset($code) ? $code : "" ?></b></h4>
            <div class="card-tools">
                <a href="./?page=transactions" class="btn btn-default border btn-sm"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid" id="printout">
                <div class="row mb-0">
					<?php
					$customer_qry = $conn->query("SELECT * FROM `customer_list` where delete_flag = 0 and `status` = 1 order by `cus_name`");
					while($cus_row = $customer_qry->fetch_assoc()):
						if($cus_row['id'] == $customer_id){
							$client_name = $cus_row['cus_name'];
							$contact = $cus_row['cus_mob_no'];
							$email = $cus_row['cus_email_id'];
							$address = $cus_row['cus_address'];
						}
					endwhile;
					?>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Transaction Code</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($code) ? $code : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Invoice Date</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= !empty($invoice_date) ? date("M d, Y", strtotime($invoice_date)) : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Client Name</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($client_name) ? $client_name : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Contact #</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($contact) ? $contact : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Email</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($email) ? $email : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Address</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($address) ? $address : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Status</b></div>
                    <div class="col-9 py-1 px-2 border mb-0">
                        <?php 
                        $status = isset($status) ? $status : '';
                        switch($status){
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
                                echo '<span class="badge badge-teal bg-gradient-teal px-3 rounded-pill">Paid</span>';
                                break;
                            case 4:
                                echo '<span class="badge badge-danger px-3 rounded-pill">Cancelled</span>';
                                break;
                        }
                        ?>
                    </div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Assigned Technician</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($tech_name) ? $tech_name : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Prepared By</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($user_name) ? $user_name : '' ?></div>
                </div>
                <div class="clear-fix mb-2"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <fieldset>
                        <legend>Services</legend>
                        <div class="clear-fix mb-2"></div>
                        <table class="table table-striped table-bordered" id="service-list">
                            <colgroup>
                                <col width="70%">
                                <col width="30%">
                            </colgroup>
                            <thead>
                                <tr class="bg-gradient-navy">
                                    <th class="text-center">Service</th>
									<th class="text-center">Qty</th>
                                    <th class="text-center">Price</th>
									<th class="text-center">Dis.Type</th>
									<th class="text-center">Discount</th>
									<th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $service_amount = 0;
                                $ts_qry = $conn->query("SELECT ts.*, s.name as `service` FROM `transaction_services` ts inner join `service_list` s on ts.service_id = s.id where ts.`transaction_id` = '{$id}' ");
                                while($row = $ts_qry->fetch_assoc()):
                                    $service_amount += $row['service_total'];
                                ?>
                                <tr>
                                    <td><?= $row['service'] ?></td>
									<td class="text-right"><?= $row['qty'] ?></td>
                                    <td class="text-right service_price"><?= format_num($row['price']) ?></td>
                                    <td class="text-right service_dis_type"><?= $row['service_dis_type'] ?></td>
                                    <td class="text-right service"><?= format_num($row['service_discount']) ?></td>
                                    <td class="text-right service_total"><?= format_num($row['service_total']) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-secondary">
                                    <th colspan="5" class="text-right">Total</th>
                                    <th class="text-right" id="service_total"><?= isset($service_amount) ? format_num($service_amount): 0 ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </fieldset>
                </div>
                <hr>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <fieldset>
                        <legend>Products</legend>
                        <div class="clear-fix mb-2"></div>
                        <table class="table table-striped table-bordered" id="product-list">
                            <colgroup>
                                <col width="45%">
                                <col width="15%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                                <tr class="bg-gradient-navy">
                                    <th class="text-center">Item Name</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Price</th>
									<th class="text-center">Dis.Type</th>
									<th class="text-center">Discount</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $product_total = 0;
                                $tp_qry = $conn->query("SELECT tp.*, p.name as `product` FROM `transaction_products` tp inner join `product_list` p on tp.product_id = p.id where tp.`transaction_id` = '{$id}' ");
                                while($row = $tp_qry->fetch_assoc()):
									//$product_total += ($row['price'] * $row['qty']);
                                    $product_total += $row['product_total'];
                            ?>
                                <tr>
                                    <td><?= $row['product'] ?></td>
                                    <td class="text-right"><?= $row['qty'] ?></td>
                                    <td class="text-right product_price"><?= $row['price'] ?></td>
									<td class="text-right product_dis_type"><?= $row['product_dis_type'] ?></td>
                                    <td class="text-right product"><?= format_num($row['product_discount']) ?></td>
                                    <td class="text-right product_total"><?= format_num($row['product_total']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-secondary">
                                    <th colspan="5" class="text-right">Total</th>
                                    <th class="text-right" id="product_total"><?= isset($product_total) ? format_num($product_total): 0 ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </fieldset>
                </div>
                <hr>
                <div class="clear-fix mb-3"></div>
                <h5 class="text-navy text-right">Sub Total: <b id="sub_amount"><?= isset($sub_amount) ? format_num($sub_amount) : "0.00" ?></b></h5>
                <h5 class="text-navy text-right">Discount Amount: <b id="dis_amt"><?= isset($dis_amt) ? format_num($dis_amt) : "0.00" ?></b></h5>
				<?php
				if($invoice_type == 'GST'){
					?>
					<h5 class="text-navy text-right">CGST: <b id="cgst_amt"><?= isset($cgst_amt) ? format_num($cgst_amt) : "0.00" ?></b></h5>
					<h5 class="text-navy text-right">SGST: <b id="sgst_amt"><?= isset($sgst_amt) ? format_num($sgst_amt) : "0.00" ?></b></h5>
					<?php
				}else{
					?>
					
					<?php
				}
				?>
                <h5 class="text-navy text-right">Grand Total: <b id="amount_with_gst"><?= isset($amount_with_gst) ? format_num($amount_with_gst) : "0.00" ?></b></h5>
            </div>
            <hr>
            <div class="d-flex flex-wrap flex-lg-nowrap justify-content-center">
                <button class="btn btn-primary bg-gradient-navy border flex-fill text-nowrap mx-1 mb-2 rounded-pill" id="update_status" type="button">Update Status</button>
                <a class="btn btn-primary bg-gradient-primary border flex-fill text-nowrap mx-1 mb-2 rounded-pill" href="./?page=transactions/manage_transaction&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Edit</a>
                <!--<button class="btn btn-light bg-gradient-light border flex-fill text-nowrap mx-1 mb-2 rounded-pill" id="print"><i class="fa fa-print"></i> Print</button>-->
				<a href="./?page=transactions/print_details&id=<?= isset($id) ? $id : '' ?>" class="btn btn-light bg-gradient-light border flex-fill text-nowrap mx-1 mb-2 rounded-pill" target="_blank"><i class="fa fa-print"></i> Print</a>
                <?php if($_settings->userdata('type') == 1) { ?>
					<button class="btn btn-danger bg-gradient-danger border flex-fill text-nowrap mx-1 mb-2 rounded-pill" id="delete_transaction" type="button"><i class="fa fa-trash"></i> Delete Transaction</button>
				<?php }?>
				<button class="btn btn-primary bg-gradient-navy border flex-fill text-nowrap mx-1 mb-2 rounded-pill" id="share" onclick="sendWhatsapp(<?php echo $contact; ?>,'<?php echo base_url ?>admin?page=transactions/print_details&id=<?php echo $_GET['id'] ?>')" type="button">Share</button>
            </div>
        </div>
    </div>
</div>
<noscript id="print-header">
    <div class="d-flex w-100">
        <div class="col-2 text-center">
            <img style="height:.8in;width:.8in!important;object-fit:cover;object-position:center center" src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="w-100 img-thumbnail rounded-circle">
        </div>
        <div class="col-8 text-center">
            <h4 class="tex-center"><?= $_settings->info('name') ?></h4>
            <h3 class="text-center"><b>Transaction Details</b></h3>
        </div>
    </div>
    <hr>
</noscript>
<script>
	function sendWhatsapp(customerWhatsapp,temp) {
		var message = encodeURIComponent(temp);
		var whatsappLink = "https://wa.me/" + customerWhatsapp + "?text=" + message;

		window.open(whatsappLink, "_blank");
	}
</script>
<script>
$(function(){
    $('#print').click(function(){
        var head = $('head').clone()
        var p = $('#printout').clone()
        var phead = $($('noscript#print-header').html()).clone()
        var el = $('<div>')
        el.append(head)
        el.find('title').text("Transaction Details-Print View")
        el.append(phead)
        el.append(p)
        el.find('.bg-gradient-navy').css({'background':'#001f3f linear-gradient(180deg, #26415c, #001f3f) repeat-x !important','color':'#fff'})
        el.find('.bg-gradient-secondary').css({'background':'#6c757d linear-gradient(180deg, #828a91, #6c757d) repeat-x !important','color':'#fff'})
        el.find('tr.bg-gradient-navy').attr('style',"color:#000")
        el.find('tr.bg-gradient-secondary').attr('style',"color:#000")
        start_loader();
        var nw = window.open("", "_blank", "width=1000, height=900")
                 nw.document.write(el.html())
                 nw.document.close()
                 setTimeout(()=>{
                     nw.print()
                     setTimeout(()=>{
                        nw.close()
                        end_loader()
                     },300)
                 },500)
    })
    $('#update_status').click(function(){
        uni_modal("Update transaction Status", "transactions/update_status.php?id=<?= isset($id) ? $id : '' ?>")
    })
    $('#delete_transaction').click(function(){
        _conf("Are you sure to delete this transaction permanently?","delete_transaction",[])
    })
})
function delete_transaction($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_transaction",
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
					location.replace('./?page=transactions');
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
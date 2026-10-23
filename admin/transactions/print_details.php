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
		if(isset($customer_id) && is_numeric($customer_id)){
			$customer_qry = $conn->query("SELECT * FROM `customer_list` where delete_flag = 0 and `status` = 1 order by `cus_name`");
			while($cus_row = $customer_qry->fetch_assoc()):
				if($cus_row['id'] == $customer_id){
					$client_name = $cus_row['cus_name'];
					$client_contact = $cus_row['cus_mob_no'];
					$client_email = $cus_row['cus_email_id'];
					$client_address = $cus_row['cus_address'];
					$client_gst_no = $cus_row['cus_gst_no'];
				}
			endwhile;
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
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice No <?php echo $code;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 

  <style>
	.table > tbody > tr > .no-line {
		border-top: none;
	}

	.table > thead > tr > .no-line {
		border-bottom: none;
	}

	.table > tbody > tr > .thick-line {
		border-top: 2px solid;
	}
	p{
		margin-bottom:0px !important;
	}
	.prod-img{
		width: 5em;
		max-height: 8em;
		object-fit:scale-down;
		object-position:center center;
	}
	
	.item_table.table td, .item_table.table th {
		padding: .75rem;
		vertical-align: top;
		border-top: 1px solid #dee2e6;
		border: 2px solid #dee2e6;
	}
  </style>
  </head>
<body>

<div class="container">
	<!--startprint-->
    <div class="row">
		<div class="col-md-12">
			<table class="table">
				<tr style="background-color:#ddd;">
					<th>
						<h3><?php echo $_settings->info('short_name'); ?></h3>
						<?php echo $_settings->info('address'); ?> <br>
						Contact No : <?php echo $_settings->info('mobile_no'); ?><br>
						Email ID : <?php echo $_settings->info('email_id'); ?><br>
						GST No : <?php echo $_settings->info('gst_no'); ?></p>
					</th>
					<th>
						<img alt="No Image Uploaded" style='height:150px;width:100%;' src="<?php echo validate_image($_settings->info('logo')) ?>"/>
					</th>
				</tr>
				<?php
				if($invoice_type == 'GST'){
					?>
					<tr>
						<th colspan="2"><h4 style="text-align:center;">GST INVOICE</h4></th>
					</tr>
					<?php
				}
				?>
				<tr>
					<th>
						<p>To : <br>
						<span style="font-size: 1.75rem !important;font-weight: 400; !important"><?php echo $client_name; ?></span><br>
						<!--<h3><small><?php echo $client_name; ?></small></h3>-->
						<?php echo $client_address; ?><br>
						Contact No : <?php echo $client_contact; ?><br>
						Email ID : <?php echo $client_email; ?><br>
						GST No : <?php echo $client_gst_no; ?></p>
					</th>
					<th>
						<p>Date : <?php echo date("d/m/Y", strtotime(!empty($invoice_date) ? $invoice_date : $date_created)); ?><br>
						Invoice No : <?php echo $code; ?><br>
						Assigned Technician : <?= isset($tech_name) ? $tech_name : '' ?><br>
						Prepared By : <?= isset($user_name) ? $user_name : '' ?></p>
					</th>
				</tr>
			</table>
			<!--<table class="table">
				<tr>
					<td>
						<h3><small>Subject: Invoice for requirement</small></h3>
						<p>Dear <?php echo $client_name; ?>,<br>
						Ref : Your enquiry for requirement dated : <?php echo date("d/m/Y", strtotime(!empty($invoice_date) ? $invoice_date : $date_created)); ?></p>
					</td>
				</tr>
			</table>-->
			
			<table class="table item_table" style="border: 1px solid #dee2e6;">
				<tr style="background-color:#ddd;">
					<th style="border: 1px solid #dee2e6;">S.No</th>
					<th style="border: 1px solid #dee2e6;">Product Description</th>
					<th style="border: 1px solid #dee2e6;">HSN Code</th>
					<!--<th style="border: 1px solid #dee2e6;">Product Image</th>-->
					<th style="border: 1px solid #dee2e6;">Qty</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Price</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Discount Amt</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Total</th>
				</tr>
				
				<?php 
				$line_item_cnt = 1;
				$service_amount = 0;
				$ts_qry = $conn->query("SELECT ts.*, s.name as `service`,s.description as `service_desc`,s.image_path as `service_img` FROM `transaction_services` ts inner join `service_list` s on ts.service_id = s.id where ts.`transaction_id` = '{$id}' ");
				while($row = $ts_qry->fetch_assoc()):
					$service_amount += $row['service_total'];
				?>
				<tr>
					<td style="border: 1px solid #dee2e6;"><?= $line_item_cnt ?></td>
					<td style="border: 1px solid #dee2e6;"><?= $row['service'] ?> <br> <?= $row['service_desc'] ?></td>
					<td style="border: 1px solid #dee2e6;">-</td>
					<!--<td style="border: 1px solid #dee2e6;"><img class="img-thumbnai" src="<?= validate_image($row['service_img']) ?>" alt="" style="width: 5em;max-height: 8em;object-fit:scale-down;object-position:center center;"></td>-->
					<td style="border: 1px solid #dee2e6;" class="text-left"><?= $row['qty'] ?></td>
					<td style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($row['price']) ?></td>
					<td style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($row['service_discount_amt']) ?></td>
					<td style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($row['service_total']) ?></td>
				</tr>
				<?php $line_item_cnt++; ?>
				<?php endwhile; ?>
				<?php 
				$product_total = 0;
				$tp_qry = $conn->query("SELECT tp.*, p.name as `product`, p.description as `product_desc`,p.hsn_code as `pro_hsncode`,p.image_path as `product_img` FROM `transaction_products` tp inner join `product_list` p on tp.product_id = p.id where tp.`transaction_id` = '{$id}' ");
				while($row = $tp_qry->fetch_assoc()):
					//$product_total += ($row['price'] * $row['qty']);
					$product_total += $row['product_total'];
				?>
				<tr>
					<td style="border: 1px solid #dee2e6;"><?= $line_item_cnt ?></td>
					<td style="border: 1px solid #dee2e6;"><?= $row['product'] ?> <br> <?= $row['product_desc'] ?></td>
					<td style="border: 1px solid #dee2e6;"><?= $row['pro_hsncode'] ?></td>
					<!--<td style="border: 1px solid #dee2e6;"><img class="img-thumbnai" src="<?= validate_image($row['product_img']) ?>" alt=""style="width: 5em;max-height: 8em;object-fit:scale-down;object-position:center center;"></td>-->
					<td style="border: 1px solid #dee2e6;" class="text-left"><?= $row['qty'] ?></td>
					<td style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($row['price']) ?></td>
					<td style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($row['product_discount_amt']) ?></td>
					<td style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($row['product_total']) ?></td>
				</tr>
				<?php $line_item_cnt++; ?>
				<?php endwhile; ?>
				<tr>
					<th style="border: 1px solid #dee2e6;" class="text-right" colspan="6">Sub Total</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($sub_amount) ?></th>
				</tr>
				<tr>
					<th style="border: 1px solid #dee2e6;" class="text-right" colspan="6">Discount</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($dis_amt) ?></th>
				</tr>
				<?php
				if($invoice_type == 'GST'){
					?>
					<tr>
						<th style="border: 1px solid #dee2e6;" class="text-right" colspan="6">CGST(<?= $cgst ?>)</th>
						<th style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($cgst_amt) ?></th>
					</tr>
					<tr>
						<th style="border: 1px solid #dee2e6;" class="text-right" colspan="6">SGST(<?= $sgst ?>)</th>
						<th style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($sgst_amt) ?></th>
					</tr>
					<?php
				}
				?>
				<tr>
					<th style="border: 1px solid #dee2e6;" class="text-right" colspan="6">Grand Total</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($amount_with_gst) ?></th>
				</tr>
			</table>
			<table class="table">
				<tr><td><p><?php echo  is_file(base_app.'footer.html') ? file_get_contents(base_app.'footer.html') : "" ?></p></td></tr>
				<tr>
					<td>
						<p>Sincerely yours,</p>
						<p><?php echo $_settings->info('name'); ?></p>
						<p>Cell : <?php echo $_settings->info('mobile_no'); ?></p>
					</td>
				</tr>
			</table>
		</div>
    </div>
    <!--endprint-->
</div>

<script>
/*function myFunction() {
  window.print();
}*/
</script>
<script>
	$(window).on('load', doPrint());
	function doPrint() 
		{
		var bdhtml=window.document.body.innerHTML;
		var sprnstr= "<!--startprint-->";
		var eprnstr= "<!--endprint-->";
		var start= bdhtml.indexOf(sprnstr)+17;
		var end = bdhtml.indexOf(eprnstr);
		var prnhtml=bdhtml.substring(start,end);
		window.document.body.innerHTML=prnhtml;
		window.print();
		//window.location="./?page=transactions/print_details&id=<?= isset($id) ? $id : '' ?>";      
		}
	</script>
</body>
</html>

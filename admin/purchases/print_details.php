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
		$sup = $conn->query("SELECT * FROM `supplier_list` where id = '{$supplier_id}' ");
		if($sup->num_rows > 0){
			$sup_row = $sup->fetch_assoc();
			$supplier_name = $sup_row['sup_name'];
			$supplier_contact = $sup_row['sup_mob_no'];
			$supplier_email = $sup_row['sup_email_id'];
			$supplier_address = $sup_row['sup_address'];
			$supplier_gst_no = $sup_row['sup_gst_no'];
		}
        if(isset($user_id) && is_numeric($user_id)){
            $user = $conn->query("SELECT concat(firstname,' ', lastname) as `name` FROM `users` where id = '{$user_id}' ");
            if($user->num_rows > 0){
                $user_name = $user->fetch_array()['name'];
            }
        }
    }else{
        echo '<script> alert("Unknown Purchase\'s ID."); location.replace("./?page=purchases"); </script>';
    }
}else{
    echo '<script> alert("Purchase\'s ID is required to access the page."); location.replace("./?page=purchases"); </script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Purchase No <?php echo $code;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
	p{
		margin-bottom:0px !important;
	}
	.item_table.table td, .item_table.table th {
		padding: .75rem;
		vertical-align: top;
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
				<tr>
					<th colspan="2"><h4 style="text-align:center;"><?= $invoice_type == 'GST' ? 'GST PURCHASE BILL' : 'PURCHASE BILL' ?></h4></th>
				</tr>
				<tr>
					<th>
						<p>From : <br>
						<span style="font-size: 1.75rem !important;font-weight: 400 !important;"><?= isset($supplier_name) ? $supplier_name : '' ?></span><br>
						<?= isset($supplier_address) ? $supplier_address : '' ?><br>
						Contact No : <?= isset($supplier_contact) ? $supplier_contact : '' ?><br>
						Email ID : <?= isset($supplier_email) ? $supplier_email : '' ?><br>
						GST No : <?= isset($supplier_gst_no) ? $supplier_gst_no : '' ?></p>
					</th>
					<th>
						<p>Date : <?php echo date("d/m/Y", strtotime($date_created)); ?><br>
						Purchase No : <?php echo $code; ?><br>
						Supplier Bill No : <?= isset($supplier_bill_no) ? $supplier_bill_no : '' ?><br>
						Bill Date : <?= !empty($bill_date) ? date("d/m/Y", strtotime($bill_date)) : '' ?><br>
						Prepared By : <?= isset($user_name) ? $user_name : '' ?></p>
					</th>
				</tr>
			</table>
			<table class="table item_table" style="border: 1px solid #dee2e6;">
				<tr style="background-color:#ddd;">
					<th style="border: 1px solid #dee2e6;">S.No</th>
					<th style="border: 1px solid #dee2e6;">Product Description</th>
					<th style="border: 1px solid #dee2e6;">HSN Code</th>
					<th style="border: 1px solid #dee2e6;">Qty</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Price</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Discount Amt</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Total</th>
				</tr>
				<?php
				$line_item_cnt = 1;
				$pp_qry = $conn->query("SELECT pp.*, p.name as `product`, p.description as `product_desc`, p.hsn_code as `pro_hsncode` FROM `purchase_products` pp inner join `product_list` p on pp.product_id = p.id where pp.`purchase_id` = '{$id}' ");
				while($row = $pp_qry->fetch_assoc()):
				?>
				<tr>
					<td style="border: 1px solid #dee2e6;"><?= $line_item_cnt++ ?></td>
					<td style="border: 1px solid #dee2e6;"><?= $row['product'] ?> <br> <?= $row['product_desc'] ?></td>
					<td style="border: 1px solid #dee2e6;"><?= $row['pro_hsncode'] ?></td>
					<td style="border: 1px solid #dee2e6;" class="text-left"><?= $row['qty'] ?></td>
					<td style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($row['price'], 2) ?></td>
					<td style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($row['product_discount_amt'], 2) ?></td>
					<td style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($row['product_total'], 2) ?></td>
				</tr>
				<?php endwhile; ?>
				<tr>
					<th style="border: 1px solid #dee2e6;" class="text-right" colspan="6">Sub Total</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($sub_amount, 2) ?></th>
				</tr>
				<tr>
					<th style="border: 1px solid #dee2e6;" class="text-right" colspan="6">Discount</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($dis_amt, 2) ?></th>
				</tr>
				<?php if($invoice_type == 'GST'): ?>
					<tr>
						<th style="border: 1px solid #dee2e6;" class="text-right" colspan="6">CGST(<?= $cgst ?>)</th>
						<th style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($cgst_amt, 2) ?></th>
					</tr>
					<tr>
						<th style="border: 1px solid #dee2e6;" class="text-right" colspan="6">SGST(<?= $sgst ?>)</th>
						<th style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($sgst_amt, 2) ?></th>
					</tr>
				<?php endif; ?>
				<tr>
					<th style="border: 1px solid #dee2e6;" class="text-right" colspan="6">Grand Total</th>
					<th style="border: 1px solid #dee2e6;" class="text-right">Rs.<?= format_num($amount_with_gst, 2) ?></th>
				</tr>
			</table>
		</div>
    </div>
    <!--endprint-->
</div>
<script>
	$(window).on('load', doPrint());
	function doPrint(){
		var bdhtml=window.document.body.innerHTML;
		var sprnstr= "<!--startprint-->";
		var eprnstr= "<!--endprint-->";
		var start= bdhtml.indexOf(sprnstr)+17;
		var end = bdhtml.indexOf(eprnstr);
		window.document.body.innerHTML=bdhtml.substring(start,end);
		window.print();
	}
</script>
</body>
</html>

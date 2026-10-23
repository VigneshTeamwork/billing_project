<?php
// Stock = Opening Stock + Purchases - Invoices. Cancelled purchases (status 3) and
// cancelled invoices (status 4) are not counted, nor anything dated before the
// product's "Opening Stock As On" date.
$low_limit = 5;

function stock_valid_date($d){
	return (!empty($d) && strtotime($d)) ? date("Y-m-d", strtotime($d)) : '';
}
$from_date = stock_valid_date(isset($_GET['from_date']) ? $_GET['from_date'] : '');
$to_date = stock_valid_date(isset($_GET['to_date']) ? $_GET['to_date'] : '');
if(empty($to_date)) $to_date = date("Y-m-d");
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;
$stock_status = isset($_GET['stock_status']) ? $_GET['stock_status'] : 'All';

$base = "COALESCE(p.opening_stock_date, '1000-01-01')";
$pur_sum = function($range) use ($base){
	return "COALESCE((SELECT SUM(pp.qty) FROM `purchase_products` pp INNER JOIN `purchase_list` pl ON pl.id = pp.purchase_id
		WHERE pp.product_id = p.id AND pl.status <> 3 AND pl.purchase_date >= {$base} AND {$range}), 0)";
};
$sold_sum = function($range) use ($base){
	return "COALESCE((SELECT SUM(tp.qty) FROM `transaction_products` tp INNER JOIN `transaction_list` t ON t.id = tp.transaction_id
		WHERE tp.product_id = p.id AND t.status <> 4 AND t.invoice_date >= {$base} AND {$range}), 0)";
};
$in_range = (!empty($from_date) ? "%s >= '{$from_date}' AND " : "")."%s <= '{$to_date}'";
$sql = "SELECT p.id, p.product_code, p.name, p.hsn_code, p.buy_price, p.opening_stock, "
	.(!empty($from_date) ? $pur_sum("pl.purchase_date < '{$from_date}'") : "0")." AS pur_before, "
	.(!empty($from_date) ? $sold_sum("t.invoice_date < '{$from_date}'") : "0")." AS sold_before, "
	.$pur_sum(sprintf($in_range, 'pl.purchase_date', 'pl.purchase_date'))." AS pur_in, "
	.$sold_sum(sprintf($in_range, 't.invoice_date', 't.invoice_date'))." AS sold_in
	FROM `product_list` p WHERE p.delete_flag = 0 ".($product_id > 0 ? "AND p.id = '{$product_id}' " : "")."ORDER BY p.name ASC";
$qry = $conn->query($sql);

$rows = array();
$totals = array('opening' => 0, 'pur_in' => 0, 'sold_in' => 0, 'closing' => 0, 'value' => 0);
while($row = $qry->fetch_assoc()){
	$row['opening'] = $row['opening_stock'] + $row['pur_before'] - $row['sold_before'];
	$row['closing'] = $row['opening'] + $row['pur_in'] - $row['sold_in'];
	$row['value'] = $row['closing'] * $row['buy_price'];
	if($row['closing'] <= 0) $row['state'] = 'Out';
	elseif($row['closing'] <= $low_limit) $row['state'] = 'Low';
	else $row['state'] = 'In';
	if($stock_status != 'All' && $row['state'] != $stock_status) continue;
	foreach($totals as $k => $v) $totals[$k] += $row[$k];
	$rows[] = $row;
}
$badges = array(
	'In'  => '<span class="badge badge-success px-3 rounded-pill">In Stock</span>',
	'Low' => '<span class="badge badge-warning px-3 rounded-pill">Low Stock</span>',
	'Out' => '<span class="badge badge-danger px-3 rounded-pill">Out of Stock</span>',
);
?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Stock Report</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<form action="./" method="GET" id="stock-form">
				<input type="hidden" name="page" value="stock_report">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-12">
						<div class="form-group mb-3">
							<label for="product_id" class="control-label">Product</label>
							<select id="product_id" name="product_id" class="form-control form-control-sm rounded">
								<option value="0">All Products</option>
								<?php
								$product_qry = $conn->query("SELECT id, name, product_code FROM `product_list` where delete_flag = 0 order by `name`");
								while($p = $product_qry->fetch_assoc()): ?>
								<option value="<?= $p['id'] ?>" <?= $product_id == $p['id'] ? 'selected' : '' ?>><?= $p['name'] ?> - <?= $p['product_code'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12">
						<div class="form-group mb-3">
							<label for="from_date" class="control-label">From Date</label>
							<input type="date" id="from_date" name="from_date" class="form-control form-control-sm rounded" value="<?= $from_date ?>">
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12">
						<div class="form-group mb-3">
							<label for="to_date" class="control-label">To Date</label>
							<input type="date" id="to_date" name="to_date" class="form-control form-control-sm rounded" value="<?= $to_date ?>">
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12">
						<div class="form-group mb-3">
							<label for="stock_status" class="control-label">Stock Status</label>
							<select id="stock_status" name="stock_status" class="form-control form-control-sm rounded">
								<option value="All" <?= $stock_status == 'All' ? 'selected' : '' ?>>All</option>
								<option value="In" <?= $stock_status == 'In' ? 'selected' : '' ?>>In Stock (more than <?= $low_limit ?>)</option>
								<option value="Low" <?= $stock_status == 'Low' ? 'selected' : '' ?>>Low Stock (1 to <?= $low_limit ?>)</option>
								<option value="Out" <?= $stock_status == 'Out' ? 'selected' : '' ?>>Out of Stock (0 or less)</option>
							</select>
						</div>
					</div>
					<div class="col-12">
						<small class="text-muted">Stock = Opening Stock + Purchases &minus; Invoices. Cancelled bills are not counted. Leave From Date empty to start from each product's opening stock.</small>
						<button type="submit" class="btn btn-primary rounded-0" style="float:right;margin-bottom:10px;">Submit</button>
						<a href="./?page=stock_report" class="btn btn-default border rounded-0 mr-2" style="float:right;margin-bottom:10px;">Reset</a>
					</div>
				</div>
			</form>
			<table class="table table-hover table-striped table-bordered" id="stock-list">
				<thead>
					<tr>
						<th>#</th>
						<th>Product Code</th>
						<th>Product</th>
						<th>HSN</th>
						<th class="text-right">Opening</th>
						<th class="text-right">Purchased</th>
						<th class="text-right">Sold</th>
						<th class="text-right">Closing</th>
						<th class="text-right">Buy Price</th>
						<th class="text-right">Stock Value</th>
						<th class="text-center">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; foreach($rows as $row): ?>
					<tr>
						<td class="text-center"><?= $i++ ?></td>
						<td><?= $row['product_code'] ?></td>
						<td><?= $row['name'] ?></td>
						<td><?= $row['hsn_code'] ?></td>
						<td class="text-right"><?= $row['opening'] ?></td>
						<td class="text-right"><?= $row['pur_in'] ?></td>
						<td class="text-right"><?= $row['sold_in'] ?></td>
						<td class="text-right font-weight-bold <?= $row['closing'] < 0 ? 'text-danger' : '' ?>"><?= $row['closing'] ?></td>
						<td class="text-right"><?= format_num($row['buy_price'], 2) ?></td>
						<td class="text-right"><?= format_num($row['value'], 2) ?></td>
						<td class="text-center"><?= $badges[$row['state']] ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr class="font-weight-bold">
						<td colspan="4" class="text-right">Total</td>
						<td class="text-right"><?= $totals['opening'] ?></td>
						<td class="text-right"><?= $totals['pur_in'] ?></td>
						<td class="text-right"><?= $totals['sold_in'] ?></td>
						<td class="text-right"><?= $totals['closing'] ?></td>
						<td></td>
						<td class="text-right"><?= format_num($totals['value'], 2) ?></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<script>
	$(function(){
		$('select#product_id').select2({ width:'100%', containerCssClass:'form-control form-control-sm rounded-0' })
		$('select#stock_status').select2({ width:'100%', minimumResultsForSearch: -1, containerCssClass:'form-control form-control-sm rounded-0' })
		$('#stock-list').dataTable({ order:[0,'asc'] });
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
</script>

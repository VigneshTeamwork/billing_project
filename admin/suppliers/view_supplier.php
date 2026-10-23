<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `supplier_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
	<dl>
        <dt class="text-muted">Name</dt>
        <dd class="pl-4"><?= isset($sup_name) ? $sup_name : "" ?></dd>
        <dt class="text-muted">Mobile No</dt>
        <dd class="pl-4"><?= isset($sup_mob_no) ? $sup_mob_no : '' ?></dd>
		<dt class="text-muted">Email ID</dt>
        <dd class="pl-4"><?= isset($sup_email_id) ? $sup_email_id : '' ?></dd>
		<dt class="text-muted">Address</dt>
        <dd class="pl-4"><?= isset($sup_address) ? $sup_address : '' ?></dd>
		<dt class="text-muted">GST No</dt>
        <dd class="pl-4"><?= isset($sup_gst_no) ? $sup_gst_no : '' ?></dd>
        <dt class="text-muted">Status</dt>
        <dd class="pl-4">
            <?php if(isset($status) && $status == 1): ?>
                <span class="badge badge-success px-3 rounded-pill">Active</span>
            <?php else: ?>
                <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
            <?php endif; ?>
        </dd>
    </dl>
    <div class="clear-fix my-3"></div>
    <div class="text-right">
        <button class="btn btn-sm btn-dark bg-gradient-dark btn-flat" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>

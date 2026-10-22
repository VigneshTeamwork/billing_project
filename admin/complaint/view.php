<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `complaints` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }else{
        echo '<script> alert("Unknown Complaint\'s ID."); location.replace("./?page=quotations"); </script>';
    }
}else{
    echo '<script> alert("Complaint\'s ID is required to access the page."); location.replace("./?page=quotations"); </script>';
}
?>
<div class="content py-3">
    <div class="card card-outline card-navy rounded-0 shadow">
        <div class="card-header">
            <h4 class="card-title">Complaint Details: <b></b></h4>
            <div class="card-tools">
                <a href="./?page=complaint" class="btn btn-default border btn-sm"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid" id="printout">
                <div class="row mb-0">
					
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Date </b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= date("M d, Y H:i", strtotime($created_at)) ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Name</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($name) ? $name : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Mobile No</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($mobile_no) ? $mobile_no : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Email</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($email_id) ? $email_id : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Address</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($address) ? $address : '' ?></div>
					<div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Service</b></div>
                    <div class="col-9 py-1 px-2 border mb-0">
					<?php
					$ser_qry = $conn->query("SELECT * FROM `service_list` where delete_flag = 0 and `status` = 1 order by `name`");
					while($ser_row = $ser_qry->fetch_assoc()):
						$service_ids = explode(",",$service_id);
						foreach($service_ids as $new_service_id){
							if(!empty($new_service_id)){
								if($ser_row['id'] == $new_service_id){
									echo $ser_row['name']."<br>";
								}
							}
						}
					endwhile;
					?>
					</div>
					<div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Complaint</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($complaint) ? $complaint : '' ?></div>
					<div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Status</b></div>
                    <div class="col-9 py-1 px-2 border mb-0">
						<?php 
						switch($status){
							case 0:
								echo '<span class="badge badge-danger border px-3 rounded-pill">Pending</span>';
								break;
							case 1:
								echo '<span class="badge badge-success px-3 rounded-pill">Done</span>';
								break;
							case 2:
								echo '<span class="badge badge-danger px-3 rounded-pill">Cancelled</span>';
								break;
								
						}
						?>
					</div>
                </div>
                <div class="clear-fix mb-2"></div>
            </div>
			<hr>
            <div class="row justify-content-center">
                <button class="btn btn-primary bg-gradient-navy border col-lg-3 col-md-4 col-sm-12 col-xs-12 rounded-pill" id="update_status" type="button">Update Status</button>
            </div>
            <hr>
        </div>
    </div>
</div>
<script>
$(function(){
    $('#update_status').click(function(){
        uni_modal("Update complaint Status", "complaint/update_status.php?id=<?= isset($id) ? $id : '' ?>")
    })
})
</script>
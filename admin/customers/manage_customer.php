<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `customer_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
	#cimg{
		width:100%;
		max-height:20vh;
		object-fit:scale-down;
		object-position:center center;
	}
</style>
<div class="container-fluid">
	<form action="" id="customer-form">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
			<label for="name" class="control-label">Name</label>
			<input type="text" name="cus_name" id="cus_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($cus_name) ? $cus_name : ''; ?>"  required/>
		</div>
		<div class="form-group">
			<label for="cus_mob_no" class="control-label">Mobile No</label>
			<input type="text" name="cus_mob_no" id="cus_mob_no" class="form-control form-control-sm rounded-0" value="<?php echo isset($cus_mob_no) ? $cus_mob_no : ''; ?>"  required/>
		</div>
		<div class="form-group">
			<label for="cus_email_id" class="control-label">Email ID</label>
			<input type="text" name="cus_email_id" id="cus_email_id" class="form-control form-control-sm rounded-0" value="<?php echo isset($cus_email_id) ? $cus_email_id : ''; ?>"  required/>
		</div>
		<div class="form-group">
			<label for="address" class="control-label">Address</label>
			<textarea type="text" name="cus_address" id="cus_address" class="form-control form-control-sm rounded-0" required><?php echo isset($cus_address) ? $cus_address : ''; ?></textarea>
		</div>
		<div class="form-group">
			<label for="cus_gst_no" class="control-label">GST No</label>
			<input type="text" name="cus_gst_no" id="cus_gst_no" class="form-control form-control-sm rounded-0" value="<?php echo isset($cus_gst_no) ? $cus_gst_no : ''; ?>"  required/>
		</div>
		<div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select name="status" id="status" class="form-control form-control-sm rounded-0" required>
				<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
				<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
			</select>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('#customer-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_customer",
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
						location.reload()
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
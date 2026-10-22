<style>
.select2-container--default .select2-selection--multiple {
    min-height: calc(4rem + 2px) !important;
    overflow: auto !important;
}
</style>
<section class="py-5">
    <div class="container">
        <div class="card rounded-0" style="width:40%;margin:0 auto;">
            <div class="card-body">
                <div class="container-fluid">
					<form action="" id="complaint-form">
						<div class="form-group">
							<label for="name" class="control-label">Name</label>
							<input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" required />
						</div>
						<div class="form-group">
							<label for="mobile_no" class="control-label">Mobile No</label>
							<input type="text" name="mobile_no" id="mobile_no" class="form-control form-control-sm rounded-0" required />
						</div>
						<div class="form-group">
							<label for="email_id" class="control-label">Email ID</label>
							<input type="text" name="email_id" id="email_id" class="form-control form-control-sm rounded-0" />
						</div>
						<div class="form-group">
							<label for="address" class="control-label">Address</label>
							<textarea type="text" name="address" id="address" class="form-control form-control-sm rounded-0" required></textarea>
						</div>
						<!--<div class="form-group">
							<label for="cus_gst_no" class="control-label">Services</label>
							<select id="service_sel" name="service_id[]" class="" multiple>
								<option value="" disabled selected></option>
								<?php 
								$service_qry = $conn->query("SELECT * FROM `service_list` where delete_flag = 0 and `status` = 1 order by `name`");
								while($row = $service_qry->fetch_assoc()):
								?>
								<option value="<?= $row['id'] ?>" data-price = "<?= $row['price'] ?>"><?= $row['name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>-->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<fieldset>
								<div class="row align-items-end">
									<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
										<div class="form-group mb-0">
											<label for="service_sel" class="control-label">Select Service</label>
											<input type="hidden" name="service_id" id="service_id" value="" />
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
									<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
										<button class="btn btn-default bg-gradient-navy btn-sm rounded-0" type="button" id="add_service" style="color:#fff;">Add</button>
									</div>
								</div>
								<div class="clear-fix mb-2"></div>
								<table class="table table-striped table-bordered" id="service-list">
									<colgroup>
										<col width="5%">
										<col width="50%">
										<col width="45%">
									</colgroup>
									<thead>
										<tr class="bg-gradient-navy">
											<th class="text-center"></th>
											<th class="text-center">Service</th>
											<th class="text-right">Price</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
									<tfoot>
									</tfoot>
								</table>
							</fieldset>
						</div>
						<div class="form-group">
							<label for="complaint" class="control-label">Complaint</label>
							<textarea type="text" rows="10" name="complaint" id="complaint" class="form-control form-control-sm rounded-0" required></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary rounded-0 w-100" form="complaint-form">Submit</button>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</section>
<noscript id="service-clone">
    <tr>
        <td class="text-center">
            <button class="btn btn-outline-danger btn-sm rounded-0 rem-service" type="button" name="del[]"><i class="fa fa-times"></i></button>
        </td>
        <td>
            <!--<input type="hidden" name="service_ids[]" value="">-->
            <span class="service_name"></span>
        </td>
        <td class="text-right service_price"></td>
    </tr>
</noscript>
<script>
$(function(){
	$('select#service_sel').select2({
		placeholder:"Select Service here",
		width:'100%',
		containerCssClass:'form-control form-control-sm rounded-0'
	})
	
	$('#add_service').click(function(){
		if($('#service_sel').val() == null)
		return false;
		var id = $('#service_sel').val()
		/*if($('#service-list tbody tr input[name="service_ids[]"][value="'+id+'"]').length > 0){
			alert("Service already on the list.")
			return false;
		}*/
		var name = $('#service_sel option[value="'+id+'"]').text()
		var price = $('#service_sel option[value="'+id+'"]').attr('data-price')
		var tr = $($('noscript#service-clone').html()).clone()
		//tr.find('input[name="service_ids[]"]').val(id)
		tr.find('button[name="del[]"]').val(id)
		tr.find('.service_name').text(name)
		tr.find('.service_price').text(parseFloat(price).toLocaleString())
		$('#service-list tbody').append(tr)
		
		var pre_service_value = $('#service_id').val();
		var new_service_ids = '';
		if(pre_service_value == ''){
			new_service_ids = id;	
		}else{
			new_service_ids = pre_service_value + ',' + id;	
		}
		
		
		$('#service_id').val(new_service_ids);
		
		tr.find('.rem-service').click(function(){
			if(confirm("Are you sure to remove "+name+" from service list?") === true){
				var cur_service_value = $('#service_id').val();
				var del_id = tr.find('button[name="del[]"]').val();
				
				/*var new_service_ids = cur_service_value.replace(del_id, '');
				alert(new_service_ids);
				$('#service_id').val(new_service_ids);*/
				
				var split_service_ids = cur_service_value.split(",");
				split_service_ids.splice( $.inArray(del_id,split_service_ids) ,1 );
				$('#service_id').val(new_service_ids);
				
				tr.remove()
			}
		})
		
		$('#service_sel').val('').trigger("change")
	})
	
	/*$('#service-list tbody tr').find('.rem-service').click(function(){
		var tr = $(this).closest('tr')
		if(confirm("Are you sure to remove "+(tr.find('.service_name').text())+" from service list?") === true){
			tr.remove()
		}
	})*/
});

$(document).ready(function(){
	$('#complaint-form').submit(function(e){
		e.preventDefault();
		var _this = $(this)
		 $('.err-msg').remove();
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=save_complaint",
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
<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `product_list` where id = '{$_GET['id']}' ");
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
	<form action="" id="product-form">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
			<label for="product_code" class="control-label">Product Code</label>
			<input type="text" name="product_code" id="product_code" class="form-control form-control-sm rounded-0" value="<?php echo isset($product_code) ? $product_code : ''; ?>"  required/>
		</div>
		<div class="form-group">
			<label for="name" class="control-label">Name</label>
			<input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" value="<?php echo isset($name) ? $name : ''; ?>"  required/>
		</div>
		<div class="form-group">
			<label for="description" class="control-label">Description</label>
			<textarea type="text" name="description" id="description" class="form-control form-control-sm rounded-0" required><?php echo isset($description) ? $description : ''; ?></textarea>
		</div>
		<div class="form-group">
			<label for="price" class="control-label">HSN Code</label>
			<input type="text" name="hsn_code" id="hsn_code" class="form-control form-control-sm rounded-0" value="<?php echo isset($hsn_code) ? $hsn_code : ''; ?>"  required/>
		</div>
		<div class="form-group">
			<label for="buy_price" class="control-label">Buying Price</label>
			<input type="number" name="buy_price" id="buy_price" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($buy_price) ? $buy_price : ''; ?>"  required/>
		</div>
		<div class="form-group">
			<label for="price" class="control-label">Selling Price</label>
			<input type="number" name="price" id="price" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($price) ? $price : ''; ?>"  required/>
		</div>
		<div class="form-row">
			<div class="form-group col-6">
				<label for="opening_stock" class="control-label">Opening Stock</label>
				<input type="number" min="0" name="opening_stock" id="opening_stock" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($opening_stock) ? $opening_stock : 0; ?>"/>
			</div>
			<div class="form-group col-6">
				<label for="opening_stock_date" class="control-label">Opening Stock As On</label>
				<input type="date" name="opening_stock_date" id="opening_stock_date" class="form-control form-control-sm rounded-0" value="<?php echo isset($opening_stock_date) ? $opening_stock_date : ''; ?>"/>
			</div>
			<small class="text-muted col-12 mb-2" style="margin-top:-.5rem">Sales and purchases dated before this date are not counted in stock.</small>
		</div>
		<div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select name="status" id="status" class="form-control form-control-sm rounded-0" required>
				<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
				<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
			</select>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Thumbnail</label>
			<div class="custom-file">
				<input type="file" class="custom-file-input rounded-circle" id="customFile1" accept="image/png, image/jpeg" name="img" onchange="displayImg(this,$(this))">
				<label class="custom-file-label" for="customFile1">Choose file</label>
			</div>
		</div>
		<div class="form-group">
			<img src="<?= validate_image(isset($image_path) ? $image_path : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail w-100">
		</div>
	</form>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }
	        reader.readAsDataURL(input.files[0]);
	    }else{
				$('#cimg').attr('src', "<?= validate_image(isset($image_path) ? $image_path : '') ?>");
		}
	}
	$(document).ready(function(){
		// New product: opening stock counts from today (this computer's date).
		if(!$('[name="id"]').val() && !$('#opening_stock_date').val()) $('#opening_stock_date').val(new Date().toLocaleDateString('en-CA'))
		$('#product-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_product",
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
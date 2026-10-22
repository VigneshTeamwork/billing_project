<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Complaints </h3>
		<div class="card-tools">
			<!--<a href="./?page=transactions/manage_transaction" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>-->
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<form action="" id="report-form" method="POST">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group mb-3">
							<label for="from_date" class="control-label">From Date</label>
							<input type="date" id="from_date" name="from_date" class="form-control form-control-sm rounded" placeholder="From Date" value="<?php if(isset($_POST['from_date'])){ echo $_POST['from_date']; }else{ echo date('Y-m-d'); } ?>">
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group mb-3">
							<label for="to_date" class="control-label">To Date</label>
							<input type="date" id="to_date" name="to_date" class="form-control form-control-sm rounded" placeholder="To Date" value="<?php if(isset($_POST['to_date'])){ echo $_POST['to_date']; }else{ echo date('Y-m-d'); } ?>">
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="form-group mb-3">
							<label for="service_id" class="control-label">Select Service</label>
							<select id="service_id" name="service_id" class="form-control form-control-sm rounded">
								<option value="" disabled selected></option>
								<?php 
								$service_qry = $conn->query("SELECT * FROM `service_list` where delete_flag = 0 and `status` = 1 order by `name`");
								while($row = $service_qry->fetch_assoc()): ?>
								<?php 
								if(isset($_POST['service_id'])){
									if($row['id'] == $_POST['service_id']){
										?>
										<option value="<?= $row['id'] ?>" data-price = "<?= $row['name'] ?>" selected ><?= $row['name'] ?></option>
										<?php
									}else{
										?>
										<option value="<?= $row['id'] ?>" data-price = "<?= $row['name'] ?>" ><?= $row['name'] ?></option>
										<?php
									}
								}else{
									?>
									<option value="<?= $row['id'] ?>" data-price = "<?= $row['name'] ?>" ><?= $row['name'] ?></option>
									<?php
								}
								
								?>
								
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group mb-3">
							<button type="submit" name="complaint_submit" class="btn btn-primary rounded-0" style="float:right;margin-bottom:10px;">Submit</button>
						</div>
					</div>
				</div>
			</form>
			<table class="table table-hover table-striped table-bordered" id="list">
				<!--<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="25%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
				</colgroup>-->
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Name</th>
						<th>Mobile No</th>
						<th>Email ID</th>
						<th>Address</th>
						<th>Service</th>
						<th>Complaint</th>
						<th class="text-center">Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$table_condition = '';
					$where_condition = '';
					if(isset($_POST['complaint_submit'])){
						
						if(isset($_POST['service_id'])){
							if(!empty($_POST['service_id'])){
								$where_condition.= "service_id = '{$_POST['service_id']}' and ";
							}
						}
						
						if(isset($_POST['from_date'])){
							if(!empty($_POST['from_date'])){
								$from_date = date("Y-m-d", strtotime($_POST['from_date']));
								$where_condition.= "DATE(created_at) >= '{$from_date}' and ";
							}
						}
						
						if(isset($_POST['to_date'])){
							if(!empty($_POST['to_date'])){
								$to_date = date("Y-m-d", strtotime($_POST['to_date']));
								$where_condition.= "DATE(created_at) <= '{$to_date}' and ";
							}
						}
						$where_condition.= "delete_flag = 0";
						
						$qry = $conn->query("SELECT * FROM `complaints` where {$where_condition} order by unix_timestamp(created_at) desc");
					}else{
						$qry = $conn->query("SELECT * FROM `complaints` where `delete_flag` = 0 order by unix_timestamp(created_at) desc");
					}
					$i = 1;
					while($row = $qry->fetch_assoc()):
					?>
					<tr>
						<td class="text-center"><?php echo $i++; ?></td>
						<td><p class="m-0 truncate-1"><?= date("M d, Y H:i", strtotime($row['created_at'])) ?></p></td>
						<td><p class="m-0 truncate-1"><?= $row['name'] ?></p></td>
						<td><p class="m-0 truncate-1"><?= $row['mobile_no'] ?></p></td>
						<td><p class="m-0 truncate-1"><?= $row['email_id'] ?></p></td>
						<td><p class="m-0 truncate-1"><?= $row['address'] ?></p></td>
						<td><p class="m-0 truncate-1">
						<?php
						$service_qry = $conn->query("SELECT * FROM `service_list` where delete_flag = 0 and `status` = 1 order by `name`");
						while($ser_row = $service_qry->fetch_assoc()):
							$service_ids = explode(",",$row['service_id']);
							foreach($service_ids as $service_id){
								if(!empty($service_id)){
									if($ser_row['id'] == $service_id){
										echo $ser_row['name'].",";
									}
								}
							}
						endwhile;
						?>
						</p></td>
						<td><p class="m-0 truncate-1"><?= $row['complaint'] ?></p></td>
						<td class="text-center">
							<?php 
							switch($row['status']){
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
						</td>
						<td align="center">
							 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <div class="dropdown-menu" role="menu">
								<a class="dropdown-item" href="?page=complaint/view&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
							  </div>
						</td>
						<!--<td align="center">
							<a class="btn btn-default bg-gradient-light btn-flat btn-sm" href="?page=complaint/view&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
						</td>-->
					</tr>
				<?php endwhile; 
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(function(){
		$('select#service_id').select2({
            placeholder:"Select Service here",
            width:'100%',
            containerCssClass:'form-control form-control-sm rounded-0'
        })
	});
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Complaint permanently?","delete_complaint",[$(this).attr('data-id')])
		})
		
		$('.table').dataTable({
			columnDefs: [
				{ orderable: false, targets: [5] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_complaint($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_complaint",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
	
</script>
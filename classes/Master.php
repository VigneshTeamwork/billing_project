<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function delete_img(){
		extract($_POST);
		if(is_file($path)){
			if(unlink($path)){
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete '.$path;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown '.$path.' path';
		}
		return json_encode($resp);
	}
	function save_service(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `service_list` where `name` = '{$name}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Service Name already exists.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `service_list` set {$data} ";
		}else{
			$sql = "UPDATE `service_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$bid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Service successfully saved.";
			else
				$resp['msg'] = " Service successfully updated.";
				
				if(!empty($_FILES['img']['tmp_name'])){
					$dir = 'uploads/services/';
					if(!is_dir(base_app.$dir))
					mkdir(base_app.$dir);
					$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
					$fname = $dir.$bid.".png";
					$accept = array('image/jpeg','image/png');
					if(!in_array($_FILES['img']['type'],$accept)){
						$resp['msg'] .= "Image file type is invalid";
					}
					if($_FILES['img']['type'] == 'image/jpeg')
						$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
					elseif($_FILES['img']['type'] == 'image/png')
						$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
					if(!$uploadfile){
						$resp['msg'] .= "Image is invalid";
					}
					list($width, $height) = getimagesize($_FILES['img']['tmp_name']);
					if($width > 640 || $height > 480){
						if($width > $height){
							$perc = ($width - 640) / $width;
							$width = 640;
							$height = $height - ($height * $perc);
						}else{
							$perc = ($height - 480) / $height;
							$height = 480;
							$width = $width - ($width * $perc);
						}
					}
					$temp = imagescale($uploadfile,$width,$height);
					if(is_file(base_app.$fname))
					unlink(base_app.$fname);
					$upload =imagepng($temp,base_app.$fname,6);
					if($upload){
						$this->conn->query("UPDATE `service_list` set image_path = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$bid}' ");
					}
					imagedestroy($temp);
				}
			
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_service(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `service_list` set `delete_flag` = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Service successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_product(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `product_list` where `name` = '{$name}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Product Name already exists.";
			return json_encode($resp);
			exit;
		}
		
		$check = $this->conn->query("SELECT * FROM `product_list` where `product_code` = '{$product_code}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Product Code already exists.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `product_list` set {$data} ";
		}else{
			$sql = "UPDATE `product_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$pid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Product successfully saved.";
			else
				$resp['msg'] = " Product successfully updated.";
			if(!empty($_FILES['img']['tmp_name'])){
				$dir = 'uploads/products/';
				if(!is_dir(base_app.$dir))
				mkdir(base_app.$dir);
				$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
				$fname = $dir.$pid.".png";
				$accept = array('image/jpeg','image/png');
				if(!in_array($_FILES['img']['type'],$accept)){
					$resp['msg'] .= "Image file type is invalid";
				}
				if($_FILES['img']['type'] == 'image/jpeg')
					$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
				elseif($_FILES['img']['type'] == 'image/png')
					$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
				if(!$uploadfile){
					$resp['msg'] .= "Image is invalid";
				}
				list($width, $height) = getimagesize($_FILES['img']['tmp_name']);
				if($width > 640 || $height > 480){
					if($width > $height){
						$perc = ($width - 640) / $width;
						$width = 640;
						$height = $height - ($height * $perc);
					}else{
						$perc = ($height - 480) / $height;
						$height = 480;
						$width = $width - ($width * $perc);
					}
				}
				$temp = imagescale($uploadfile,$width,$height);
				if(is_file(base_app.$fname))
				unlink(base_app.$fname);
				$upload =imagepng($temp,base_app.$fname,6);
				if($upload){
					$this->conn->query("UPDATE `product_list` set image_path = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$pid}' ");
				}
				imagedestroy($temp);
			}
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_product(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `product_list` set `delete_flag` = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Product successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	
	function save_customer(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `customer_list` where `cus_name` = '{$cus_name}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Customer Name already exists.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `customer_list` set {$data} ";
		}else{
			$sql = "UPDATE `customer_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$pid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Customer successfully saved.";
			else
				$resp['msg'] = " Customer successfully updated.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_customer(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `customer_list` set `delete_flag` = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Product successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_supplier(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$name = $this->conn->real_escape_string($sup_name);
		$check = $this->conn->query("SELECT * FROM `supplier_list` where `sup_name` = '{$name}' and delete_flag = 0 ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Supplier Name already exists.";
			return json_encode($resp);
		}
		if(empty($id)){
			$sql = "INSERT INTO `supplier_list` set {$data} ";
		}else{
			$sql = "UPDATE `supplier_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Supplier successfully saved.";
			else
				$resp['msg'] = " Supplier successfully updated.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_supplier(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `supplier_list` set `delete_flag` = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Supplier successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_transaction(){
		if(empty($_POST['id'])){
			$_POST['user_id'] = $this->settings->userdata('id');
			$_POST['code'] = next_doc_code($_POST['invoice_type'] == 'GST' ? 'gst' : 'nongst');
		}
		if(empty($_POST['invoice_date']))
			$_POST['invoice_date'] = date('Y-m-d');
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `transaction_list` set {$data} ";
		}else{
			$sql = "UPDATE `transaction_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$tid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['tid'] = $tid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Invoice successfully saved.";
			else
				$resp['msg'] = " Invoice successfully updated.";
			
			$this->conn->query("DELETE FROM `transaction_services` where transaction_id = '{$tid}'");
			if(isset($service_id)){
				$data = "";
				foreach($service_id as $k =>$v){
					$sid = $v;
					$price = $this->conn->real_escape_string($service_price[$k]);
					$qty = $this->conn->real_escape_string($service_qty[$k]);
					$dis_type = $this->conn->real_escape_string($service_dis_type[$k]);
					$discount_amt = $this->conn->real_escape_string($service_discount_amt[$k]);
					$discount = $this->conn->real_escape_string($service_discount[$k]);
					$total = $this->conn->real_escape_string($service_total[$k]);
					if(!empty($data)) $data .= ", ";
					$data .= "('{$tid}', '{$sid}', '{$qty}', '{$price}', '{$dis_type}', '{$discount_amt}', '{$discount}', '{$total}')";
				}
				if(!empty($data)){
					
					$sql_service = "INSERT INTO `transaction_services` (`transaction_id`, `service_id`, `qty`, `price`, `service_dis_type`, `service_discount_amt`, `service_discount`, `service_total`) VALUES {$data}";
					$save_services = $this->conn->query($sql_service);
					if(!$save_services){
						$resp['status'] = 'failed';
						$resp['sql'] = $sql_service;
						$resp['error'] = $this->conn->error;
						if(empty($id)){
							$resp['msg'] = "Invoice has failed save.";
							$this->conn->query("DELETE FROM `transaction_services` where transaction_id = '{$tid}'");
						}else{
							$resp['msg'] = "Invoice has failed update.";
						}
						return json_encode($resp);
					}
				}
			}
			$this->conn->query("DELETE FROM `transaction_products` where transaction_id = '{$tid}'");
			if(isset($product_id)){
				$data = "";
				foreach($product_id as $k =>$v){
					$pid = $v;
					$price = $this->conn->real_escape_string($product_price[$k]);
					$qty = $this->conn->real_escape_string($product_qty[$k]);
					$dis_type = $this->conn->real_escape_string($product_dis_type[$k]);
					$discount = $this->conn->real_escape_string($product_discount[$k]);
					$discount_amt = $this->conn->real_escape_string($product_discount_amt[$k]);
					$total = $this->conn->real_escape_string($product_total[$k]);
					if(!empty($data)) $data .= ", ";
					$data .= "('{$tid}', '{$pid}', '{$qty}', '{$price}', '{$dis_type}', '{$discount}', '{$discount_amt}', '{$total}')";
				}
				if(!empty($data)){
					$sql_product = "INSERT INTO `transaction_products` (`transaction_id`, `product_id`,`qty`, `price`, `product_dis_type`, `product_discount`, `product_discount_amt`, `product_total`) VALUES {$data}";
					$save_products = $this->conn->query($sql_product);
					if(!$save_products){
						$resp['status'] = 'failed';
						$resp['sql'] = $sql_product;
						$resp['error'] = $this->conn->error;
						if(empty($id)){
							$resp['msg'] = "Invoice has failed save.";
							$this->conn->query("DELETE FROM `transaction_products` where transaction_id = '{$tid}'");
						}else{
							$resp['msg'] = "Invoice has failed update.";
						}
						return json_encode($resp);
					}
				}
			}
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_transaction(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `transaction_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Invoice successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function update_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `transaction_list` set `status` = '{$status}' where id = '{$id}'");
		if($update){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "Invoice's status has failed to update.";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success', 'Invoice\'s Status has been updated successfully.');
		return json_encode($resp);
	}
	
	function save_quotation(){
		if(empty($_POST['id'])){
			$_POST['user_id'] = $this->settings->userdata('id');
			$_POST['code'] = next_doc_code('quotation');
		}
		if(empty($_POST['quotation_date']))
			$_POST['quotation_date'] = date('Y-m-d');
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `quotation_list` set {$data} ";
		}else{
			$sql = "UPDATE `quotation_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$tid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['tid'] = $tid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Invoice successfully saved.";
			else
				$resp['msg'] = " Invoice successfully updated.";
			$this->conn->query("DELETE FROM `quotation_services` where quotation_id = '{$tid}'");
			if(isset($service_id)){
				$data = "";
				foreach($service_id as $k =>$v){
					$sid = $v;
					$price = $this->conn->real_escape_string($service_price[$k]);
					$qty = $this->conn->real_escape_string($service_qty[$k]);
					$dis_type = $this->conn->real_escape_string($service_dis_type[$k]);
					$discount_amt = $this->conn->real_escape_string($service_discount_amt[$k]);
					$discount = $this->conn->real_escape_string($service_discount[$k]);
					$total = $this->conn->real_escape_string($service_total[$k]);
					if(!empty($data)) $data .= ", ";
					$data .= "('{$tid}', '{$sid}', '{$qty}', '{$price}', '{$dis_type}', '{$discount_amt}', '{$discount}', '{$total}')";
				}
				if(!empty($data)){
					
					$sql_service = "INSERT INTO `quotation_services` (`quotation_id`, `service_id`, `qty`, `price`, `service_dis_type`, `service_discount_amt`, `service_discount`, `service_total`) VALUES {$data}";
					$save_services = $this->conn->query($sql_service);
					if(!$save_services){
						$resp['status'] = 'failed';
						$resp['sql'] = $sql_service;
						$resp['error'] = $this->conn->error;
						if(empty($id)){
							$resp['msg'] = "Invoice has failed save.";
							$this->conn->query("DELETE FROM `quotation_services` where quotation_id = '{$tid}'");
						}else{
							$resp['msg'] = "Invoice has failed update.";
						}
						return json_encode($resp);
					}
				}
			}
			$this->conn->query("DELETE FROM `quotation_products` where quotation_id = '{$tid}'");
			if(isset($product_id)){
				$data = "";
				foreach($product_id as $k =>$v){
					$pid = $v;
					$price = $this->conn->real_escape_string($product_price[$k]);
					$qty = $this->conn->real_escape_string($product_qty[$k]);
					$dis_type = $this->conn->real_escape_string($product_dis_type[$k]);
					$discount = $this->conn->real_escape_string($product_discount[$k]);
					$discount_amt = $this->conn->real_escape_string($product_discount_amt[$k]);
					$total = $this->conn->real_escape_string($product_total[$k]);
					if(!empty($data)) $data .= ", ";
					$data .= "('{$tid}', '{$pid}', '{$qty}', '{$price}', '{$dis_type}', '{$discount}', '{$discount_amt}', '{$total}')";
				}
				if(!empty($data)){
					
					$sql_product = "INSERT INTO `quotation_products` (`quotation_id`, `product_id`,`qty`, `price`, `product_dis_type`, `product_discount`, `product_discount_amt`, `product_total`) VALUES {$data}";
					$save_products = $this->conn->query($sql_product);
					if(!$save_products){
						$resp['status'] = 'failed';
						$resp['sql'] = $sql_product;
						$resp['error'] = $this->conn->error;
						if(empty($id)){
							$resp['msg'] = "Invoice has failed save.";
							$this->conn->query("DELETE FROM `quotation_products` where quotation_id = '{$tid}'");
						}else{
							$resp['msg'] = "Invoice has failed update.";
						}
						return json_encode($resp);
					}
				}
			}
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_quotation(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `quotation_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Invoice successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function convert_to_invoice(){
		if(empty($_POST['id'])){
			$_POST['user_id'] = $this->settings->userdata('id');
			$_POST['code'] = next_doc_code($_POST['invoice_type'] == 'GST' ? 'gst' : 'nongst');
		}
		if(empty($_POST['invoice_date']))
			$_POST['invoice_date'] = date('Y-m-d');
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `transaction_list` set {$data} ";
		}else{
			$sql = "UPDATE `transaction_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$tid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['tid'] = $tid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Invoice successfully saved.";
			else
				$resp['msg'] = " Invoice successfully updated.";
			$this->conn->query("DELETE FROM `transaction_services` where transaction_id = '{$tid}'");
			if(isset($service_id)){
				$data = "";
				foreach($service_id as $k =>$v){
					$sid = $this->conn->real_escape_string($service_id[$k]);
					$qty = $this->conn->real_escape_string($service_qty[$k]);
					$price = $this->conn->real_escape_string($service_price[$k]);
					$dis_type = $this->conn->real_escape_string($service_dis_type[$k]);
					$discount_amt = $this->conn->real_escape_string($service_discount_amt[$k]);
					$discount = $this->conn->real_escape_string($service_discount[$k]);
					$total = $this->conn->real_escape_string($service_total[$k]);
					if(!empty($data)) $data .= ", ";
					$data .= "('{$tid}', '{$sid}', '{$qty}', '{$price}', '{$dis_type}', '{$discount_amt}', '{$discount}', '{$total}')";
				}
				if(!empty($data)){
					$sql_service = "INSERT INTO `transaction_services` (`transaction_id`, `service_id`, `qty`, `price`, `service_dis_type`, `service_discount_amt`, `service_discount`, `service_total`) VALUES {$data}";
					$save_services = $this->conn->query($sql_service);
					if(!$save_services){
						$resp['status'] = 'failed';
						$resp['sql'] = $sql_service;
						$resp['error'] = $this->conn->error;
						if(empty($id)){
							$resp['msg'] = "Invoice has failed save.";
							$this->conn->query("DELETE FROM `transaction_services` where transaction_id = '{$tid}'");
						}else{
							$resp['msg'] = "Invoice has failed update.";
						}
						return json_encode($resp);
					}
				}
			}
			$this->conn->query("DELETE FROM `transaction_products` where transaction_id = '{$tid}'");
			if(isset($product_id)){
				$data = "";
				foreach($product_id as $k =>$v){
					$pid = $this->conn->real_escape_string($product_id[$k]);
					$price = $this->conn->real_escape_string($product_price[$k]);
					$qty = $this->conn->real_escape_string($product_qty[$k]);
					$dis_type = $this->conn->real_escape_string($product_dis_type[$k]);
					$discount = $this->conn->real_escape_string($product_discount[$k]);
					$discount_amt = $this->conn->real_escape_string($product_discount_amt[$k]);
					$total = $this->conn->real_escape_string($product_total[$k]);
					if(!empty($data)) $data .= ", ";
					$data .= "('{$tid}', '{$pid}', '{$qty}', '{$price}', '{$dis_type}', '{$discount}', '{$discount_amt}', '{$total}')";
				}
				if(!empty($data)){
					$sql_product = "INSERT INTO `transaction_products` (`transaction_id`, `product_id`,`qty`, `price`, `product_dis_type`, `product_discount`, `product_discount_amt`, `product_total`) VALUES {$data}";
					$save_products = $this->conn->query($sql_product);
					if(!$save_products){
						$resp['status'] = 'failed';
						$resp['sql'] = $sql_product;
						$resp['error'] = $this->conn->error;
						if(empty($id)){
							$resp['msg'] = "Invoice has failed save.";
							$this->conn->query("DELETE FROM `transaction_products` where transaction_id = '{$tid}'");
						}else{
							$resp['msg'] = "Invoice has failed update.";
						}
						return json_encode($resp);
					}
				}
			}
			$inv_status = 1;
			$update_quotation_inv_status = $this->conn->query("UPDATE `quotation_list` set `invoice_id` = '{$tid}',`inv_status` = '{$inv_status}',`status` = '2' where id = '{$quotation_id}'");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	
	
	function save_complaint(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		/*$check = $this->conn->query("SELECT * FROM `complaints` where `cus_name` = '{$cus_name}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Customer Name already exists.";
			return json_encode($resp);
			exit;
		}*/
		if(empty($id)){
			$sql = "INSERT INTO `complaints` set {$data} ";
		}else{
			$sql = "UPDATE `complaints` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$pid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "Complaint successfully saved.";
			else
				$resp['msg'] = "Complaint successfully updated.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function update_complaint_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `complaints` set `status` = '{$status}' where id = '{$id}'");
		if($update){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "Complaint status has failed to update.";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success', 'Complaint Status has been updated successfully.');
		return json_encode($resp);
	}
	
	function delete_complaint(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `complaints` set `delete_flag` = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Complaint successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	
	function save_payment(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}'";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `payment` set {$data} ";
		}else{
			$sql = "UPDATE `payment` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$pid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "Payment successfully saved.";
			else
				$resp['msg'] = "Payment successfully updated.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	
	function delete_payment(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `payment` set `status` = 1 where payment_id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Payment successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function save_purchase(){
		if(empty($_POST['id'])){
			$_POST['user_id'] = $this->settings->userdata('id');
			$_POST['code'] = next_doc_code($_POST['invoice_type'] == 'GST' ? 'pur_gst' : 'pur_nongst');
		}
		if(empty($_POST['purchase_date']))
			$_POST['purchase_date'] = date('Y-m-d');
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				if($k == 'bill_date' && $v == ''){
					$data .= " `{$k}`=NULL ";
					continue;
				}
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `purchase_list` set {$data} ";
		}else{
			$sql = "UPDATE `purchase_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$pid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['pid'] = $pid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Purchase successfully saved.";
			else
				$resp['msg'] = " Purchase successfully updated.";

			$this->conn->query("DELETE FROM `purchase_products` where purchase_id = '{$pid}'");
			if(isset($product_id)){
				$data = "";
				foreach($product_id as $k =>$v){
					$prod = $this->conn->real_escape_string($v);
					$price = $this->conn->real_escape_string($product_price[$k]);
					$qty = $this->conn->real_escape_string($product_qty[$k]);
					$dis_type = $this->conn->real_escape_string($product_dis_type[$k]);
					$discount = $this->conn->real_escape_string($product_discount[$k]);
					$discount_amt = $this->conn->real_escape_string($product_discount_amt[$k]);
					$total = $this->conn->real_escape_string($product_total[$k]);
					if(!empty($data)) $data .= ", ";
					$data .= "('{$pid}', '{$prod}', '{$qty}', '{$price}', '{$dis_type}', '{$discount}', '{$discount_amt}', '{$total}')";
				}
				if(!empty($data)){
					$sql_product = "INSERT INTO `purchase_products` (`purchase_id`, `product_id`,`qty`, `price`, `product_dis_type`, `product_discount`, `product_discount_amt`, `product_total`) VALUES {$data}";
					$save_products = $this->conn->query($sql_product);
					if(!$save_products){
						$resp['status'] = 'failed';
						$resp['sql'] = $sql_product;
						$resp['error'] = $this->conn->error;
						$resp['msg'] = empty($id) ? "Purchase has failed save." : "Purchase has failed update.";
						return json_encode($resp);
					}
				}
			}
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_purchase(){
		extract($_POST);
		// purchase_products and purchase_payment rows go with it (ON DELETE CASCADE)
		$del = $this->conn->query("DELETE FROM `purchase_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Purchase successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_purchase_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `purchase_list` set `status` = '{$status}' where id = '{$id}'");
		if($update){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', 'Purchase\'s Status has been updated successfully.');
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "Purchase's status has failed to update.";
		}
		return json_encode($resp);
	}
	function save_purchase_payment(){
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}'";
			}
		}
		$sql = "INSERT INTO `purchase_payment` set {$data} ";
		if($this->conn->query($sql)){
			$resp['status'] = 'success';
			$resp['msg'] = "Payment successfully saved.";
			$this->settings->set_flashdata('success',$resp['msg']);
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_purchase_payment(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `purchase_payment` set `status` = 1 where payment_id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Payment successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	
	function update_quo_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `quotation_list` set `status` = '{$status}' where id = '{$id}'");
		if($update){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "Quotation status has failed to update.";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success', 'Quotation Status has been updated successfully.');
		return json_encode($resp);
	}
	
	function backup(){
		/*$db_host = DB_SERVER;
		$db_user = DB_USERNAME;
		$db_pass = DB_PASSWORD;
		$db_name = DB_NAME;
		
		// Path to mysqldump (adjust if needed)
		$dump_file = $db_name . '_' . date('Y-m-d_H-i-s') . '.sql';
		$command = "mysqldump -h $db_host -u $db_user -p$db_pass $db_name > $dump_file";

		// Execute the command
		exec($command);

		// Send the file for download
		if (file_exists($dump_file)) {
			header('Content-Type: application/sql');
			header('Content-Disposition: attachment; filename="' . basename($dump_file) . '"');
			header('Content-Length: ' . filesize($dump_file));
			readfile($dump_file);
			unlink($dump_file); // Optional: delete after download
			exit;
		} else {
			echo "Failed to generate the SQL dump.";
		}*/
		$host = DB_SERVER;
		$user = DB_USERNAME;
		$password = DB_PASSWORD;
		$dbname = DB_NAME;

		$conn = new mysqli($host, $user, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sqlDump = "-- SQL Dump\n-- Database: `$dbname`\n\n";
		$result = $conn->query("SHOW TABLES");

		while ($row = $result->fetch_array()) {
			$table = $row[0];

			// Table structure
			$create = $conn->query("SHOW CREATE TABLE `$table`")->fetch_assoc();
			$sqlDump .= "-- Structure for table `$table`\n";
			$sqlDump .= $create['Create Table'] . ";\n\n";

			// Table data
			$data = $conn->query("SELECT * FROM `$table`");
			if ($data->num_rows > 0) {
				$sqlDump .= "-- Data for table `$table`\n";
				while ($rowData = $data->fetch_assoc()) {
					$columns = array_map(fn($v) => "`$v`", array_keys($rowData));
					$values = array_map(fn($v) => "'" . $conn->real_escape_string($v) . "'", array_values($rowData));
					$sqlDump .= "INSERT INTO `$table` (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ");\n";
				}
				$sqlDump .= "\n";
			}
		}

		// Output as download
		header('Content-Type: application/sql');
		header('Content-Disposition: attachment; filename="' . $dbname . '_backup.sql"');
		echo $sqlDump;
		exit;

	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'delete_img':
		echo $Master->delete_img();
	break;
	case 'save_service':
		echo $Master->save_service();
	break;
	case 'delete_service':
		echo $Master->delete_service();
	break;
	case 'save_product':
		echo $Master->save_product();
	break;
	case 'delete_product':
		echo $Master->delete_product();
	break;
	case 'save_customer':
		echo $Master->save_customer();
	break;
	case 'delete_customer':
		echo $Master->delete_customer();
	break;
	case 'save_supplier':
		echo $Master->save_supplier();
	break;
	case 'delete_supplier':
		echo $Master->delete_supplier();
	break;
	case 'save_purchase':
		echo $Master->save_purchase();
	break;
	case 'delete_purchase':
		echo $Master->delete_purchase();
	break;
	case 'update_purchase_status':
		echo $Master->update_purchase_status();
	break;
	case 'save_purchase_payment':
		echo $Master->save_purchase_payment();
	break;
	case 'delete_purchase_payment':
		echo $Master->delete_purchase_payment();
	break;
	case 'save_transaction':
		echo $Master->save_transaction();
	break;
	case 'delete_transaction':
		echo $Master->delete_transaction();
	break;
	case 'update_status':
		echo $Master->update_status();
	break;
	case 'save_quotation':
		echo $Master->save_quotation();
	break;
	case 'delete_quotation':
		echo $Master->delete_quotation();
	break;
	case 'convert_to_invoice':
		echo $Master->convert_to_invoice();
	break;
	case 'save_complaint':
		echo $Master->save_complaint();
	break;
	case 'update_complaint_status':
		echo $Master->update_complaint_status();
	break;
	case 'delete_complaint':
		echo $Master->delete_complaint();
	break;
	case 'save_payment':
		echo $Master->save_payment();
	break;
	case 'delete_payment':
		echo $Master->delete_payment();
	break;
	case 'update_quo_status':
		echo $Master->update_quo_status();
	break;
	case 'backup':
		echo $Master->backup();
	break;
	default:
		// echo $sysset->index();
		break;
}
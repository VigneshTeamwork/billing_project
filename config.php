<?php
ob_start();
ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');
session_start();

require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');
$db = new DBConnection;
$conn = $db->conn;
function redirect($url=''){
	if(!empty($url))
	echo '<script>location.href="'.base_url .$url.'"</script>';
}
function validate_image($file){
	if(!empty($file)){
			// exit;
        $ex = explode("?",$file);
        $file = $ex[0];
        $ts = isset($ex[1]) ? "?".$ex[1] : '';
		if(is_file(base_app.$file)){
			return base_url.$file.$ts;
		}else{
			return base_url.'dist/img/no-image-available.png';
		}
	}else{
		return base_url.'dist/img/no-image-available.png';
	}
}
function format_num($number = '' , $decimal = ''){
    if(is_numeric($number)){
        $ex = explode(".",$number);
        $decLen = isset($ex[1]) ? strlen($ex[1]) : 0;
        if(is_numeric($decimal)){
            return number_format($number,$decimal);
        }else{
            return number_format($number,$decLen);
        }
    }else{
        return "Invalid Input";
    }
}
// Next document code for 'gst', 'nongst' or 'quotation', based on the Settings > Document Numbering options.
// The running number continues per type even when the prefix changes; the starting number can force a jump.
function doc_code_settings($kind){
	global $_settings;
	$defaults = array(
		'gst'       => array('gst_code',    'INV-26-27/', 4),
		'nongst'    => array('nongst_code', 'MS-',        4),
		'quotation' => array('quo_code',    'Quo-',       3),
		'pur_gst'    => array('pur_gst_code',    'PUR-26-27/', 4),
		'pur_nongst' => array('pur_nongst_code', 'PMS-',       4),
	);
	list($key, $def_prefix, $def_digits) = $defaults[$kind];
	$prefix = $_settings->info($key.'_prefix');
	return array(
		'key'    => $key,
		'prefix' => $prefix !== false ? html_entity_decode($prefix, ENT_QUOTES | ENT_HTML5) : $def_prefix,
		'digits' => max(1, (int)($_settings->info($key.'_digits') ?: $def_digits)),
		'start'  => max(1, (int)($_settings->info($key.'_start') ?: 1)),
	);
}
function doc_code_table($kind){
	if($kind == 'quotation') return 'quotation_list';
	if(in_array($kind, array('pur_gst','pur_nongst'))) return 'purchase_list';
	return 'transaction_list';
}
// Highest running number already used for this type, whatever prefix it was issued with.
function doc_code_last_no($kind){
	global $conn;
	if($kind == 'quotation')
		$sql = "SELECT code FROM `quotation_list`";
	else
		$sql = "SELECT code FROM `".doc_code_table($kind)."` where invoice_type = '".(in_array($kind, array('gst','pur_gst')) ? 'GST' : 'Non-GST')."'";
	$highest = 0;
	$qry = $conn->query($sql);
	while($row = $qry->fetch_assoc()){
		if(preg_match('/(\d+)$/', $row['code'], $m))
			$highest = max($highest, (int)$m[1]);
	}
	return $highest;
}
function next_doc_code($kind){
	global $conn;
	$s = doc_code_settings($kind);
	$prefix = $s['prefix'];
	$digits = $s['digits'];
	$table = doc_code_table($kind);
	$next = max(doc_code_last_no($kind) + 1, $s['start']);
	while(true){
		$code = $prefix.str_pad($next, $digits, '0', STR_PAD_LEFT);
		$esc = $conn->real_escape_string($code);
		if($conn->query("SELECT id FROM `{$table}` where code = '{$esc}'")->num_rows == 0)
			return $code;
		$next++;
	}
}
function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
    }
    //Otherwise return false..  
    return false;
}
ob_end_flush();
?>
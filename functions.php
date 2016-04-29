<?php
	function get_product_name($pid) {
		$sql = mysql_query("SELECT name_p FROM pakej WHERE v_id = '$pid' ") or die (mysql_error());
		$row = mysql_fetch_array($sql);
		return $row['name_p'];
	}

	function get_price($pid) {
		$sql = mysql_query("SELECT harga FROM pakej WHERE v_id = '$pid' ") or die (mysql_error());
		$row = mysql_fetch_array($sql);
		return $row['harga'];
	}

	function get_vendor_name($pid) {
		$sql = mysql_query("SELECT companyName FROM vendor WHERE v_id = '$pid' ") or die (mysql_error());
		$row = mysql_fetch_array($sql);
		return $row['companyName'];
	}

	function get_total() {
		$max = count($_SESSION['cart']);
		$total = 0;
		for ($i=0; $i<$max; $i++) {
			$pid = $_SESSION['cart'][$i]['pakejid'];
			$price = get_price($pid);
			$sum += $price;
		}
	}

	function addtocart($pid) {
		if ($pid<1) return;

		if(is_array($_SESSION['cart'])) {
			if(product_exists()) return;
			$max = count($_SESSION['cart']);
			$_SESSION['cart'][$max]['pakejid'] = $pid;
		}
		else {
			$_SESSION['cart'] = array();
			$_SESSION['cart'][0]['pakejid'] = $pid;
		}
	}

	function product_exists($pid) {
		$pid = intval($pid);
		$max = count($_SESSION['cart']);
		$flag = 0;
		for($i=0; $i<$max; $i++) {
			if($pid == $_SESSION['cart'][$i]['pakejid']) {
				$flag = 1;
				break;
			}
		}
		return flag;
	}
?>
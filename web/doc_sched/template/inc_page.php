<?php
if (isset($_GET['p']) && $_GET['p'] != '') {
	$p = $_GET['p'];
	if ($p == "sch_calendar") {
		$pages = "page/sch_calendar.php";
	} elseif ($p == "tem_upbody") {
		$pages = "template/tem_upbody.php";
	} elseif ($p == "app_detail") {
		$pages = "page/appiontment_detail.php";
	} elseif ($p == "or_calendar") {
		$pages = "page/or_calendar.php";
	} elseif ($p == "or_detail") {
		$pages = "page/or_detail.php";
	} elseif ($p == "login") {
		$pages = "page/login.php";
	} elseif ($p == "consult_list") {
		$pages = "page/consult_list.php";
	} elseif ($p == "exit") {
		$pages = "page/chk_logout.php";
	} elseif ($p == "surgeon_search") {
		$pages = "page/surgeon_search.php";
	} elseif ($p == "surgeon_calendar") {
		$pages = "page/surgeon_calendar.php";
	} elseif ($p == "surgeon_detail") {
		$pages = "page/surgeon_detail.php";
	} else {
		$pages = "page/error.php";
	}
} else {
	echo '<script>window.location = "?p=login";</script>';
}

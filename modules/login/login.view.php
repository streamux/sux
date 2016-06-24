<?php

class LoginView extends BaseView {

	var $class_name = "login_view";
	var $model = NULL;
	var $controller = NULL;

	function LoginView($m=NULL, $c=NULL) {
		
		$this->model = $m;
		$this->controller = $c;
	}

	function dispLogin($param=NULL) {

		$ljs_memberid = $_SESSION['ljs_memberid'];
		$ljs_pass1 = $_SESSION['ljs_pass1'];

		if (!$ljs_memberid  || !$ljs_pass1) {		
			$this->dispLogon();	
		} else {
			$this->dispLoginInfo();
		}	
	}

	function dispLogon() {

		$strJson = $this->model->getJson();

		//echo $this->GetContentsCurl("skin/default/login.php");
		include "skin/default/login.php";
	}

	function dispLoginInfo() {

		$ljs_member = $_SESSION['ljs_member'];
		$ljs_memberid = $_SESSION['ljs_memberid'];
		$ljs_name = trim($_SESSION['ljs_name']);
		$ljs_hit = $_SESSION['ljs_hit'];
		$ljs_point = $_SESSION['ljs_point'];

		include "skin/default/login.info.php";
	}

	function dispLoginFail() {

		$strJson = $this->model->getJson();
			
		include "skin/default/login.php";
		include "skin/default/login.fail.php";
	}

	function dispLoginLeave() {

		$ljs_member = $_SESSION['ljs_member'];
		$ljs_memberid = $_SESSION['ljs_memberid'];
		$ljs_name = $_SESSION['ljs_name'];

		include "skin/default/login.leave.php";
	}

	function dispSearchId($param=NULL) {

		$check_name = $param['check_name'];
		$strJson = $this->model->getJson();

		if (isset($check_name) && $check_name){
			include "skin/default/login.searchid_result.php";
		} else {
			include "skin/default/login.searchid.php";
		}

	}

	function dispSearchPwd($param=NULL) {

		$memberid = $param['memberid'];

		if(!$memberid){
			include "skin/default/login.searchpwd.php";
		}else{
			include "skin/default/login.searchpwd_result.php";
		}
	}

	function login() {

		$this->dispLogin();
	}

	function fail() {

		$this->dispLoginFail();
	}

	function leave() {

		$this->dispLoginLeave();
	}

	function loginpass() {
		// 잠시 보류 
	}

	function searchId($params) {

		$this->dispSearchId($params);
	}

	function searchPwd($params) {

		$this->dispSearchPwd($params);
	}

	function logout() {

		unset($_SESSION[ljs_member]);
		unset($_SESSION[ljs_memberid]);
		unset($_SESSION[ljs_pass1]);
		unset($_SESSION[ljs_writer]);
		unset($_SESSION[ljs_nickname]);
		unset($_SESSION[ljs_email]);
		unset($_SESSION[ljs_hit]);
		unset($_SESSION[ljs_point]);
		unset($_SESSION[user]);
		unset($_SESSION[grade]);
		unset($_SESSION[chatip]);
		unset($_SESSION[admin_ok]);

		echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=login'>");
	}

	function GetContentsCurl($url) {

	    $ch = curl_init();
	    
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    
	    $data = curl_exec($ch);
	    curl_close($ch);
	    
	    return $data;
	}
}
?>
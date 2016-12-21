<?php
/**
 * author : streammx@naver.com
 * update date : 2016. 09. 07
 *
 * description : 
 * ----------------------------------------------------------------
 *
 * $navi = New Navi();
 * $navi->passover = 0;			// 게시물 시작 번호 
 * $navi->limit = 10;			// 게시물 노출 개수 
 * $navi->total = 100;			// 게시물 총 개수 
 * $navi->init();
 *
 * $navi->get();					// 속성값 얻기 
 *
 * use $navi's properties like $data.total in smarty's template
 * show sample under code
 *
 * $smarty = new Smarty;
 * $smarty->assign('navi_data', $navi->get());
 * $smarty->display( 'navi_template.tpl' );
 *
 * in 'navi_templete.tpl'
 *
 * {if $navi_data.total > $nowpassover }
 *		<span>Output Numbers</span>
 * {/if}
 *
 * ----------------------------------------------------------------
 * source path : /modules/board/skin/default/_navi.tpl
 *
 */
class Navigator extends Object {

	var $passover = 0;
	var $limit = 10;
	var $total = 1;
	var $page = 1;
	
	var $nextpage = 0;
	var $befopage = 0;
	var $prevpassover = 0;
	var $hanpassoverpage = 0;
	var $newpassover = 0;
	var $nowpage = 0;
	var $nowpageend = 0;
	var $okpage = 'no';
	var $PHP_SELF = '';

	function init() {

		$context = Context::getInstance();
		$result = array();

		$passoverpage = $this->limit * 10;
		if ($this->passover == $passoverpage || $this->passover == 0) {
			$this->page = ceil($this->passover/$passoverpage)+1;
		} else {
			$this->page = ceil($this->passover/$passoverpage);
		}
		
		$this->nextpage = $this->page+1;
		$this->befopage = $this->page-1;
		$this->prevpassover = ($this->befopage * $passoverpage)-$passoverpage; 
		$this->hanpassoverpage = $this->page*$passoverpage;
		$this->newpassover = ($this->nextpage * $passoverpage)-$passoverpage; 
		$this->nowpage = ($this->page*10)-9;
		$this->nowpageend = $this->page*11;

		if ($this->page == 1) {
			$this->okpage ='yes';
		}

		$this->PHP_SELF = $context->getServer('PHP_SELF');
	}

	function get() {		

		$data = array();
		foreach ($this as $key => $value) {
			$data[$key] = $value;
		}
		return $data;
	}
}
?>
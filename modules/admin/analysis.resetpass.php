<?
include "top.php";

$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
?>

	<div class="container">
		<div class="articles ui-edgebox">
			<div class="del">
				<h2 class="blind">접속키워드 초기화 알림</h2>
				<div class="tt">
					<div class="imgbox">
						<span>접속키워드 초기화 알림</span>	
					</div>
				</div>
				<div class="box">
					<ul>
						<li>
							<img src="tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon">
							<span class="title1"><? echo $name ?> 접속키워드를 정말로 초기화 하시겠습니까?</span>
							<input type="hidden" name="id" value=<? echo $id ?>>
						</li>
						<li>
							<span class="title2">다시한번 잘 확인해 주세요.</span>
							<a href="#" data-key="reset" class="button-del"><span>[초기화]</span></a>
							<a href="#" data-key="back" class="button-cancel"><span>[취소]</span></a>		
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript" src="./tpl/js/analysis.resetpass.js"></script>

<? include "bottom.php"; ?>
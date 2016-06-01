<? 
include "top.php";

$table_name = $_REQUEST['table_name'];
?>

	<div class="container">
		<div class="articles ui_edgebox">
			<div class="del">
				<h2 class="blind">회원그룹 삭제 알림</h2>
				<div class="tt">
					<div class="imgbox">
						<span>회원그룹 삭제 알림</span>	
					</div>
				</div>
				<div class="box">
					<ul>
						<li>
							<img src="tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon">
							<span class="title1"><? echo $table_name ?> 회원그룹을 정말로 삭제 하시겠습니까?</span>
							<input type="hidden" name="table_name" value=<? echo $table_name ?>>
						</li>
						<li>
							<span class="title2">다시한번 잘 확인해 주세요.</span>
							<a href="#" data-key="del" class="button_del"><span>[삭제]</span></a>
							<a href="#" data-key="back" class="button_cancel"><span>[취소]</span></a>		
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript" src="./tpl/js/member.groupdelpass.js"></script>

<? include "bottom.php"; ?>
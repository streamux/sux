<? include "top.php"; ?>

<div class="container">	
		<div class="articles ui-edgebox">
			<div class="group-add">
				<h2 class="blind">회원그룹추가</h2>
				<div class="tt">
					<div class="imgbox">
						<span>회원그룹추가</span>
					</div>
				</div>
				<div class="box">
					<form>
					<ul>
						<li>
							<img src="tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
							<span class="text-notice">회원그룹을 생성해야지만 회원을 받으실수 있습니다.</span>			
						</li>
						<li>
							<span>회원그룹 이름</span>
							<input type="text" name="table_name" size="16" maxlength="16">
						</li>
					</ul>
					<input type="submit" name="submit" size="10" value="확 인">
					<input type="button" name="cancel" value="취 소">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="./tpl/js/member.groupadd.js"></script>



<? include "bottom.php"; ?>
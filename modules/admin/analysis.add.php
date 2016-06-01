<? include "top.php"; ?>

<div class="container">	
		<div class="articles ui-edgebox">
			<div class="add">
				<h2 class="blind">접속키워드 추가</h2>
				<div class="tt">
					<div class="imgbox">
						<span>접속키워드 추가</span>
					</div>
				</div>
				<div class="box">
					<form>
					<ul>
						<li>
							<img src="tpl/images/icon_refer.gif" width="30" height="13" align="absmiddle" alt="참고아이콘" class="icon-notice">
						</li>
						<li>
							<span>접속키워드를 생성하면 외부 링크를 통해 사용자 접속경로를 알 수 있습니다.<span>
							<span>예제) http://www.사이트주소.com/gateway.php?keyword=접속키워드<span>

							<span class="text-keyword">접속키워드</span>
							<input type="text" name="keyword" size="16" maxlength="16">
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

<script type="text/javascript" src="./tpl/js/analysis.add.js"></script>


<? include "bottom.php"; ?>
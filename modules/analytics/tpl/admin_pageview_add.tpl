{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 페이지뷰 추가 - StreamUX"}
	<div class="container">	
		<div class="articles ui-edgebox">
			<div class="add">
				<div class="tt">
					<div class="imgbox">
						<h1>페이지뷰 추가</h1>
					</div>
				</div>
				<div class="box">
					<form name="f_pageview_add">
					<ul>
						<li>
							<img src="../admin/tpl/images/icon_refer.gif" width="30" height="13" align="absmiddle" alt="참고아이콘" class="icon-notice">
						</li>
						<li>
							<span>페이지뷰를 생성하면 각 메뉴별 클릭 조회수를 알 수 있습니다.<span>
							<span>예제) http://www.사이트주소.com/gateway.php/페이지명.php?keyword=페이지뷰 키워드<span>

							<span class="text-keyword">페이지뷰키워드</span>
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
{include file="$footerPath"}

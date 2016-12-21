{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="SUX관리자 접속키워드 추가 - StreamUX"}
<div class="articles ui-edgebox">
	<div class="add">
		<div class="tt">
			<div class="imgbox">
				<h1>접속키워드 추가</h1>
			</div>
		</div>
		<div class="box">
			<form action="{$rootPath}analytics-admin/connect-site-add" name="f_connecter_add" method="post">
			<input type="hidden" name="_method" value="insert">
			<ul>
				<li>
					<img src="{$rootPath}modules/admin/tpl/images/icon_refer.gif" width="30" height="13" align="absmiddle" alt="참고아이콘" class="icon-notice">
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
{include file="$footerPath"}

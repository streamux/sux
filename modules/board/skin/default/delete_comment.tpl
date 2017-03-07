{assign var=contentData value=$documentData.contents}
{assign var=boardTitle value=$groupData.board_name}
{assign var=tailData value=$documentData.tails}
{assign var=uri value=$documentData.uri}
{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{assign var=opkeySkinPath value=$skinPathList.opkey}
{assign var=tailSkinPath value=$skinPathList.tail}
{include file="$headerPath" title="$boardTitle :: 게시물 댓글삭제 - StreamUX"}
<div class="article-box ui-edgebox">
	<div class="login">
		<h1 class="title">댓글 삭제 비밀번호 인증</h1>
		<span class="subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>
		<form action="{$uri}/{$documentData.mid}/delete-comment/{$contentData.id}" method="post" name="f_board_tail_delpass">
		<input type="hidden" name="_method" value="delete">
		<input type="hidden" name="category" value="{$documentData.category}">
		<input type="hidden" name="mid" value="{$documentData.mid}">
		<input type="hidden" name="id" value="{$contentData.id}">
		<div class="box ui-edgebox-2px">
			<div class="login-title">
				<img src="{$skinPathList.dir}/images/icon_01.gif" title="">			
				<span class="link-searchinfo">
					<a href="{$rootPath}search-id">아이디</a> | <a href="{$rootPath}search-password">비밀번호 찾기</a>
				</span>
			</div>
			<div class="login-body">
				<div class="panel-info">
					<ul>
						<li><span class="ui-label">이름</span>{$contentData.user_name}</li>
						<li><span class="ui-label"><label for="password">비밀번호</label></span><input type="password" name="password" id="password" maxlength="20"></li>
					</ul>							
				</div>
				<div class="panel-btn">
					<input type="submit" name="btn_confirm" value="삭 제">
					<input type="button" name="btn_cancel" value="취 소" onclick="history.back();">
				</div>
			</div>
		</div>
		</form>
		<div class="panel-notice">
			<dl>
				<dt>주의사항</dt>
				<dd>비밀번호가 노출되지 않도록 세심한 주의를 기울여 주세요.</dd>
			</dl><dl>
				<dt>서비스 이용안내</dt>
				<dd>서비스를 이용하시려면 먼저 로그인을 해주세요.</dd>
			</dl>
		</div>					
	</div>	
</div>
{include file="$footerPath"}
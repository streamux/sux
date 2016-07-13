<link rel="stylesheet" type="text/css" href="<? echo ${skin_dir}; ?>/css/common.css">
<link rel="stylesheet" type="text/css" href="<? echo ${skin_dir}; ?>/css/layout.css">
<script src="../../common/js/jquery.min.js"></script>
<script src="../../common/js/jsux-1.0.0.min.js"></script>
<script src="../../common/js/jsux.min.js"></script>

<div class="container">		
<div class="article-box ui-edgebox">			
	<h2 class="blind">댓글삭제 비밀번호 인증</h2>		
	<div class="login">
		<span class="title">댓글삭제 비밀번호 인증</span>
		<span class="subtitle">SUX 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

		<form action="board_grg.del.php?board_grg=<? echo $board_grg; ?>&id=<? echo $id; ?>&board=<? echo $board; ?>&grgid=<? echo $grgid; ?>&igroup=<? echo $igroup; ?>&passover=<? echo $passover; ?>" method="post" name="musimd" onSubmit="return jsux.fn.checkForm(this);">
		<div class="box ui-edgebox-2px">
			<div class="login-title">
				<img src="tpl/images/icon_01.gif" alt="">
				<span>로그인 아이디 | 비번찾기</span>
			</div>
			<div class="login-body">
				<table summary="로그인을 할 수 있습니다.">
					<caption class="hide">관리자 로그인</caption>
					<tbody>
						<tr>
							<td>아이디</td>
							<td class="ui-panel-id">
								<? echo $m_name; ?><input type="hidden" name="memberid" value="<? echo $m_name; ?>">
							</td>
							<td rowspan="2" class="ui-img-btn"><input type="image" name="imagefield" src="tpl/images/admin_login_bt.gif" alt="로그인버튼" class="login-btn"></td>
						</tr>
						<tr>
							<td>비밀번호</td>
							<td><input type="password" name="pass" maxlength="14" class="input-pwd"></td>	
						</tr>
					</tbody>
				</table>						
			</div>																					
		</div>
		<form>
		<div class="notice">			
			<dl>
				<dt>주의사항</dt>
				<dd>비밀번호가 노출되지 않도록 세심한 주의를 기울여 주세요.</dd>
			</dl>
			<dl>
				<dt>서비스 이용안내</dt>
				<dd>서비스를 이용하시려면 먼저 로그인을 해주세요.</dd>
			</dl>
		</div>					
	</div>	
</div>	

<script type="text/javascript" src="tpl/js/login.js"></script>

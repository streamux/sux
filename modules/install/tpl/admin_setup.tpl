{include file="$skinDir/_header.tpl" title="SUX 설치 : 관리자 기본정보 설정 - StreamUX"}
<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img class="logo" src="tpl/images/logo.png" alt="streamxux">	
		</h1>
	</div>
	<div class="container">
		<form>
		<div class="article-box ui-edgebox">			
			<table summary="관리자 정보를 입력해주세요.">
				<caption>
					<span class="hide">관리자 기본정보 설정입니다.</span>
				</caption>
				<colgroup>
					<col width="40%"></col>
					<col width="60%"></col>
				</colgroup>
				<thead>
					<tr>
						<th colspan="2">
							<span>관리자 기본정보 설정</span>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span>관</span>리자 아이디</td>
						<td><input type="text" name="admin_id"></td>
					</tr>
					<tr>
						<td><span>관</span>리자 비밀번호</td>
						<td><input type="password" name="admin_pwd"></td>
					</tr>
					<tr>
						<td>관리자 이메일</td>
						<td><input type="text" name="admin_email"></td>
					</tr>					
					<tr>
						<td>홈페이지 주소</td>
						<td><input type="text" name="yourhome" size="50"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<input type="submit" value=' 다 음 ' class="btn-submit">
		</form>
	</div>
	<div class="footer">
		{include file="$copyrightPath"}
	</div>
</div>
{include file="$skinDir/_footer.tpl"}

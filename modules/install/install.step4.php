<!DOCTYPE html>
<html>
<head>
	<title>SUX보드 관리자계정 설정하기</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=2.0">
	<link rel="stylesheet" type="text/css" href="tpl/css/common.css">
	<link rel="stylesheet" type="text/css" href="tpl/css/install.css">
</head>
<body>
<div class="wrap">
	<div class="header">
		<div class="util"></div>
		<div class="gnb-box">
			<div class="logo">
				<img class="logo" src="tpl/images/logo.png" alt="streamxux 로고">	
			</div>			
			<div class="gnb">
				
			</div>
		</div>	
	</div>
	<div class="container">
		<form>
		<div class="article-box ui-box-edge">			
			<table summary="관리자 정보를 입력해주세요.">
				<caption>
					<span class="hide">관리자계정 설정</span>
				</caption>
				<colgroup>
					<col width="40%"></col>
					<col width="60%"></col>
				</colgroup>
				<thead>
					<tr>
						<th colspan="2">
							<span>관리자계정 설정</span>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span>관</span>리자 비밀번호</td>
						<td><input type="password" name="admin_pwd"></td>
					</tr>
					<tr>
						<td>관리자 이메일</td>
						<td><input type="text" name="admin_email"></td>
					</tr>
					<tr>
						<td>홈페이지명</td>
						<td><input type="text" name="site_name"></td>
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
		
	</div>
</div>
<div class="ui-panel-msg"></div>

<script src="../../common/js/jquery.min.js"></script>
<script src="../../common/js/jsux.min.js"></script>
<script src="tpl/js/install.step4.default.js"></script>
</body>
</html>

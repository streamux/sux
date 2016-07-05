<!DOCTYPE html>
<html>
<head>
	<title>SUX보드 호스트계정 설정하기</title>
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
		<div class="article-box ui-edgebox">			
			<table summary="데이터베이스 정보를 입력해주세요." class="db_form">
				<caption>
					<span class="hide">데이터베이스 설정</span>
				</caption>
				<colgroup>
					<col width="30%"></col>
					<col width="70%"></col>
				</colgroup>
				<thead>
					<tr>
						<th colspan="2">
							<span>데이터페이스 설정</span>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span>호</span>스트명</td>
						<td><input type="text" name="db_hostname" value="localhost"></td>
					</tr>
					<tr>
						<td><span>사</span>용자계정</td>
						<td><input type="text" name="db_userid"></td>
					</tr>
					<tr>
						<td><span>비</span>밀번호</td>
						<td><input type="password" name="db_password"></td>
					</tr>
					<tr>
						<td><span>D</span>B명</td>
						<td><input type="text" name="db_database"></td>
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
<script src="tpl/js/install.step2.default.js"></script>
</body>
</html>


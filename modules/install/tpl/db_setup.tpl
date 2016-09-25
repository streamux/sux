{include file="$skinDir/_header.tpl" title="SUX 설치 : DB 계정정보 설정 - StreamUX"}
<div class="wrapper">
	<div class="header">
		<div class="util"></div>
		<h1 class="logo">
			<img class="logo" src="tpl/images/logo.png" alt="streamxux">	
		</h1>	
	</div>
	<div class="container">	
		<form name="f_db_setup">	
		<div class="article-box ui-edgebox">			
			<table summary="데이터베이스 정보를 입력해주세요." class="db_form">
				<caption>
					<span class="hide">데이터베이스 계정정보 설정입니다.</span>
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
		{include file="$copyrightPath"}
	</div>
</div>
<div class="ui-panel-msg"></div>
{include file="$skinDir/_footer.tpl"}
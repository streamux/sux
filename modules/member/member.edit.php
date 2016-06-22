<?
include "top.php";

$table_name = $_REQUEST['table_name'];
$memberid = $_REQUEST['memberid'];
$id = $_REQUEST['id'];
?>

<div class="container">	
		<div class="articles ui-edgebox">
			<div class="member-edit">
				<h2 class="blind">회원정보수정</h2>
				<div class="tt">
					<div class="imgbox">
						<span>회원정보수정</span>
					</div>
				</div>
				<div class="box">
					<form>
					<dl>
						<dt>기본정보입력</dt>
						<dd>
							<img src="tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
							<span class="text-notice">발강색으로 표신된 부분은 반드시 입력해주세요.</span>			
						</dd>
					</dl>					
					<table summary="회원정보를 수정하세요.">
						<caption class="blind">회원정보수정</caption>
						<tbody>
							<tr>
								<td>
									<span>회</span>원그룹
									<input type="hidden" name="m_groupname" value=<? echo $table_name?>>
									<input type="hidden" name="m_memberid" value=<? echo $memberid?>>
									<input type="hidden" name="m_id" value=<? echo $id?>>
								</td>
								<td id="table_name" class="view-type-textfield">									
									<!--
									@ jquery templete
									@ name	memberLabel_tmpl
									-->	
								</td>
							</tr>
							<tr>
								<td><span>아</span>이디</td>
								<td id="memberid" class="view-type-textfield">
									<!--
									@ jquery templete
									@ name	memberLabel_tmpl
									-->	
								</td>
							</tr>
							<tr>
								<td><span>비</span>밀번호</td>
								<td><input type="password" name="pwd1" size="10" maxlength="12"></td>
							</tr>
							<tr>
								<td><span>비</span>밀번호 확인</td>
								<td><input type="password" name="pwd2" size="10" maxlength="12"></td>
							</tr>
							<tr>
								<td><span>이</span>름</td>
								<td><input type="text" name="name" size="8" maxlength="10" value=""></td>
							</tr>
							<tr>
								<td><span>이</span>메일</td>
								<td><input type="text" name="email" size="12" maxlength="20">
								<select name="email_tail1">
									<option>직접입력</option>
									<option value="naver.com">naver.com</option>
									<option value="hanmail.com">hanmail.net</option>
									<option value="gmail.com">gmail.com</option>
								</select>
								<input type="text" name="email_tail2" size="12" maxlength="20" value=""> <span>[ 비밀번호 분실 시 사용됩니다. ]</span></td>
							</tr>
							<tr>
								<td><span>휴</span>대폰번호</td>
								<td>
									<input type="text" name="hp1" size="3" maxlength="3" value="">-
									<input type="text" name="hp2" size="4" maxlength="4" value="">-
									<input type="text" name="hp3" size="4" maxlength="4" value="">
								</td>
							</tr>
							<tr>
								<td>전화번호</td>
								<td>
									<input type="text" name="tel1" size="3" maxlength="3" value="">-
									<input type="text" name="tel2" size="4" maxlength="4" value="">-
									<input type="text" name="tel3" size="4" maxlength="4" value="">
								</td>
							</tr>							
							<tr>
								<td>회사이름</td>
								<td>
									<input type="text" name="companyname" size="12" maxlength="16" value="">
								</td>
							</tr>
						</tbody>
					</table>
					<dl>
						<dt>기타정보입력</dt>
						<dd>
							<img src="tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
							<span class="text-notice">추가 정보를 입력해주세요.</span>			
						</dd>
					</dl>	
					<table summary="기타 회원정보를 수정하세요.">
						<caption class="blind">회원정보수정</caption>
						<tbody>
							<tr>
								<td>직업</td>
								<td>
									<select name=job>
										<option value="">선택하기</option>
										<option value=프리랜서>프리랜서</option>
										<option value=교수>교수</option>
										<option value=교사>교사</option>
										<option value=학생>학생</option>
										<option value=기업인>기업인</option>
										<option value=회사원>회사원</option>
										<option value=정치인>정치인</option>
										<option value=주부>주부</option>
										<option value=농어업>농어업</option>
										<option value=기타>기타</option>
								</select>
								</td>
							</tr>
							<tr>
								<td>취미</td>
								<td>
									<input type="checkbox" name="hobby" value="인터넷"><span>인터넷</span>
									<input type="checkbox" name="hobby" value="독서" ><span>독서</span>
									<input type="checkbox" name="hobby" value="여행" ><span>여행</span>
									<input type="checkbox" name="hobby" value="낚시" ><span>낚시</span>
									<input type="checkbox" name="hobby" value="바둑" ><span>바둑</span>
									<input type="checkbox" name="hobby" value="기타" ><span>기타</span>
								</td>
							</tr>
							<tr>
								<td>가입경로</td>
								<td>
									<select name="path">
										<option value="">선택하기</option>
										<option value=네이버검색>키워드검색</option>
										<option value=다음카페>네이버지식인</option>
										<option value=다음카페>다음카페</option>
										<option value=다음카페>학교소개</option>
										<option value=주변소개>친구소개</option>
										<option value=다음카페>차량광고</option>
										<option value=기타>기타</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>추천아이디</td>
								<td>
									<input type="text" name="proposeid" size="12" maxlength="20" value="">
								</td>
							</tr>
							<tr>
								<td>가입날자</td>
								<td id="date" class="view-type-textfield">
									<!--
									@ jquery templete
									@ name	memberLabel_tmpl
									-->	
								</td>
							</tr>
							<tr>
								<td>쓰기허용</td>
								<td>
									<select name="writer">
										<option>yes</option>
										<option>no</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>포인트</td>
								<td>
									<input type="text" name="point" size="6" maxlength="5" value="">
								</td>
							</tr>
							<tr>
								<td>레벨</td>
								<td>
									<input type="text" name="grade" size="3" maxlength="2" value="">
								</td>
							</tr>							
							<tr>
								<td>IP</td>
								<td id="ip" class="view-type-textfield">
									<!--
									@ jquery templete
									@ name	memberLabel_tmpl
									-->		
								</td>
							</tr>
						</tbody>
					</table>
					<input type="submit" name="submit" size="10" value="수 정">
					<input type="button" name="cancel" value="취 소">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="jquery-templete" id="memberLabel_tmpl">
	<span>${label}</span>
</script>

<script type="text/javascript" src="./tpl/js/member.edit.js"></script>

<? include "bottom.php"; ?>
{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="회원가입 - StreamUX"}
<div class="articles">
	<div class="member-edit">
		<div class="tt">
			<div class="imgbox">
				<h1>회원가입</h1>
			</div>
		</div>
		<div class="box">
			<form name="f_member_join" action="{$rootPath}member-join" method="post">
			<input type="hidden" name="_method" value="insert">
			<dl>
				<dt>
					<h2>기본정보입력</h2>
				</dt>
				<dd>
					<img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon_notice">
					<span class="text-notice">발강색으로 표신된 부분은 반드시 입력해주세요.</span>
				</dd>
			</dl>
			<table summary="회원정보를 수정하세요.">
				<caption class="blind">회원정보수정</caption>
				<tbody>
					<tr>
						<td>회원그룹</td>
						<td>
							<select name="category" id="memberGroup">
								{foreach from=$documentData.group item=value}
									<option>{$value['category']}</option>
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td>아이디</td>
						<td>
							<input type="text" name="user_id" size="12" maxlength="12" value="">
							<input type="button" name="checkID" value='중복체크'>
						</td>
					</tr>
					<tr>
						<td>비밀번호</td>
						<td><input type="password" name="password" size="10" maxlength="12" value=""></td>
					</tr>
					<tr>
						<td>비밀번호 확인</td>
						<td><input type="password" name="passwordConf" size="10" maxlength="12" value=""></td>
					</tr>
					<tr>
						<td>이름</td>
						<td><input type="text" name="user_name" size="8" maxlength="10" value=""></td>
					</tr>
					<tr>
						<td>닉네임</td>
						<td><input type="text" name="nick_name" size="8" maxlength="10" value=""></td>
					</tr>
					<tr>
						<td>이메일</td>
						<td><input type="text" name="email_address" size="12" maxlength="20" value="">
						<select name="email_tail1">
							<option>직접입력</option>
							<option value="naver.com">naver.com</option>
							<option value="hanmail.com">hanmail.net</option>
							<option value="gmail.com">gmail.com</option>
						</select>
						<input type="text" name="email_tail2" size="12" maxlength="20" value=""> 
						<p>[ 비밀번호 분실 시 사용됩니다. ]</p></td>
					</tr>
					<tr>
						<td><span>휴</span>대폰번호</td>
						<td>
							<input type="text" name="hp1" size="3" maxlength="3" value="">-
							<input type="text" name="hp2" size="4" maxlength="4" value="">-
							<input type="text" name="hp3" size="4" maxlength="4" value="">
						</td>
					</tr>
				</tbody>
			</table>
			<dl>
				<dt>
					<h2>기타정보입력</h2>
				</dt>
				<dd>
					<img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">추가 정보를 입력해주세요.</span>			
				</dd>
			</dl>	
			<table summary="기타 회원정보를 수정하세요.">
				<caption class="blind">회원정보수정</caption>
				<tbody>
					<tr>
						<td>직업</td>
						<td>
							<select name="job">
								<option value="">선택하기</option>
								{assign var='jobList' value=['프리랜서','교수','교사','학생','기업인','회사원','정치인','주부','농어업','기타']}
								{foreach from=$jobList item=value}									
									<option value="{$value}" {if $fieldData['job'] === $value} selected {/if}>{$value}</option>
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td>취미</td>
						<td>
							{assign var='hobbyBoxes' value=['인터넷','독서','여행','낚시','바둑','기타']}
							{foreach from=$hobbyBoxes item=mItem name=hobby}
								{assign var=index value=$smarty.foreach.hobby.index}					
								<label for="hobby{$index}"></label>
								<input type="checkbox" id="hobby{$index}" name="hobby{$index}" value="{$mItem}"><span>{$mItem}</span>
							{/foreach}
						</td>
					</tr>
					<tr>
						<td>가입경로</td>
						<td>
							<select name="join_path">
								<option value="">선택하기</option>
								{assign var='pathList' value=['네이버검색','네이버지식인','다음카페','학교소개','친구소개','차량광고','기타']}
								{foreach from=$pathList item=value}									
									<option value="{$value}">{$value}</option>
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td>추천아이디</td>
						<td>
							<input type="text" name="recommend_id" size="12" maxlength="20" value="">
						</td>
					</tr>
				</tbody>
			</table>
			<input type="submit" name="btn_confirm" size="10" value="확 인">
			<input type="button" name="btn_cancel" value="취 소" onclick="location.href='{$rootPath}login'">
			</form>
		</div>
	</div>
</div>
{include file="$footerPath"}
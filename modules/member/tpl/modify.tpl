{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{assign var=fieldData value=$documentData.contents}
{include file="$headerPath" title="회원정보수정 - StreamUX"}
<div class="articles ui-edgebox">
	<div class="member-edit">
		<div class="tt">
			<div class="imgbox">
				<h1>회원정보수정</h1>
			</div>
		</div>
		<div class="box">
			<form name="f_member_modify" action="{$rootPath}member-modify" method="post">
			<input type="hidden" name="_method" value="update">
			<dl>
				<dt>
					<h2>기본정보입력</h2>
				</dt>
				<dd>
					<img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
					<span class="text-notice">발강색으로 표신된 부분은 반드시 입력해주세요.</span>			
				</dd>
			</dl>					
			<table summary="회원정보를 수정하세요.">
				<caption class="blind">회원정보수정</caption>
				<tbody>
					<tr>
						<td>회원그룹</td>
						<td>
							<input type="hidden" name="category" value="{$sessionData.sux_category}">		
							{$sessionData.sux_category}
						</td>
					</tr>
					<tr>
						<td>아이디</td>
						<td>
							<input type="hidden" name="user_id" value="{$sessionData.sux_user_id}">
							{$sessionData.sux_user_id}
						</td>
					</tr>
					<tr>
						<td>비밀번호</td>
						<td><input type="password" name="password" size="10" maxlength="12"></td>
					</tr>
					<tr>
						<td>비밀번호 확인</td>
						<td><input type="password" name="passwordConf" size="10" maxlength="12"></td>
					</tr>
					<tr>
						<td>이름</td>
						<td><input type="text" name="user_name" size="8" maxlength="10" value="{$fieldData['user_name']}"></td>
					</tr>
					<tr>
						<td>닉네임</td>
						<td><input type="text" name="nick_name" size="8" maxlength="10" value="{$fieldData['nick_name']}"></td>
					</tr>
					<tr>
						<td>이메일</td>
						<td><input type="text" name="email_address" size="12" maxlength="20" value="{$fieldData['email']}">
						<select name="email_tail1">
							<option>직접입력</option>
							<option value="naver.com">naver.com</option>
							<option value="hanmail.com">hanmail.net</option>
							<option value="gmail.com">gmail.com</option>
						</select>
						<input type="text" name="email_tail2" size="12" maxlength="20" value="{$fieldData['email_tail2']}"> <span>[ 비밀번호 분실 시 사용됩니다. ]</span></td>
					</tr>
					<tr>
						<td><span>휴</span>대폰번호</td>
						<td>
							<input type="text" name="hp1" size="3" maxlength="3" value="{$fieldData['hp1']}">-
							<input type="text" name="hp2" size="4" maxlength="4" value="{$fieldData['hp2']}">-
							<input type="text" name="hp3" size="4" maxlength="4" value="{$fieldData['hp3']}">
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
								{assign var=isChecked value=''}
								{foreach from=$fieldData['hobby'] item=compareItem}
									{if $mItem === $compareItem}
										{assign var=isChecked value='checked'}
									{/if}
								{/foreach}
								<label for="hobby{$index}"></label>
								<input type="checkbox" id="hobby{$index}" name="hobby{$index}" value="{$mItem}" {$isChecked}><span>{$mItem}</span>
							{/foreach}
						</td>
					</tr>
				</tbody>
			</table>
			<input type="submit" name="submit" size="10" value="확 인">
			<input type="button" name="cancel" value="취 소" onclick="location.href='{$rootPath}login'">
			</form>
		</div>
	</div>
</div>
{include file="$footerPath"}
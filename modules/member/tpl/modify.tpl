<section class="section sx_member">
  <h1>회원정보 수정</h1>
  <form name="f_member_modify" action="{$rootPath}member-modify" method="post" class="sx-form-horizontal">
    <input type="hidden" name="_method" value="update">
    <input type="hidden" name="user_id" value="{$sessionData.user_id}">

    <p class="sx_text_notice">
      <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" class="icon_notice">
      <span>*(별표)는 필수 입력 사항입니다.</span>
    </p> 
    <div class="sx-form-group">
      <label for="userId" class="sx-control-label sx_label_width">아이디</label>        
      <span class="sx-form-control" disabled>{$sessionData.user_id}</span>
    </div>
    <div class="sx-form-group">
      <label for="nickName" class="sx-control-label sx_label_width">닉네임 *</label>
      <input type="text" id="nickName" name="nickname" maxlength="12"  value="{$contentData.nickname}" class="sx-form-control">
    </div>     
    <div class="sx-form-group">
      <label for="userName" class="sx-control-label sx_label_width">이름 *</label>
      <input type="text" name="user_name" id="userName" maxlength="12" value="{$contentData.user_name}" class="sx-form-control">
    </div>
    <div class="sx-form-group">
      <label for="emailAddress" class="sx-control-label sx_label_width">이메일 *</label>
      <input type="text" id="emailAddress" name="email_address" value="{$contentData.email_address}" class="sx-form-control">
    </div>
    <div class="sx-form-group">
      <label for="password" class="sx-control-label sx_label_width">비밀번호 *</label>
      <input type="password" id="password" name="password" maxlength="23" class="sx-form-control">
      <input type="button" name="check_newpassword" value="비밀번호 변경하기" class="sx-btn sx-btn-block">
    </div>
    <div id="panelNewPassword" class="panel_newpassword">
      <div class="sx-form-group">
        <label for="newPassword" class="sx-control-label sx_label_width">신규 비밀번호 *</label>
        <input type="password" id="newPassword" name="new_password" maxlength="23" class="sx-form-control">
      </div>
      <div class="sx-form-group">
        <label for="newPasswordConf" class="sx-control-label sx_label_width">신규 비밀번호 확인 *</label>
        <input type="password" id="newPasswordConf" name="new_password_conf" maxlength="23" class="sx-form-control">
      </div>
    </div>
    <p class="sx_text_notice">
      <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" class="icon_notice">
      <span>아래 내용은 선택사항입니다.</span>
    </p>
    <div class="sx-form-group">
      <label for="hp" class="sx-control-label sx_label_width">휴대폰 번호</label>
      <input type="text" id="hp" name="hp" value="{$contentData.hp}" class="sx-form-control">
    </div>
    <div class="sx-form-group">
      <label for="job" class="sx-control-label sx_label_width">직업</label>
      <select name="job" id="job" class="sx-form-control">               
        <option value="">선택하기</option>
        {assign var='jobList' value=['프리랜서','교수','교사','학생','기업인','회사원','정치인','주부','농어업','기타']}
        {foreach from=$jobList item=value}              
          <option value="{$value}" {if $contentData.job === $value} selected {/if}>{$value}</option>
        {/foreach}
      </select>
    </div>
    <div class="sx-form-inline">
      <label for="emptyName" class="sx-control-label sx_label_width">취미</label>
      <div class="sx-form-group">
        {assign var='hobbyBoxes' value=['인터넷','독서','여행','낚시','바둑','기타']}
        {foreach from=$hobbyBoxes item=mItem name=hobby}
          {assign var=index value=$smarty.foreach.hobby.index}
          {assign var=isChecked value=''}
          {foreach from=$contentData.hobby item=compareItem}
            {if $mItem === $compareItem}
              {assign var=isChecked value='checked'}
            {/if}
          {/foreach}            
          <input type="checkbox" id="hobby{$index}" name="hobby{$index}" value="{$mItem}" {$isChecked}>
          <label for="hobby{$index}" class="sx-text-normal">{$mItem}</label>
        {/foreach}
      </div>        
    </div>     
    <div class="sx-form-inline text-center submit_top_margin">
      <div class="sx-input-group">
        <input type="submit" name="btn_confirm" id="btnConfirm" size="10" value="확 인" class="sx-btn btn_space">
        <input type="button" name="btn_cancel" id="btnCancel" value="취 소" onclick="location.href='{$rootPath}login'"  class="sx-btn">
      </div>        
    </div>
  </form>
</section>
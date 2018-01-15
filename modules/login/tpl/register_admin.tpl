<div class="sx-content">
  <section class="section admin_register sx-edgebox-2px">  
    <h1>관리자 정보 등록</h1>    
    <form action="{$rootPath}register-admin" class="sx-form-horizontal">
      <input type="hidden" name="_method" value="insert">
      <p class="text_notice">
        <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" class="icon_notice" alt="주의">
        <span>*(별표)는 필수 입력 사항입니다.</span>
      </p> 
      <div class="sx-form-group">
        <label for="adminId" class="sx-control-label label_width">아이디*</label>
        <input type="text" name="admin_id" id="adminId" class="sx-form-control" placeholder="아이디" required oninvalid="setCustomValidity('ID is required.')" oninput="setCustomValidity('')"/>
      </div>
      <div class="sx-form-group">
        <label for="adminName" class="sx-control-label label_width">닉네임*</label>
        <input type="text" name="admin_name" id="adminName" class="sx-form-control" placeholder="닉네임" required oninvalid="setCustomValidity('Name is required.')" oninput="setCustomValidity('')"/>
      </div>
      <div class="sx-form-group">
        <label for="adminPwd" class="sx-control-label label_width">비밀번호*</label>
        <input type="password" name="admin_pwd" id="adminPwd" class="sx-form-control" placeholder="비밀번호" required oninvalid="setCustomValidity('Password is required.')" oninput="setCustomValidity('')"/>
      </div>
      <div class="sx-form-group">
        <label for="adminNewpwd" class="sx-control-label label_width">신규 비밀번호*</label>
        <input type="password" name="admin_newpwd" id="adminNewpwd" class="sx-form-control" placeholder="신규 비밀번호" required oninvalid="setCustomValidity('New Password is required.')" oninput="setCustomValidity('')"/>
      </div>
      <div class="sx-form-group">
        <label for="adminNewpwdConf" class="sx-control-label label_width">신규 비밀번호 확인*</label>
        <input type="password" name="admin_newpwd_conf" id="adminNewpwdConf" class="sx-form-control" placeholder="신규 비밀번호 확인" required oninvalid="setCustomValidity('New Password Confirm is required.')" oninput="setCustomValidity('')"/>
      </div>
      <div class="sx-form-group">
        <label for="adminEmail" class="sx-control-label label_width">이메일*</label>
        <input type="text" name="admin_email" id="adminEmail" class="sx-form-control" placeholder="example@streamux.com" required oninvalid="setCustomValidity('Email is required.')" oninput="setCustomValidity('')"/>
      </div>
      <div class="sx-form-group">
        <label for="yourhome" class="sx-control-label label_width">홈페이지 주소*</label>
        <input type="text" name="yourhome" id="yourhome" class="sx-form-control" placeholder="yourhome.com" required oninvalid="setCustomValidity('Your Site Address is required.')" oninput="setCustomValidity('')"/>
      </div>
      <div class="sx-form-inline text-center">
        <div class="sx-input-group">
          <input type="submit" name="btn_confirm" id="btnConfirm" size="10" value="확 인" class="sx-btn sx-space-center">
          <input type="button" name="btn_cancel" id="btnCancel" value="취 소" onclick="location.href='{$rootPath}login-admin'"  class="sx-btn">
        </div>        
      </div>
    </form> 
  </section>
</div>
    <form name="f_setup_admin" action="{$rootPath}setup-admin" method="post">
      <input type="hidden" name="_method" value="insert">
      <div class="terms_box sx-edgebox">
        <h1 class="admin_title">관리자 기본정보 설정</h1>

        <div class="sx-form-group">
          <label for="adminId" class="sx-control-label">관리자 아이디</label>
          <input type="text" id="adminId" name="admin_id" class="sx-form-control" value="" placeholder="ID">
        </div>
        <div class="sx-form-group">
          <label for="adminPwd" class="sx-control-label">관리자 비밀번호</label>
          <input type="password" id="adminPwd" name="admin_pwd" class="sx-form-control" value="" placeholder="Password">
        </div>
        <div class="sx-form-group">
          <label for="adminNickname" class="sx-control-label">닉네임</label>
          <input type="text" id="adminNickname" name="admin_nickname" class="sx-form-control" value="" placeholder="Nickname">
        </div>
        <div class="sx-form-group">
          <label for="adminEmail" class="sx-control-label">이메일</label>
          <input type="text" id="adminEmail" name="admin_email" class="sx-form-control" value="" placeholder="E-Mail">
        </div>
        <div class="sx-form-group">
          <label for="yourhomeUrl" class="sx-control-label">홈페이지 주소</label>
          <input type="text" id="yourhomeUrl" name="yourhome" class="sx-form-control" value="" placeholder="Your Site">
        </div>
      </div>
      <input type="submit" value="다 음"" class="sx-btn">
    </form>
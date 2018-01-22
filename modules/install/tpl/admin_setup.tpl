<div class="sx-wrapper">
  <div class="sx-header">
    <h1 class="logo">
      <img class="logo" src="{$rootPath}modules/install/tpl/images/logo.png" alt="streamxux"> 
    </h1>
  </div>
  <div class="sx-container">
    <form name="f_setup_admin" action="{$rootPath}setup-admin" method="post">
      <input type="hidden" name="_method" value="insert">
      <div class="terms_box sx-edgebox">
        <h1 class="admin_title">관리자 기본정보 설정</h1>

        <div class="sx-form-group">
          <label for="adminId" class="sx-control-label">관리자 아이디</label>
          <input type="text" id="adminId" name="admin_id" class="sx-form-control" value="admin" placeholder="id">
        </div>
        <div class="sx-form-group">
          <label for="adminPwd" class="sx-control-label">관리자 비밀번호</label>
          <input type="password" id="adminPwd" name="admin_pwd" class="sx-form-control" value="1234" placeholder="password">
        </div>
        <div class="sx-form-group">
          <label for="adminNickname" class="sx-control-label">닉네임</label>
          <input type="text" id="adminNickname" name="admin_nickname" class="sx-form-control" value="관리자" placeholder="nickname">
        </div>
        <div class="sx-form-group">
          <label for="adminEmail" class="sx-control-label">이메일</label>
          <input type="text" id="adminEmail" name="admin_email" class="sx-form-control" value="streammx@naver.com" placeholder="e-mail">
        </div>
        <div class="sx-form-group">
          <label for="yourhomeUrl" class="sx-control-label">홈페이지 주소</label>
          <input type="text" id="yourhomeUrl" name="yourhome" class="sx-form-control" value="streamux.com" placeholder="your site url">
        </div>
      </div>
      <input type="submit" value="다 음"" class="sx-btn">
    </form>
  </div>
  <div class="sx-footer">
    {include file="$copyrightPath"}
  </div>
</div>

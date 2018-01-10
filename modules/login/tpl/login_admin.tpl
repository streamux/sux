<section class="section admin_login">
  <header class="header">
    <h1>관리자 로그인</h1>
    <p class="sx_subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</p>
  </header>      
  <div class="sx_contents_box sx-edgebox-2px">        
    <form action="{$rootPath}login-admin" name="f_login_admin" method="post">
      <input type="hidden" name="_method" value="insert">
      <div class="sx-form-group">
        <i class="xi-user xi-2x"></i>
        <label for="userId" class="sx-control-label">아이디</label>
        <input type="text" name="user_id" maxlength="22" value="admin" class="sx-form-control">
      </div>
      <div class="sx-form-group">
        <i class="xi-lock-o xi-2x"></i>
        <label for="userPassword" class="sx-control-label">비밀번호</label>
        <input type="password" name="user_pwd" id="userPassword" maxlength="22" class="sx-form-control">
      </div>
      <!-- 
        @ class 'panel-fail'
        @ 설명 :  초기값 설정은 'login.css' > .panel-fail { display: none; },
                     로그인 실패 시 'common/_header.tpl' > head 태그에 link 경로 'login_fail.css' 파일을 로드해서
                     display:block; 로 설정한다.
       -->
      <div class="fail_panel">
        <p>아이디 또는 비밀번호를 다시 확인하세요.</p>
        <p>STREAMUX에 등록되지 않은 아이디이거나, 아이디 또는 비밀번호를 잘못 입력하셨습니다.</p>
      </div>
      
      <div class="sx-form-group sx_login_btn">
        <input type="submit" name="btn_confirm" value="로그인" class="sx-btn sx-btn-block">
      </div>

      <div class="sx_login_footer">
        <a href="{$rootPath}register-admin" title="관리자 정보 등록">관리자 정보 등록</a>
      </div>  
    </form>         
  </div>
  <footer class="notice_panel">
    <dl>
      <dt>주의사항</dt>
      <dd>비밀번호가 노출되지 않도록 세심한 주의를 기울여 주세요.</dd>
    </dl>
    <dl>
      <dt>서비스 이용안내</dt>
      <dd>서비스를 이용하시려면 먼저 로그인을 해주세요.</dd>
    </dl>
  </footer> 
</section>
<div class="articles">        
  <div class="sx_login">
    <h1>회원 로그인</h1>
    <p class="sx_subtitle">SUX CMS를 이용해 주셔서 진심으로 감사합니다.</p>
    <div class="sx_login_box sx-edgebox-2px">
      <form action="{$rootPath}login" name="f_login" method="post">
        <input type="hidden" name="_method" value="insert">
        
        <div class="sx-form-group">
          <i class="xi-user xi-2x"></i>
          <label for="userId" class="sx-control-label">아이디</label>
          <input type="text" name="user_id" maxlength="22" value="" class="sx-form-control">
        </div>
        <div class="sx-form-group">
          <i class="xi-lock-o xi-2x"></i>
          <label for="userPassword" class="sx-control-label">비밀번호</label>
          <input type="password" name="password" id="userPassword" maxlength="22" value="" class="sx-form-control">
        </div>
        <div class="sx-form-group">          
          <label for="loginKeeper" class="label_login_keeper sx-control-label">
            <input type="checkbox" name="login_keeper" id="loginKeeper" class="input_login_keeper" {if $documentData['loginKeeper']}checked{/if}> 로그인 상태유지
          </label>          
        </div>

        <!-- 
          @ class 'panel-fail'
          @ 설명 :  초기값 설정은 'login.css' > .panel-fail { display: none; },
                       로그인 실패 시 'common/_header.tpl' > head 태그에 link 경로 'login_fail.css' 파일을 로드해서
                       display:block; 로 설정한다.
         -->
         {if $documentData.isLogFail}
        <div class="fail_panel">
          <p>아이디 또는 비밀번호를 다시 확인하세요.</p>
          <p>STREAMUX에 등록되지 않은 아이디이거나, 아이디 또는 비밀번호를 잘못 입력하셨습니다.</p>
        </div>
        {/if}
        
        <div class="sx-form-group sx_btn_group">
          <input type="submit" class="sx-btn sx-btn-block" value="로그인" title="로그인">
        </div>
        <div class="sx_login_footer">
          <a href="{$rootPath}member-join">회원가입</a>
          <span>|</span>
          <a href="{$rootPath}search-id" title="아이디 찾기">아이디</a> / <a href="{$rootPath}search-password" title="비밀번호 찾기">비밀번호 찾기</a>
        </div>  
      </form>                             
    </div>
    <div class="notice_panel">
      <dl>
        <dt>주의사항</dt>
        <dd>비밀번호가 노출되지 않도록 세심한 주의를 기울여 주세요.</dd>
      </dl>
      <dl>
        <dt>서비스 이용안내</dt>
        <dd>서비스를 이용하시려면 먼저 로그인을 해주세요.</dd>
      </dl>
    </div> 
  </div>
</div>

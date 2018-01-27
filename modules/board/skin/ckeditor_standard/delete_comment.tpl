<div class="articles">        
  <div class="sx_login">
    <h1>게시물 삭제 인증</h1>
    <p class="sx_subtitle">SUX CMS를 이용해 주셔서 진심으로 감사합니다.</p>
    <div class="sx_login_box sx-edgebox-2px">
      <form action="{$routeURI}/{$documentData.mid}/delete-comment/{$contentData.id}" method="post" name="f_board_delpass">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="category" value="{$documentData.category}">
        <input type="hidden" name="mid" value="{$documentData.mid}">
        <input type="hidden" name="cid" value="{$contentData.id}">

        <div class="sx-form-group">
          <i class="xi-user xi-2x"></i>
          <label for="userId" class="sx-control-label">작성자</label>
          <div class="sx-form-control">{$contentData.nickname}</div>
          <input type="hidden" name="nickname" maxlength="22" class="{$contentData.nickname}">
        </div>
        <div class="sx-form-group">
          <i class="xi-lock-o xi-2x"></i>
          <label for="userPassword" class="sx-control-label">게시물 비밀번호</label>
          <input type="password" name="password" id="userPassword" maxlength="22" class="sx-form-control">
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
          <div class="sx-input-group text-center">
            <input type="submit" name="btn_submit" value="삭제" class="sx-btn">
            <input type="button" name="btn_cancel" value="취소" onclick="history.back()" class="sx-btn">
          </div>          
        </div>

        <div class="sx_login_footer">
          <a href="{$rootPath}member-join">회원가입</a>
          <span>|</span>
          <a href="{$rootPath}search-id">ID</a>/<a href="{$rootPath}search-password">PW 찾기</a>
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
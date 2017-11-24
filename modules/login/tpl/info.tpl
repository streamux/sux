<div class="articles">
  <div class="sx_login">
    <h1>회원 정보</h1>
    <p class="sx_subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</p>
    <div class="sx_login_box sx-edgebox-2px">
      <div class="sx-form-group">
        <i class="xi-user-o xi-2x"></i>
        <label for="emptyId" class="sx-control-label"><a href="{$rootPath}member-modify">회원정보수정</a> | <a href="{$rootPath}leave">회원탈퇴</a></label>
      </div>
      <div class="sx-form-group">
        <label for="emptyName" class="sx_label_with">닉네임</label><span class="sx_char_colon">:</span><span>'{$sessionData.nick_name}' 님<span>
      </div>
      <div class="sx-form-group">
        <label for="emptyName" class="sx_label_with">적립포인트</label><span class="sx_char_colon">:</span><span>'{$sessionData.point}' Point</span>
      </div>
      <div class="sx-form-group">
        <label for="emptyName" class="sx_label_with">방문횟수</label><span class="sx_char_colon">:</span><span>'{$sessionData.hit_count}' 번째</span>
      </div>
      <div class="sx-form-group sx_login_btn">
        <a href="{$rootPath}logout?_method=insert" class="sx-btn sx-btn-block">로그아웃</a>
      </div>
    </div>
    <div class="notice_panel">
      <dl>
        <dt>주의사항</dt>
        <dd>비밀번호가 노출되지 않도록 세심한 주의를 기울여 주세요.</dd>
      </dl>
    </div>          
  </div>      
</div>

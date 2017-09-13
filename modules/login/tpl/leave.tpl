{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="회원탈퇴 - StreamUX"}
<div class="articles">        
  <div class="sx_login">
    <h1>회원 탈퇴</h1>
    <p class="sx_subtitle">SMX 솔루션을 이용해 주셔서 진심으로 감사합니다.</p>
    <div class="sx_login_box sx-edgebox-2px">
      <form name="f_loginleave" action="{$rootPath}member" method="post">
      <input type="hidden" name="_method" value="delete">
      <input type="hidden" name="category" value="{$sessionData.category}">
      <div class="sx-form-group">
        <i class="xi-info-o xi-2x"></i>
        <label for="emptyId" class="sx-control-label">비밀번호 확인</label>
      </div>
      <div class="sx-form-group">
          <i class="xi-user xi-2x"></i>
          <label for="userId" class="sx-control-label">아이디</label>
          <input type="text" name="user_id" id="userId" maxlength="22" class="sx-form-control" value="{$sessionData.user_id}" disabled>
        </div>
        <div class="sx-form-group">
          <i class="xi-lock xi-2x"></i>
          <label for="userPassword" class="sx-control-label">비밀번호</label>
          <input type="password" name="password" id="userPassword" maxlength="22" class="sx-form-control">
        </div>
        <div class="sx-form-inline text-center submit_top_margin">
          <div class="sx-input-group">
            <input type="submit" name="btn_confirm" value="확 인" class="sx-btn sx-space-right">
            <input type="button" name="btn_cancel" value="취 소" onclick="history.back()" class="sx-btn">
          </div>
        </div>
      </form>
    </div>

    <div class="panel-notice">
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
{include file="$footerPath"}

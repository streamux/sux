{assign var=rootPath value=$skinPathList.root}
{assign var=skinPath value=$skinPathList.path}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="비밀번호 찾기 결과 - StreamUX"}
<div class="articles"> 
  <div class="sx_login">
    <h1>비밀번호 찾기 결과</h1>
    <p class="sx_subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</p>
    
    <div class="sx_login_box sx-edgebox-2px">
      <div class="sx-form-group">
        <i class="xi-info-o xi-2x"></i>
        <label for="emptyId" class="sx-control-label">조회 결과</label>
      </div>
      <div class="sx-form-group">
        <p class="text-center">' {$documentData.user_name} '님의 이메일 주소</p>
        <p class="text-center"><span>' {$documentData.user_email} '</span></p>
        <p class="text-center">(으)로 비밀번호가 발송되었습니다.</p>
      </div>

      <div class="sx-form-group sx_login_btn">
        <input type="button" name="btn_confirm" value="확 인" onclick="location.href='{$rootPath}login'" class="sx-btn sx-btn-block">
      </div>
      <div class="sx_login_footer">
        <a href="{$rootPath}member-join">회원가입</a><span>|</span><a href="{$rootPath}search-id">ID 찾기</a>
      </div>
    </div>
    <div class="panel-notice">
      기타 궁금한 사항이나 질문은 Q&amp;A 게시판을 이용해 주세요.
    </div>
  </div>      
</div>
{include file="$footerPath"}

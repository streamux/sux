    <form name="f_uninstall_db" action="{$rootPath}uninstall" method="post" class="sx-form-horizontal">
      <input type="hidden" name="_method" value="delete"> 
      
      <div class="uninstall_box sx-edgebox">
        <h1>SUX CMS 삭제</h1>
        <fieldset>
          <legend>삭제 범위 설정</legend>          
          <div class="sx-form-group">
            <input type="radio" id="uninstallModeCache" name="uninstall_mode" value="cache" checked="checked">
            <label for="uninstallModeCache" class="sx-control-label">캐시 파일 삭제</label>
          </div>
          <div class="sx-form-group">          
            <input type="radio" id="uninstallModeFile" name="uninstall_mode" value="file">
            <label for="uninstallModeFile" class="sx-control-label">설치 파일 삭제<span>( 데이터 복구 불가능 )</span></label>
          </div>
          <div class="sx-form-group">
            <input type="radio" id="uninstallModeAll" name="uninstall_mode" value="all">
            <label for="uninstallModeAll" class="sx-control-label">설치 파일 + DB 데이터 삭제<span>( 데이터 복구 불가능 )</span></label>
          </div> 
        </fieldset>        
      </div>
      <div class="uninstall_btn_group">
        <input type="submit" name="btn_submit" value='설치 삭제' class="sx-btn">
        <a href="{$rootPath}" name="btn_cancel" class="sx-btn">취소</a>
      </div>
    </form>
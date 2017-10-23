    <div class="sx-contents sx-admin-main">
      <section class="sx-analytics-panel">
        <h1 class="title">접속 키워드 추가</h1>
        <div class="sx-box-content">
          <form action="{$rootPath}analytics-admin/connect-site-add" class="sx-form-horizontal">
            <input type="hidden" name="_method" value="insert">
            <input type="hidden" name="location_back" value="{$rootPath}analytics-admin/connect-site">

            <div class="row title_group">
              <img src="{$rootPath}modules/admin/tpl/images/icon_refer.gif" width="30" height="13" alt="참고" class="icon"> <span class="title1">접속키워드를 생성하면 외부 링크를 통해 사용자 접속경로를 알 수 있습니다.</span><span class="title2">예제) http://your-site/sux/connecter?keyword=접속키워드</span>    
            </div>            
            <div class="sx-form-group">
              <label for="keyword" class="sx-control-label label_width">접속키워드</label>
              <input type="text" name="keyword" id="keyword" size="16" maxlength="16" class="sx-form-control">
            </div>
            <div class="row btn_group text-center">
              <input type="submit" id="btnConfirm" value="확인" class="sx-btn sx-btn-info">
              <a href="#" id="btnCancel" class="sx-btn sx-btn-warning">취소</a>
            </div>        
          </form>
        </div>
      </section>
    </div>
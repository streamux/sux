    <div class="sx-content sx-admin-main">
      <section class="sx-analytics-panel">
        <h1 class="title">페이지 뷰 초기화</h1>
        <div class="sx-box-content">
          <form action="{$rootPath}analytics-admin/pageview-reset">
            <input type="hidden" name="_method" value="update">
            <input type="hidden" name="id" value="{$documentData.id}">
            <input type="hidden" name="keyword" value="{$documentData.name}">  
            <input type="hidden" name="location_back" value="{$rootPath}analytics-admin/pageview">

            <div class="row title_group">
              <img src="{$rootPath}modules/admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon"> <span class="title1">{$documentData.name} 페이지 뷰를 정말로 초기화 하시겠습니까?</span><span class="title2">다시한번 잘 확인해 주세요.</span>    
            </div>
            <div class="row btn_group text-center">
              <input type="submit" id="btnConfirm" value="확인" class="sx-btn sx-btn-info">
              <a href="#" id="btnCancel" class="sx-btn sx-btn-warning">취소</a>
            </div>        
          </form>
        </div>
      </section>
    </div>
    <div class="sx-contents sx-admin-main">
      <section class="sx-popup-panel">
        <h1 class="title">팝업 삭제</h1>
        <div class="sx-box-content">
          <form action="{$rootPath}popup-admin/delete">
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="id" value="{$documentData.id}">
            <input type="hidden" name="popup_name" value="{$documentData.popup_name}">  
            <input type="hidden" name="location_back" value="{$rootPath}popup-admin">

            <div class="row title_group">
              <img src="{$rootPath}modules/admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon"> <span class="title1">{$documentData.popup_name} 팝업을 정말로 삭제 하시겠습니까?</span><span class="title2">다시한번 잘 확인해 주세요.</span>    
            </div>
            <div class="row btn_group text-center">
              <a href="#" id="btnConfirm" class="sx-btn sx-btn-info">확인</a>
              <a href="#" id="cancelBtn" class="sx-btn sx-btn-warning">취소</a>
            </div>        
          </form>
        </div>
      </section>
    </div>
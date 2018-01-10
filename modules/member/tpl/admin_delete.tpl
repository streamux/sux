    <div class="sx-contents sx-admin-main">
      <section class="sx-member-panel">
        <h1 class="title">회원 삭제</h1>
        <div class="sx-box-content">
          <form action="{$rootPath}member-admin/group-delete" name="f_member_delete" method="POST">
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="category" value="{$documentData.category}">
            <input type="hidden" name="id" value="{$documentData.id}">
            <input type="hidden" name="user_id" value="{$documentData.user_id}">
            <input type="hidden" name="location_back" value="{$rootPath}member-admin/{$documentData.category}/list">

            <div class="row title_group">
              <img src="{$rootPath}modules/admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon"> <span class="title1">{$documentData.user_id} 회원을 정말로 삭제 하시겠습니까?</span><span class="title2">다시한번 잘 확인해 주세요.</span>    
            </div>
            <div class="row btn_group text-center">
              <button type="submit" name="btn_confirm" class="sx-btn sx-btn-info">확인</button>
              <a href="#" id="btnCancel" class="sx-btn sx-btn-warning">취소</a>
            </div>        
          </form>
        </div>
      </section>
    </div>
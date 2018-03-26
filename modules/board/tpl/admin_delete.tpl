    <div class="sx-content sx-admin-main">
      <section class="sx-board-panel">
        <h1 class="title">게시글 삭제</h1>
        <div class="sx-box-content">
          <form action="{$rootPath}board-admin/delete" name="f_admin_board_delete" method="POST">
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="title" value="{$documentData.title}">
            <input type="hidden" name="id" value="{$documentData.id}">
            <input type="hidden" name="location_back" value="{$rootPath}board-admin">

            <div class="row title_group">
              <img src="{$rootPath}modules/admin/tpl/images/icon_stop.gif" width="30" height="13" alt="경고아이콘" class="icon">
              <span class="title1">'{$documentData.title}' 글을 정말로 삭제 하시겠습니까? 다시 한번 확인해주세요.</span>
            </div>
            <div class="row btn_group text-center">
              <button type="submit" class="sx-btn sx-btn-info">확인</button>
              <a href="#" id="btnCancel" class="sx-btn sx-btn-warning">취소</a>
            </div>        
          </form>
        </div>
      </section>
    </div>
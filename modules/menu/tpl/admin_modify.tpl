    <div class="sx-contents">
      <section class="sx-menu-modify-panel">
        <h1 class="title">메뉴 정보 수정</h1>
        <div class="sx-box-content">
          <form action="{$rootPath}menu-admin/menu" name="f_menu_modify" method="post" class="sx-form-horizontal">
            <input type="hidden" name="_method" value="update">
            <input type="hidden" name="id" value="{$documentData.contents.id}">
            <input type="hidden" name="category" value="{$documentData.contents.category}">
            <input type="hidden" name="location_back" value="{$rootPath}menu-admin">

            <p class="text_notice">
              <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" class="icon_notice"><span class="sx-text-notice">*(별표)는 필수 입력 사항입니다.</span>
            </p>
            <div class="sx-form-group">
              <label for="emptyLabel" class="sx-control-label label_width">카테고리 이름 *</label>
              <span class="sx-form-control" disabled>{$documentData.contents.category}</span>
            </div>
            <div class="sx-form-group">
              <label for="menuName" class="sx-control-label label_width">메뉴 이름</label>
              <input type="text" id="menuName" name="name" size="20" maxlength="20" value="{$documentData.contents.name}" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="urllink" class="sx-control-label label_width">URL 링크</label>
              <input type="text" id="urllink" name="url" size="25" maxlength="120" value="{$documentData.contents.url}" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="activateState" class="sx-control-label label_width">활성화 상태</label>
              <select id="activateState" name="is_activated" class="sx-form-control">
                {assign var=states value=['On'=>1,'Off'=>0]}
                {foreach $states as $key=>$value}
                <option value="{$value}" {if $documentData.contents.is_activated == $value} selected=selected {/if}>{$key}</option>
                {/foreach}
              </select>
            </div>
            <div class="row btn_group text-center">
              <input type="submit" id="btnConfirm" class="sx-btn" value="확인">
              <a href="#" id="btnCancel" class="sx-btn">취소</a>
            </div> 
          </form>
        </div>
      </section>
    </div>
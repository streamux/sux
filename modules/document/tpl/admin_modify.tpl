    <div class="sx-contents sx-admin-main">
      <section class="sx-document-panel">
        <h1 class="title">페이지 수정</h1>
        <div class="sx-box-content">
          <form action="{$rootPath}document-admin/modify" method="post" class="sx-form-horizontal">
            <input type="hidden" name="_method" value="update">
            <input type="hidden" name="category" value="{$documentData.category}">
            <input type="hidden" name="id" value="{$documentData.id}">
            <input type="hidden" name="modify_info_path" value="{$rootPath}document-admin/modify-json">
            <input type="hidden" name="skin_path" value="{$rootPath}document-admin/skin-resource">
            <input type="hidden" name="location_back" value="{$rootPath}document-admin">

            <p class="text_notice">
              <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" class="icon_notice"><span class="sx-text-notice">*(별표)는 필수 입력 사항입니다.</span>
            </p>
            <div class="sx-form-group">
              <label for="category" class="sx-control-label label_width">*카테고리 이름</label>
              <span class="sx-form-control" disabled>{$documentData.category}</span>
            </div>
            <div class="sx-form-group">
              <label for="documentName" class="sx-control-label label_width">*페이지 이름</label>
              <input type="text" id="documentName" name="document_name" size="20" maxlength="20" value="{$documentData.document_name}" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="summary" class="sx-control-label label_width">페이지 설명</label>
              <input type="text" id="summary" name="summary" size="25" maxlength="50" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="isReadable" class="sx-control-label label_width">읽기 허용</label>
               <select id="isReadable" name="is_readable" class="sx-form-control">
                <option value="y">yes</option>
                <option value="n">no</option>
              </select>
            </div>
            <div class="sx-form-group">
              <label for="documentWidth" class="sx-control-label label_width">페이지 넓이</label>
              <input type="text" id="documentWidth" name="document_width" size="10" maxlength="12" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="documentWidth" class="sx-control-label label_width">상단 경로</label>
              <input type="text" id="header_path" name="header_path" size="25" maxlength="50" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="contentsPath" class="sx-control-label label_width">컨텐츠 템플릿</label>
              <select id="contentsPath" name="contents_path" onchange="jsux.fn.add.loadTemplateContents(this.value);" class="sx-form-control">
                {foreach from=$documentData.skinList key=k item=v}
                <option value="{$v}" {if $v === 'default'} selected {/if}>{$v}</option>
                {/foreach}
              </select>
            </div>
            <div class="sx-form-inline">
              <label for="emptyName" class="sx-control-label label_width">컨텐츠 내용</label>
              <div class="sx-form-group">
                <ul class="sx-nav-tabs">
                  <li class="active"><a href="#" data-target="contents_tpl" alt="템플릿 입력 탭">HTML</a></li>
                  <li><a href="#" data-target="contents_css" alt="CSS 입력 탭">CSS</a></li>
                  <li><a href="#" data-target="contents_js" alt="자바스크립트 입력 탭">JS</a></li>
                </ul>
                <div class="contents_panel">
                  <textarea id="contentsTpl" name="contents_tpl" rows="15" class="sx-form-control"></textarea>
                  <textarea id="contentsCss" name="contents_css" rows="15" class="sx-form-control hide"></textarea>    
                  <textarea id="contentsJs" name="contents_js" rows="15" class="sx-form-control hide"></textarea>
                </div>
                <p class="text_caption">컨텐츠 내용을 입력하세요.</p>
              </div> 
            </div>
            <div class="sx-form-group">
              <label for="footerPath" class="sx-control-label label_width">하단 경로</label>
              <input type="text" id="footerPath" name="footer_path" size="25" maxlength="50" class="sx-form-control">
            </div>
            <div class="row btn_group text-center">
              <input type="submit" id="btnConfirm" class="sx-btn" value="확인">
              <a href="#" id="btnCancel" class="sx-btn">취소</a>
            </div> 
          </form>
        </div>
      </section>
    </div>
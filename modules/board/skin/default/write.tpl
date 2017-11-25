<div class="board_write" style="width:{$groupData.width}">
  <!-- banner start -->
  {include file="$skinRealPath/_board_header.tpl"}
  <!-- end -->

  <form action="{$routeURI}/write" method="post"  name="f_board_write" enctype="multipart/form-data" class="sx-form-horizontal">
    <input type="hidden" name="_method" value="insert">
    <input type="hidden" name="category" id="category" maxlength="20" value="{$documentData.category}">
    
    <div class="head_panel">
      <div class="sx-form-group">
        <label for="userName" class="sx-control-label label_width {$contentData.css_user_label}">이름</label>
        <input type="{$contentData.user_name_type}" name="user_name" id="userName" maxlength="20" value="{$contentData.user_name}" class="sx-form-control">
      </div>
      <div class="sx-form-group">
        <label for="userPassword" class="sx-control-label label_width {$contentData.css_user_label}">비번</label>
        <input type="{$contentData.user_pass_type}" name="password" id="userPassword" maxlength="28" value="{$contentData.user_password}" class="sx-form-control">
      </div>
      <div class="sx-form-group">
        <label for="title" class="sx-control-label label_width">제목</label>
        <input type="text" name="title" id="title" maxlength="72" value="" class="sx-form-control">
      </div>
      <div class="sx-form-group">
        <label for="emailAddress" class="sx-control-label label_width">이메일</label>
        <input type="text" name="email_address" id="emailAddress" maxlength="72" value="" class="sx-form-control">
      </div>
    </div>  
    <div class="body_panel">
      <div class="sx-form-group">
        <label for="contents" class="sx-control-label label_width">내용</label>
        <div class="sx-input-group">
          <input type="radio" name="contents_type" id="radioTypeText" value="text" {$contentData.comment_type_text}><label for="radioTypeText" class="sx-control-label">TEXT</label>
          <input type="radio" name="contents_type" id="radioTypeHtml" value="html" {$contentData.comment_type_html}><label for="radioTypeHtml" class="sx-control-label">HTML</label>
        </div>
        <div class="textarea_panel">
          <textarea name="contents" id="contents" cols="64" rows="14" class="sx-form-control"></textarea>
        </div>      
      </div>    
    </div>
    <div class="foot_panel">
      <div class="sx-form-group">
        <label for="imgUploader" class="sx-control-label label_width">파일 첨부</label>
        <input type="text" id="imgUploader" class="sx-form-control" readonly="readonly" tabindex="-1">      
        <div class="input_file_div button_width">
          <input type="button" value="파일 선택" class="sx-btn file_uploader_button button_width">
          <input type="file" name="imgup" class="sx-btn sx-opacity-0" onchange="javascript:document.getElementById('imgUploader').value = this.value" title="파일 선택 ">
        </div>        
      </div>
      <div class="sx-form-group">
        <label for="wallKey" class="sx-control-label label_width">등록키</label>
        <div class="wall_key">
          <span>{$contentData.wallname}</span>
        </div>
        <input type="text" name="wallname" id="wallKey" size="16" maxlength="20" class="sx-form-control">
        <p class="wall_key_comment">등록키를 입력해주세요.</p>
        <input type="hidden" name="wallok" value="{$contentData.wallname}">
        <input type="hidden" name="wall" value="{$contentData.wallkey}">      
      </div>
      <div class="button_panel sx-form-group">
        <input type="submit" name="btn_confirm" value="확인" class="sx-btn">
        <input type="button" name="btn_cancel" value="취소" onclick="history.back();" class="sx-btn">
      </div>
    </div>
  </form>
</div>
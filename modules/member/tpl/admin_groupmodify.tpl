    <div class="sx-content sx-admin-main">
      <section class="sx-member-panel">
        <h1 class="title">회원그룹정보 수정</h1>
        <div class="sx-box-content">                    
          <form action="{$rootPath}member-admin/group-modify" name="f_group_modify"  method="POST" class="sx-form-horizontal">
            <input type="hidden" name="_method" value="update">
            <input type="hidden" name="id" maxlength="16" value="{$documentData.id}">  
            <input type="hidden" name="category" maxlength="16" value="{$documentData.category}">  
            <input type="hidden" name="modify_info_path" value="{$rootPath}member-admin/group-modify-json">
            <input type="hidden" name="location_back" value="{$rootPath}member-admin">

            <p class="text_notice">
              <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" class="icon_notice"><span class="sx-text-notice">*(별표)는 필수 입력 사항입니다.</span>
            </p>
            <div class="sx-form-group">
              <label for="category" class="sx-control-label label_width">카테고리(영문)</label>
              <span class="sx-form-control" disabled="disabled">{$documentData.category}</span>        
            </div>
            <div class="sx-form-group">
              <label for="groupName" class="sx-control-label label_width">회원 그룹 이름</label>     
              <input type="text" id="groupName" name="group_name" maxlength="16" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="summary" class="sx-control-label label_width">요약 설명</label>
              <input type="text" id="summary" name="summary" maxlength="50" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="headerPath" class="sx-control-label label_width">상단 파일</label>  
              <input type="text" id="headerPath" name="header_path" maxlength="50" value="common/_header.tpl" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="footerPath" class="sx-control-label label_width">하단 파일</label>
              <input type="text" id="footerPath" name="footer_path" maxlength="50" value="common/_footer.tpl" class="sx-form-control">
            </div>

            <div class="row btn_group text-center">
              <input type="submit" id="btnConfirm" class="sx-btn" value="확인">
              <a href="#" id="btnCancel" class="sx-btn">취소</a>
            </div>        
          </form>
        </div>
      </section>
    </div>
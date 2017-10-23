    <div class="sx-contents sx-admin-main">
      <section class="sx-board-panel">
        <h1 class="title">게시판 추가</h1>
        <div class="sx-box-content">                    
          <form action="{$rootPath}board-admin/add" class="sx-form-horizontal">
            <input type="hidden" name="_method" value="insert">
            <input type="hidden" name="groupId_check_url" value="{$rootPath}board-admin/group-checkid">
            <input type="hidden" name="skin_path" value="{$rootPath}board-admin/skin-json">
            <input type="hidden" name="location_back" value="{$rootPath}board-admin">

            <p class="text_notice">
              <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" class="icon_notice"><span class="sx-text-notice">*(별표)는 필수 입력 사항입니다.</span>
            </p>
            <div class="sx-form-group">
              <label for="category" class="sx-control-label label_width">* 카테고리(영문)</label>
              <input type="text" id="category" name="category" size="20" maxlength="20" class="sx-form-control">
              <input type="button" id="checkCategory" name="check_category" value='중복체크' class="sx-btn btn_check">
              <p class="text_caption">※ 반드시 영문으로 작성해주세요.</p>
            </div>
            <div class="sx-form-group">
              <label for="groupName" class="sx-control-label label_width">* 게시판 이름</label>     
              <input type="text" id="board_name" name="board_name" size="20" maxlength="120" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="summary" class="sx-control-label label_width">요약 설명</label>
              <input type="text" id="summary" name="summary" size="25" maxlength="50" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="boardWidth" class="sx-control-label label_width">넓이</label>
              <input type="text" id="boardWidth" name="board_width" size="10" maxlength="12" value="100%" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="headerPath" class="sx-control-label label_width">상단 파일</label>  
              <input type="text" id="headerPath" name="header_path" size="25" maxlength="120" value="common/_header.tpl" class="sx-form-control">
            </div>
            <div class="sx-form-group">
              <label for="skinList" class="sx-control-label label_width">스킨</label>
              <select id="skinList" name="skin_path" class="sx-form-control">
                {foreach from=$documentData.skin_list item=$item}
                  <option>{$item.file_name}</option>
                {/foreach}
              </select>
            </div>
            <div class="sx-form-group">
              <label for="footerPath" class="sx-control-label label_width">하단 파일</label>
              <input type="text" id="footerPath" name="footer_path"  size="25" maxlength="50" value="common/_footer.tpl" class="sx-form-control">
            </div>
            <div class="sx-form-inline">
              <label for="emptyName" class="sx-control-label label_width">사용 가능</label>
              <div class="sx-form-group">
                <label for="isReadable" class="sx-control-label sx-text-normal">읽기</label>
                <select id="isReadable" name="is_readable" class="sx-form-control">
                  <option value="y" selected="selected">yes</option>
                  <option value="n">no</option>
                </select>
                <label for="isWritable" class="sx-control-label sx-text-normal">쓰기</label>
                <select id="isWritable" name="is_writable" class="sx-form-control">
                  <option value="y" selected="selected">yes</option>
                  <option value="n">no</option>
                </select>
                <label for="isModifiable" class="sx-control-label sx-text-normal">수정</label>
                <select id="isModifiable" name="is_modifiable" class="sx-form-control">
                  <option value="y">yes</option>
                  <option value="n" selected="selected">no</option>
                </select>
                <label for="isRepliable" class="sx-control-label sx-text-normal">답글</label>
                <select id="isRepliable" name="is_repliable" class="sx-form-control">
                  <option value="y">yes</option>
                  <option value="n" selected="selected">no</option>
                </select>
              </div>
            </div>
            <div class="sx-form-inline">
              <label for="emptyName" class="sx-control-label label_width">허용 레벨</label>
              <div class="sx-form-group">
                <label for="gradeRead" class="sx-control-label sx-text-normal">읽기</label>
                <select id="gradeRead" name="grade_r" class="sx-form-control">
                  <option value="0" selected="selected">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                </select>
                <label for="gradeWrite" class="sx-control-label sx-text-normal">쓰기</label>
                <select id="gradeWrite" name="grade_w" class="sx-form-control">
                  <option value="0">0</option>
                  <option value="1" selected="selected">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                </select>
                <label for="gradeModify" class="sx-control-label sx-text-normal">수정</label>
                <select id="gradeModify" name="grade_m" class="sx-form-control">
                  <option value="0">0</option>
                  <option value="1" selected="selected">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                </select>
                <label for="gradeReply" class="sx-control-label sx-text-normal">답글</label>
                <select id="gradeReply" name="grade_re" class="sx-form-control">
                  <option value="0">0</option>
                  <option value="1" selected="selected">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                </select>
              </div>
            </div>
            <div class="sx-form-group">
              <label for="allowNonmember" class="sx-control-label label_width">비회원 권한</label>
              <select id="allowNonmember" name="allow_nonmember" class="sx-form-control">
                <option value="y" selected="selected">사용 가능</option>
                <option value="n">사용 불가능</option>
              </select>
            </div>
            <div class="sx-form-group">
              <label for="limitPagination" class="sx-control-lable label_width">목록 글 출력 수</label>
              <input type="text" id="limitPagination" name="limit_pagination" value="10" size="3" maxlength="2" class="sx-form-control">
            </div>
            <div class="sx-form-inline">
              <label for="emptyName" class="sx-control-label label_width">옵션 출력 설정</label>
              <div class="sx-form-group">
                <label for="isComment" class="sx-control-label sx-text-normal">꼬리글</label>
                <select id="isComment" name="is_comment" class="sx-form-control">
                <option value="y" selected>yes</option>                
                  <option value="n">no</option>                  
                </select>
                <label for="isDownload" class="sx-control-label sx-text-normal">다운로드</label>
                <select id="isDownload" name="is_download" class="sx-form-control">                  
                  <option value="y">yes</option>
                  <option value="n" selected="selected">no</option>             
                </select>
                <label for="isProgressStep" class="sx-control-label sx-text-normal">진행상황</label>
                <select id="isProgressStep" name="is_progress_step" class="sx-form-control">                  
                  <option value="y">yes</option>
                  <option value="n" selected="selected">no</option>           
                </select>
              </div>
            </div>
            <div class="sx-form-inline">
              <label for="emptyName" class="sx-control-label label_width">최근 게시물</label>            
              <div class="sx-input-group">
                <input type="radio" id="isLatestYes" name="is_latest" value="yes">
                <label for="isLatestYes" class="sx-control-label sx-text-normal">출력</label>
                <input type="radio" id="isLatestNo" name="is_latest" value="no" checked="checked">
                <label for="isLatestNo" class="sx-control-label sx-text-normal">출력안함</label>
              </div>
            </div>
            <div class="sx-form-inline">
              <label for="emptyName" class="sx-control-label label_width">게시판 형식</label>          
              <div class="sx-input-group">
                <input type="radio" id="boardTypeHtml" name="board_type" value="html">
                <label for="boardTypeHtml" class="sx-control-label sx-text-normal">HTML</label>
                <input type="radio" id="boardTypeTextl" name="board_type" value="text" checked="checked">
                <label for="boardTypeTextl" class="sx-control-label sx-text-normal">TEXT</label>
                <input type="radio" id="boardTypeAll" name="board_type" value="all">
                <label for="boardTypeAll" class="sx-control-label sx-text-normal">HTML + TEXT</label>
              </div>
            </div>
            <div class="sx-form-inline">
              <label for="emptyName" class="sx-control-label label_width">불량 단어 범위</label>
              <div class="sx-input-group">
                <input type="radio" id="limitChoiceTitle" name="limit_choice" value="title" checked="checked">
                <label for="limitChoiceTitle" class="sx-control-label">제목</label>
                <input type="radio" id="limitChoiceComment" name="limit_choice" value="comment">
                <label for="limitChoiceComment" class="sx-control-label">내용</label>
                <input type="radio" id="limitChoiceAll" name="limit_choice" value="all">
                <label for="limitChoiceAll" class="sx-control-label">제목+내용</label>
              </div>
            </div>
            <div class="sx-form-form">
              <label for="limitWord" class="sx-control-label label_width">불량 단어</label>
              <textarea id="limitWord" name="limit_word" cols="25" rows="6" class="sx-form-control">광고, 대출</textarea>
              <p class="text_caption">※ 단어 구분은 반드시 콤마(,)로 해주세요.</p>            
            </div>
            <div class="row btn_group text-center">
              <input type="submit" id="btnConfirm" class="sx-btn" value="확인">
              <a href="#" id="btnCancel" class="sx-btn">취소</a>
            </div>        
          </form>
        </div>
      </section>
    </div>
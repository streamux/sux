<div class="articles ui-edgebox">
  <div class="add">
    <div class="tt">
      <div class="imgbox">
        <h1>게시판생성</h1>
      </div>
    </div>
    <div class="box">
      <form action="{$rootPath}board-admin/add" name="f_board_admin_add" method="post">
      <input type="hidden" name="_method" value="insert">
      <dl>
        <dt>게시판 생성 및 게시판 컨트롤 세부설정</dt>
        <dd>
          <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" width="30" height="13" align="absmiddle" class="icon-notice">
          <span class="text-notice">발강색(별표)으로 표신된 부분은 반드시 입력해주세요.</span>      
        </dd>
      </dl>
      <table summary="게시판 정보를 입력해 생성해주세요.">
        <caption class="blind">게시판 정보 입력</caption>
        <tbody>
          <tr>
            <td><label for="category">*카테고리 이름</label></td>
            <td>
              <input type="text" id="category" name="category" size="20" maxlength="20" value="">
              <input type="button" name="checkID" value='중복체크'>
              <span>※ 반드시 영문으로 작성해주세요.</span>
            </td>
          </tr>
          <tr>
            <td><label for="board_name">*게시판 이름</label></td>
            <td>
              <input type="text" id="board_name" name="board_name" size="20" maxlength="20" value="">
            </td>
          </tr>
          <tr>
            <td><label for="summary">게시판 설명</label></td>
            <td>
              <input type="text" id="summary" name="summary" size="25" maxlength="50" value="다용도 게시판입니다.">
            </td>
          </tr>
          <tr>
            <td><label for="board_width">게시판 넓이</label></td>
            <td>
              <input type="text" id="board_width" name="board_width" size="10" maxlength="12" value="100%">
            </td>
          </tr>
          <tr>
            <td><label for="header_path">상단 경로</label></td>
            <td>
              <input type="text" id="header_path" name="header_path" size="25" maxlength="50" value="common/_header.tpl">
            </td>
          </tr>
          <tr>
            <td>스킨</td>
            <td>
              <select id="skinList" name="skin_path">
                <!--
                @ jquery templete
                @ name skinList_tmpl
                -->
              </select>
            </td>
          </tr>
          <tr>
            <td><label for="footer_path">하단 경로</label></td>
            <td>
              <input type="text" id="footer_path" name="footer_path" size="25" maxlength="50" value="common/_footer.tpl">
            </td>
          </tr>         
          <tr>
            <td>사용가능</td>
            <td>
              <span>읽기</span>
              <select name="is_readable">
                <option value="y">yes</option>
                <option value="n">no</option>
              </select>
              <span>쓰기</span>
              <select name="is_writable">
                <option value="y">yes</option>
                <option value="n">no</option>
              </select>             
              <span>수정</span>
              <select name="is_modifiable">
                <option value="y">yes</option>
                <option value="n">no</option>
              </select>
              <span>답변</span>
              <select name="is_repliable">
                <option value="y">yes</option>
                <option value="n">no</option>
              </select>
              <span>가능:y 제한:n</span>
            </td>
          </tr>
          <tr>
            <td>허용레벨</td>
            <td>
              <span>읽기</span>
              <select name="grade_r">
                <option>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>
              <span>쓰기</span>
              <select name="grade_w">
                <option>0</option>
                <option selected="select">1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>             
              <span>수정</span>
              <select name="grade_m">
                <option>0</option>
                <option selected="select">1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>
              <span>답변</span>
              <select name="grade_re">
                <option>0</option>
                <option selected="select">1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>비회원 권한</td>
            <td>
              <select name="allow_nonmember">
                <option value="y">yes</option>
                <option value="n">no</option>
              </select>
              <span>가능 : yes / 제한 : no</span>
            </td>
          </tr>       
          <tr>
            <td>글목록 수</td>
            <td>
              <input type="text" name="limit_pagination" value="10" size="3" maxlength="2">
              <span>※ 게시판 리스트에 출력할 글목록 수를 설정해주세요.</span>
            </td>
          </tr>
          <tr>
            <td>기타옵션 출력</td>
            <td>
              <span>꼬리글</span>
              <select name="is_comment">
                <option value="n">no</option>
                <option value="y">yes</option>                
              </select>
              <span>다운로드</span>
              <select name="is_download">
                <option value="n">no</option>
                <option value="y">yes</option>                
              </select>
              <span>진행상황</span>
              <select name="is_progress_step">
                <option value="n">no</option>
                <option value="y">yes</option>                
              </select>
            </td>
          </tr>
          <tr>
            <td>최근게시물</td>
            <td>
              <input type="radio" name="is_latest" value="yes">
              <span>출력</span>
              <input type="radio" name="is_latest" value="no" checked>
              <span>출력안함</span>
            </td>
          </tr>
          <tr>
            <td>게시판형식</td>
            <td>
              <input type="radio" id="board_type_html" name="board_type" value="html">
              <span><label for="board_type_html">HTML</label></span>
              <input type="radio" id="board_type_textl" name="board_type" value="text">
              <span><label for="board_type_textl">TEXT</label></span>
              <input type="radio" id="board_type_all" name="board_type" value="all" checked>
              <span><label for="board_type_all">HTML + TEXT</label></span>
            </td>
          </tr>
          <tr>
            <td>불량단어 범위</td>
            <td>                  
              <input type="radio" id="limit_choice_title" name="limit_choice" value="title" checked>
              <span><label for="limit_choice_title">제목</label></span>                 
              <input type="radio" id="limit_choice_comment" name="limit_choice" value="comment">
              <span><label for="limit_choice_comment">내용</label></span>                 
              <input type="radio" id="limit_choice_all" name="limit_choice" value="all">
              <span><label for="limit_choice_all">제목+내용</label></span>
            </td>
          </tr>
          <tr>
            <td>불량단어</td>
            <td>
              <textarea name="limit_word" cols="25" rows="6">광고, 대출</textarea>
              <span>※ 단어 구분은 반드시 콤마(,)로 해주세요.</span>
            </td>
          </tr>
        </tbody>
      </table>          
      <input type="submit" name="submit" size="10" value="확 인">
      <input type="button" name="cancel" value="취 소">
      </form>
    </div>
  </div>
</div>
<script type="jquery-templete" id="skinList_tmpl">
{literal}
  <option>${file_name}</option>
{/literal}
</script>
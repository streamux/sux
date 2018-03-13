    <div class="sx-content">
      <h1 class="title">대시보드</h1>
      <section class="section connect">
        <h2>방문자 수</h2>       
        <div class="sx-box-content sx-connect-count">   
          <ul class="connecter">            
            <li>
              <span class="sx-label sx-label-warning">어제</span>
              <span id="real_yester" class="view-type-textfield">0</span>
            </li>
            <li>
              <span class="sx-label sx-label-info">오늘</span>
              <span id="real_today" class="view-type-textfield">0</span>
            </li>
            <li>
              <span class="sx-label sx-label-default">전체</span>
              <span id="real_total" class="view-type-textfield">0</span>
            </li>
          </ul>
        </div>
      </section>
      
      <div class="content_container1">
        <section class="section service">
          <h2>사이트 현황</h2>
          <div class="sx-service-config sx-edgebox">
            <ul>
              <li class="member_count">
                <a href="{$rootPath}member-admin/list">
                  <span class="xi_icon xi-users" aria-hidden="true"></span> 회원 <span id="memberNum" class="sx-badge view-type-textfield">0</span>
                </a>
              </li>
              <li class="board_count">
                <a href="{$rootPath}board-admin/list">
                  <span class="xi_icon xi-comment" aria-hidden="true"></span> 글 <span id="boardNum" class="sx-badge view-type-textfield">0</span>
                </a>
              </li>
              <li class="page_count">
                <a href="{$rootPath}document-admin">
                  <span class="xi_icon xi-library-books" aria-hidden="true"></span> 페이지 <span id="documentNum" class="sx-badge view-type-textfield">0</span>
                </a>
              </li>
              <li class="board_group_count">
                <a href="{$rootPath}board-admin/group-list">
                  <span class="xi_icon xi-forum" aria-hidden="true"></span> 게시판 <span id="boardGoupNum" class="sx-badge view-type-textfield">0</span>
                </a>
              </li>
            </ul>         
          </div>
        </section>

        <section class="section event_news">
          <h2>스트림유엑스 소식</h2>
          <article class="article sx-edgebox">
            <ul id="eventNewsList" class="event_news_list">
              <li class="loading_msg">데이타 로딩중...</li>
            </ul>
          </article>
        </section>
      </div>

      <div class="content_container2"> 
        <section class="section board">
          <h2>최근 게시물</h2>
          <article class="article sx-board-latest sx-edgebox">
            <table class="table" summary="최근 게시물 정보를 제공합니다.">
              <caption class="sr-only">최근 게시물</caption>
              <thead>
                <tr>
                  <th class="sx_title">제목</th>
                  <th class="sx_date">날짜</th>
                </tr>         
              </thead>
              <tbody id="latestCommentList">
                <tr>
                  <td colspan="3">데이타 로딩중...</td>
                </tr>
                <!--
                @ jquery templete
                @ name  hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
                -->
              </tbody>
            </table>
            <nav class="nav pagin_comment sx-pagination-group">
              <a href="#none" class="sx-nav-prev sx-pagination-control unactive">이전</a>
              <span id="latestCommentPaginList">
                <a href="#" class="sx-pagination unactive">1</a>
              </span>
              <a href="#none" class="sx-nav-next sx-pagination-control unactive">다음</a>
            </nav>
          </article>
        </section>

        <section class="section member">
          <h2>신규 회원가입</h2>
          <article class="article sx-newmember sx-edgebox">
              <table class="table" summary="신규회원 가입 정보를 제공합니다.">
              <caption class="sr-only">신규 회원가입</caption>
                <thead>
                  <tr>
                    <th class="sx_name">닉네임</th>
                    <th class="sx_date">가입일</th>
                  </tr>         
                </thead>
                <tbody id="newMemberList">
                  <tr>
                    <td colspan="3">데이타 로딩중...</td>
                  </tr>
                  <!--
                  @ jquery templete
                  @ name  hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
                  -->
                </tbody>
              </table>
              <nav class="nav pagin_member sx-pagination-group">
                <a href="#none" class="sx-nav-prev sx-pagination-control unactive">이전</a>
                <span id="memberPaginList">
                  <a href="#" class="sx-pagination unactive">1</a>
                </span>
                <a href="#none" class="sx-nav-next sx-pagination-control unactive">다음</a>
              </nav>
          </article>
        </section>        
      </div>
    </div>

<script type="text/jquery-templete" id="textfield_tmpl">
{literal}
  <span>${$item.getUnit( label )}</span>
{/literal}
</script>

<script type="text/jquery-templete" id="tableWarnMsg_tmpl">
{literal}
  <tr>
    <td colspan="2" class="sx-text-warning">${msg}</td>
  </tr>
{/literal}
</script>

<script type="text/jquery-templete" id="ulWarnMsg_tmpl">
{literal}
  <li class="sx-text-warning">${msg}</li>
{/literal}
</script>

<script type="text/jquery-templete" id="newMemberList_tmpl">
{literal}
  <tr>
    <td class="sx_name">${nickname}</td>
    <td class="sx_date">${date}</td>
  </tr>
{/literal}
</script>

<script type="text/jquery-templete" id="latestCommentList_tmpl">
{literal}
  <tr>
    <td class="sx_name">${title}</td>
    <td class="sx_date">${date}</td>
  </tr>
{/literal}
</script>

<script type="text/jquery-templete" id="eventNewsList_tmpl">
{literal}
  <li class="news"><a href="${url}" target="_blank">${title} - ${date}</a></li>
{/literal}
</script>

<script type="text/jquery-templete" id="pagination_tmpl">
{literal}
  <a href="#" class="sx-pagination">${no}</a>
{/literal}
</script>
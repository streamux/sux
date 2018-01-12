    <div class="sx-content">
      <h1 class="title">대시보드</h1>
      <section class="connect">
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
      <section class="member">
        <h2>신규 회원가입</h2>
        <article class="sx-newmember sx-edgebox">
            <table class="table" summary="신규회원 가입 정보를 제공합니다.">
            <caption class="sr-only">신규 회원가입</caption>
              <thead>
                <tr>
                  <th class="sx_name">닉네임</th>
                  <th class="sx_email">이메일</th>
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
            <nav class="pagin_member sx-pagination-group">
              <a href="#none" class="sx-nav-prev sx-pagination-control unactive">이전</a>
              <span id="memberPaginList">
                <a href="#" class="sx-pagination unactive">1</a>
              </span>
              <a href="#none" class="sx-nav-next sx-pagination-control unactive">다음</a>
            </nav>
        </article>
      </section>
      <section class="board">
        <h2>최근 게시물</h2>
        <article class="sx-board-latest sx-edgebox">
          <table class="table" summary="최근 게시물 정보를 제공합니다.">
            <caption class="sr-only">신규 회원가입</caption>
            <thead>
              <tr>
                <th class="sx_name">작성자</th>
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
          <nav class="pagin_comment sx-pagination-group">
            <a href="#none" class="sx-nav-prev sx-pagination-control unactive">이전</a>
            <span id="latestCommentPaginList">
              <a href="#" class="sx-pagination unactive">1</a>
            </span>
            <a href="#none" class="sx-nav-next sx-pagination-control unactive">다음</a>
          </nav>
        </article>
      </section>

      <section class="pageview">
        <h2>페이지 뷰</h2>
        <article class="sx-pageview sx-edgebox">
          <table class="table" summary="페이지 별 클릭 수 정보를 제공합니다.">
          <caption class="sr-only">페이지 별 클릭 수</caption>
            <thead>
              <tr>
                <th class="sx_no">번호</th>
                <th class="sx_name">페이지 이름</th>
                <th class="sx_hit">클릭수</th>
              </tr>         
            </thead>
            <tbody id="pageviewHitList">
              <tr>
                <td colspan="3">데이타 로딩중...</td>
              </tr>           
              <!--
              @ jquery templete
              @ name  hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
              @ <tr>
                    <td class="sx_no"></td>
                    <td class="sx_name"></td>
                    <td class="sx_hit"></td>
                  </tr>
              -->
            </tbody>
          </table>
          <nav class="pagin_pageview sx-pagination-group">
            <a href="#none" class="sx-nav-prev sx-pagination-control unactive">이전</a>
            <span id="pageviewPaginList">
              <a href="#" class="sx-pagination unactive">1</a>
            </span>
            <a href="#none" class="sx-nav-next sx-pagination-control unactive">다음</a>
          </nav>
        </article>
      </section>
      <section class="connect-path">
        <h2>접속 경로</h2>
        <article class="sx-connect-path sx-edgebox">
          <table class="table" summary="접속경로 정보를 제공합니다.">
            <caption class="sr-only">접속경로분석</caption>
            <thead>
              <tr>
                <th class="sx_no">번호</th>
                <th class="sx_name">접속키워드</th>
                <th class="sx_hit">클릭수</th>
              </tr>         
            </thead>
            <tbody id="connectPathList">
              <tr>
                <td colspan="3">데이타 로딩중...</td>
              </tr>
              <!--
              @ jquery templete
              @ name  hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
              -->
            </tbody>
          </table>
          <nav class="pagin_connect_path sx-pagination-group">
            <a href="#none" class="sx-nav-prev sx-pagination-control unactive">이전</a>
            <span id="connectPathPaginList">
              <a href="#" class="sx-pagination unactive">1</a>
            </span>            
            <a href="#none" class="sx-nav-next sx-pagination-control unactive">다음</a>
          </nav>
        </article>
      </section>
      <section class="service">
        <h2>서비스 설정</h2>
        <div class="sx-service-config sx-edgebox">
          <ul class="clearfix">
            <li>
              <span class="service_label">회원 그룹<span id="memberGroupNum" class="sx-badge view-type-textfield">0</span></span>
              <span class="sx-label sx-label-default view-type-icon">off</span>
            </li>
            <li>
              <span class="service_label">게시판<span id="boardNum" class="sx-badge view-type-textfield">0</span></span>
              <span class="sx-label sx-label-default view-type-icon">off</span>
            </li>
            <li>
              <span class="service_label">팝업<span id="popupNum" class="sx-badge view-type-textfield">0</span></span>
              <span class="sx-label sx-label-default view-type-icon">off</span>
            </li>
            <li>
              <span class="service_label">접속 키워드<span id="analysisNum" class="sx-badge view-type-textfield">0</span></span>
              <span class="sx-label sx-label-default view-type-icon">off</span>
            </li>
            <li>
              <span class="service_label">페이지 뷰<span id="pageviewNum" class="sx-badge view-type-textfield">0</span></span>
              <span class="sx-label sx-label-default view-type-icon">off</span>
            </li>
          </ul>         
        </div>
      </section>
    </div>

<script type="x-jquery-templete" id="textfield_tmpl">
{literal}
  <span>${$item.getUnit( label )}</span>
{/literal}
</script>
<script type="x-jquery-templete" id="warnMsg_tmpl">
{literal}
  <tr>
    <td colspan="3"><span class="sx-text-warning">${msg}</span></td>
  </tr>
{/literal}
</script>
<script type="x-jquery-templete" id="newMemberList_tmpl">
{literal}
  <tr>
    <td class="sx_name">${nick_name}</td>
    <td class="sx_email">${email_address}</td>
    <td class="sx_date">${date}</td>
  </tr>
{/literal}
</script>
<script type="x-jquery-templete" id="latestCommentList_tmpl">
{literal}
  <tr>
    <td class="sx_no">${no}</td>
    <td class="sx_name">${title}</td>
    <td class="sx_date">${date}</td>
  </tr>
{/literal}
</script>
<script type="x-jquery-templete" id="hitAnalyticsList_tmpl">
{literal}
  <tr>
    <td class="sx_no">${no}</td>
    <td class="sx_name">${name}</td>
    <td class="sx_hit">${hit}회</td>
  </tr>
{/literal}
</script>
<script type="x-jquery-templete" id="pagination_tmpl">
{literal}
  <a href="#" class="sx-pagination">${no}</a>
{/literal}
</script>
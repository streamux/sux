    <div class="sx-content sx-admin-main">
      <section class="sx-connectsite-panel">
        <header class="header">
          <h1 class="title">접속 관리</h1>
          <div class="sx-row clearfix">
            <span class="search_title">전체 키워드(0)</span>     
            <a href="{$rootPath}analytics-admin/connect-site-add" class="sx-btn pull-right" title="키워드 추가">키워드 추가</a>
          </div>
        </header>
        <article class="sx-box-content">
          <input type="hidden" name="list_json_path" value="{$rootPath}analytics-admin/connect-site-list-json">
          
          <ul class="list_mobile_panel" id="dataMobileList">
            <!--
              @ jquery templete
              @ name  warnMsgMobileTmpl, dataListMobileTmpl
            -->
            <li>
              <a href="#">
                <span class="summary">로딩 중...</span>
              </a>     
            </li>
          </ul>
          <div class="list_pc_panel">
            <table class="table" summary="접속 키워드 정보를 제공합니다.">
              <caption class="sr-only">접속 키워드 목록</caption>
              <thead>
                <tr>
                  <th class="sx_no">번호</th>
                  <th class="sx_name">키워드</th>
                  <th class="sx_hit">방문 횟수</th>
                  <th class="sx_date">등록일</th>
                  <th class="sx_modify_btn">수정</th>
                  <th class="sx_delete_btn">삭제</th>
                </tr>         
              </thead>
              <tbody id="dataList">
                <tr>
                  <td colspan="6">데이타 로딩중...</td>
                </tr>
                <!--
                @ jquery templete
                @ name  hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
                -->
              </tbody>
            </table>
          </div>
          <nav class="sx-pagination-group">
            <a href="#none" class="sx-nav-prev sx-pagination-control unactive">이전</a>
            <span id="paginList">
              <a href="#" class="sx-pagination unactive">1</a>
            </span>
            <a href="#none" class="sx-nav-next sx-pagination-control unactive">다음</a>
          </nav>
        </article>
      </section>
    </div>

<!-- pc start -->
<script type="text/jquery-templete" id="warnMsgTmpl">
{literal}
  <tr>
    <td colspan="6"><span class="sx-text-warning"><i class="xi-warning"></i>${msg}</span></td>
  </tr>
{/literal}
</script>
<script type="text/jquery-templete" id="dataListTmpl">
  <tr>
    {literal}
    <td>${no}</td>
    <td>${name}</td>               
    <td>${hit_count}</td>
    <td>${$item.editDate(date)}</td>
    {/literal}
    <td>
      <a href="{$rootPath}analytics-admin/{literal}${id}{/literal}/connect-site-reset" class="sx-btn sx-btn-info">초기화</a>
    </td>
    <td>
      <a href="{$rootPath}analytics-admin/{literal}${id}{/literal}/connect-site-delete" class="sx-btn sx-btn-warning">삭제</a>
    </td>
  </tr>
</script>
<!-- pc end -->

<!-- mobile start -->
<script type="text/jquery-templete" id="warnMsgMobileTmpl">
{literal}
  <li>
    <a href="#">
      <span class="title sx-text-warning">등록회원 없음.</span>
      <span class="summary sx-text-warning">${msg}</span>
    </a>           
  </li>
{/literal}
</script>
<script type="text/jquery-templete" id="dataListMobileTmpl">
  <li>
    <a href="{$rootPath}{literal}${category}{/literal}" target="_blank">
      <span class="sx_name">
        {literal}${name}{/literal}
      </span>      
      <span class="sx_title">{literal}${popup_title}{/literal}</span> 
      <span class="sx_hit"><i class="xi-eye-o"></i>{literal}${hit_count}{/literal}</span>     
      <span class="sx_date"><i class="xi-clock-o"></i>{literal}${$item.editDate(date)}{/literal}</span>
    </a>
    <div class="sx-btn-group">
      <a href="{$rootPath}analytics-admin/{literal}${id}{/literal}/connect-site-reset" class="sx-btn sx-btn-info">초기화</a>
      <a href="{$rootPath}analytics-admin/{literal}${id}{/literal}/connect-site-delete" class="sx-btn sx-btn-warning">삭제</a>
    </div>              
  </li>
</script>
<!-- mobile end -->

<!-- pagination start -->
<script type="text/jquery-templete" id="paginationTmpl">
{literal}
  <a href="#" class="sx-pagination">${no}</a>
{/literal}
</script>
<!-- pagination end -->

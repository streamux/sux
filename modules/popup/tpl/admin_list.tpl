    <div class="sx-content sx-admin-main">
      <section class="sx-popup-panel">
        <header class="header">
          <h1 class="title">팝업 관리</h1>
          <div class="sx-row clearfix">
            <span class="search_title">전체 팝업(0)</span>     
            <a href="{$rootPath}popup-admin/add" class="sx-btn pull-right" title="팝업 추가">팝업 추가</a>
          </div>
        </header>
        <article class="sx-box-content">
          <input type="hidden" name="list_json_path" value="{$rootPath}popup-admin/list-json">
          
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
            <table class="table" summary="팝업 정보를 제공합니다.">
            <caption class="sr-only">팝업 목록</caption>
              <thead>
                <tr>
                  <th class="sx_no">번호</th>
                  <th class="sx_name">이름</th>
                  <th class="sx_title">제목</th>
                  <th class="sx_period">기간</th>
                  <th class="sx_skin">스킨</th>
                  <th class="sx_usable">노출</th>
                  <th class="sx_modify_btn">수정</th>
                  <th class="sx_delete_btn">삭제</th>
                </tr>         
              </thead>
              <tbody id="dataList">
                <tr>
                  <td colspan="8">데이타 로딩 중...</td>
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
<script type="jquery-templete" id="warnMsgTmpl">
  {literal}
  <tr>
    <td colspan="8"><span class="sx-text-warning"><i class="xi-warning"></i>${msg}</span></td>
  </tr>
  {/literal}
</script>
<script type="jquery-templete" id="dataListTmpl"> 
  <tr>
    {literal}
    <td>${no}</td>
    <td><a href="#" data-key="${id}">${popup_name}</a></td>
    <td class="sx_title"><a href="#" data-key="${id}">${popup_title}</a></td>
    <td><a href="#" data-key="${id}">${date} ${time}</a></td>
    <td>${skin}</td>
    <td>${is_usable}</td>
    {/literal}
    <td>
      <a href="{$rootPath}popup-admin/{literal}${id}{/literal}/modify" class="sx-btn sx-btn-info">수정</a></td>
    <td>
      <a href="{$rootPath}popup-admin/{literal}${id}{/literal}/delete" class="sx-btn sx-btn-warning">삭제</a>
    </td>
  </tr> 
</script>
<!-- pc end -->

<!-- mobile start -->
<script type="jquery-templete" id="warnMsgMobileTmpl">
{literal}
  <li>
    <a href="#">
      <span class="title sx-text-warning">등록회원 없음.</span>
      <span class="summary sx-text-warning">${msg}</span>
    </a>           
  </li>
{/literal}
</script>
<script type="jquery-templete" id="dataListMobileTmpl">
  <li>
    <a href="{$rootPath}{literal}${category}{/literal}" target="_blank">
      <span class="sx_name">
        {literal}${popup_name}{/literal}
      </span>      
      <span class="sx_summary">{literal}${popup_title}{/literal}</span> 
      <span class="sx_skin"><i class="xi-layout-o"></i>{literal}${skin}{/literal}</span>
      <span class="sx_usable"><i class="xi-alarm-o"></i>{literal}${is_usable}{/literal}</span>      
      <span class="sx_period"><i class="xi-time-o"></i>{literal}${date} ${time}{/literal}</span>
    </a>
    <div class="sx-btn-group">
      <a href="{$rootPath}board-admin/{literal}${id}{/literal}/modify" class="sx-btn sx-btn-info">수정</a>
      <a href="{$rootPath}board-admin/{literal}${id}{/literal}/delete" class="sx-btn sx-btn-warning">삭제</a>
    </div>              
  </li>
</script>
<!-- mobile end -->

<!-- pagination start -->
<script type="x-jquery-templete" id="paginationTmpl">
{literal}
  <a href="#" class="sx-pagination">${no}</a>
{/literal}
</script>
<!-- pagination end -->

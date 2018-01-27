    <div class="sx-content sx-admin-main">
      <section class="sx-document-panel">
        <header class="header">
          <h1 class="title">페이지 관리</h1>
          <div class="sx-row clearfix">
            <span class="search_title">전체 페이지(0)</span>     
            <a href="{$rootPath}document-admin/add" class="sx-btn pull-right" title="페이지 추가">페이지 추가</a>
          </div>
        </header>
        <article class="sx-box-content sx-member">
          <input type="hidden" name="list_json_path" value="{$rootPath}document-admin/list-json">
          
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
            <table class="table" summary="회원 그룹 정보를 제공합니다.">
            <caption class="sr-only">페이지 목록</caption>
              <thead>
                <tr>
                  <th class="sx_no">번호</th>
                  <th class="sx_name">그룹 이름</th>
                  <th class="sx_summary">설명</th>
                  <th class="sx_content">템플릿 경로</th>
                  <th class="sx_date">생성일</th>
                  <th class="sx_modify_btn">수정</th>
                  <th class="sx_delete_btn">삭제</th>
                </tr>         
              </thead>
              <tbody id="dataList">
                <tr>
                  <td colspan="5">데이타 로딩중...</td>
                </tr>
                <!--
                @ jquery templete
                @ name  hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
                -->
              </tbody>
            </table>
          </div>
          <nav class="pagin_member sx-pagination-group">
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
    <td colspan="7"><span class="sx-text-warning"><i class="xi-warning"></i>${msg}</span></td>
  </tr>
{/literal}
</script>
<script type="text/jquery-templete" id="dataListTmpl">
  <tr>
    <td><span>{literal}${no}{/literal}</span></td>
    <td>
      <a href="{$rootPath}{literal}${category}{/literal}" target="_blank">{literal}${document_name}{/literal}</a>
    </td>
    <td class="sx_summary">
      <a href="{$rootPath}{literal}${category}{/literal}" target="_blank">{literal}${summary}{/literal}</a>
    </td>
    <td class="sx_content">
      <a href="{$rootPath}{literal}${category}{/literal}" target="_blank">{literal}${template_type}{/literal}</a>
    </td>
    <td>{literal}${$item.editDate(date)}{/literal}</td>    
    <td>
      <a href="{$rootPath}document-admin/{literal}${id}{/literal}/modify" class="sx-btn sx-btn-info">수정</a></td>
    <td>
      <a href="{$rootPath}document-admin/{literal}${id}{/literal}/delete" class="sx-btn sx-btn-warning">삭제</a>
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
      <span class="title">
        {literal}${document_name}{/literal}
      </span>      
      <span class="sx_summary">{literal}${summary}{/literal}</span> 
      <span class="sx_content"><i class="xi-file-text-o"></i>{literal}${template_type}{/literal}</span>      
      <span class="sx_date"><i class="xi-clock-o"></i>{literal}${$item.editDate(date)}{/literal}</span>
    </a>
    <div class="sx-btn-group">
      <a href="{$rootPath}document-admin/{literal}${id}{/literal}/modify" class="sx-btn sx-btn-info">수정</a>
      <a href="{$rootPath}document-admin/{literal}${id}{/literal}/delete" class="sx-btn sx-btn-warning">삭제</a>
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
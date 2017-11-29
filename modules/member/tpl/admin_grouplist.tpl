    <div class="sx-contents sx-admin-main">       
      <section class="section">
        <header class="header">
          <h1 class="title">회원 그룹 목록</h1>
          <div class="sx-row clearfix">
            <span class="search_title">전체 그룹(0)</span>     
            <a href="{$rootPath}member-admin/group-add" class="sx-btn sx-btn-info pull-right" title="그룹 추가">그룹 추가</a>
            <a href="{$rootPath}member-admin/list" class="sx-btn pull-right" title="전체 목록">전체 회원 목록</a>
          </div>
        </header>        
        <article class="sx-box-content">
          <input type="hidden" name="list_json_path" value="{$rootPath}member-admin/group-json">         
          <ul class="list_mobile_panel" id="dataMobileList">
            <!--
              @ jquery templete
              @ name  hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
            -->
            <li>
              <a href="#">
                <span class="summary">로딩 중...</span>
              </a>     
            </li>
          </ul>
          <div class="list_pc_panel">
            <table class="table" summary="회원 그룹 목록 정보를 제공합니다.">
              <caption class="sr-only">회원 그룹 목록</caption>
              <thead>
                <tr>
                  <th class="sx_no">번호</th>
                  <th class="sx_category">카테고리</th>
                  <th class="sx_name">그룹 이름</th>
                  <th class="sx_summary">설명</th>
                  <th class="sx_num">회원 수</th>
                  <th class="sx_date">생성일</th>
                  <th class="sx_modify_btn">수정</th>
                  <th class="sx_delete_btn">삭제</th>
                </tr>         
              </thead>
              <tbody id="dataList">
                <tr>
                  <td colspan="8">데이타 로딩중...</td>
                </tr>
                <!--
                @ jquery templete
                @ name  warnMsgTmpl, dataListTmpl
                -->
              </tbody>
            </table>
          </div>
          
          <nav class="sx-pagination-group">
            <a href="#" class="sx-nav-prev sx-pagination-control unactive">이전</a>
            <span id="paginList">
              <a href="#" class="sx-pagination unactive">1</a>
            </span>
            <a href="#" class="sx-nav-next sx-pagination-control unactive">다음</a>
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
    <td><span>{literal}${no}{/literal}</td>
    <td>      
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/list">
        {literal}${category}{/literal}
      </a>
    </td>
    <td>      
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/list">
        {literal}${group_name}{/literal}
      </a>
    </td>
    <td class="sx_summary">      
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/list">
        {literal}${summary}{/literal}
      </a>
    </td>
    <td class="sx_member_num">      
      {literal}${member_num}{/literal}
    </td>
    <td>{literal}${$item.editDate(date)}{/literal}</td>  
    <td>
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/group-modify" class="sx-btn sx-btn-info">수정</a>
    </td>
    <td>
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/group-delete" class="sx-btn sx-btn-warning">삭제</a>
    </td>
  </tr>
</script>
<!-- pc end -->

<!-- mobile start -->
<script type="jquery-templete" id="warnMsgMobileTmpl">
{literal}
  <li>
    <a href="#">
      <span class="title sx-text-warning">그룹없음</span>
      <span class="summary sx-text-warning">${msg}</span>
    </a>           
  </li>
{/literal}
</script>

<script type="jquery-templete" id="dataListMobileTmpl">
  <li>
    <a href="{$rootPath}member-admin/{literal}${id}{/literal}/list">
      <span class="title">
        {literal}${group_name}{/literal}
      </span>
      <span class="summary">{literal}${summary}{/literal}</span>                
      <span class="member_num"><i class="xi-group"></i>{literal}${member_num}{/literal}</span>
      <span class="date"><i class="xi-clock-o"></i>{literal}${$item.editDate(date)}{/literal}</span>
    </a>
    <div class="sx-btn-group">
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/group-modify" class="sx-btn sx-btn-info">수정</a>
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/group-delete" class="sx-btn sx-btn-warning">삭제</a>
    </div>              
  </li>
</script>
<!-- mobile end -->

<script type="x-jquery-templete" id="paginationTmpl">
{literal}
  <a href="#" class="sx-pagination">${no}</a>
{/literal}
</script>
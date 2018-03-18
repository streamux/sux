 
    <div class="sx-content sx-admin-main">          
      <section class="sx-board-panel">
        <header class="header">
          <h1 class="title">게시글 그룹 관리</h1>
          <div class="sx-row clearfix">
            <span class="search_title">
              전체 게시글 그룹(<span class="total_num">0</span>)
            </span>
            <div class="btn_group pull-right">
              <a href="{$rootPath}board-admin/list" class="sx-btn" title="글 목록">전체 글 목록</a>
              <a href="{$rootPath}board-admin/group-add" class="sx-btn sx-btn-info" title="게시글 그룹 추가">게시글 그룹 추가</a>
            </div>            
          </div>
        </header>
        <article class="sx-box-content sx-board">
          <input type="hidden" name="list_json_path" value="{$rootPath}board-admin/group-list-json">
          
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
            <table class="table" summary="게시글 그룹 리스트 정보를 제공합니다.">
              <caption class="sr-only">그룹 목록</caption>
              <thead>
                <tr>
                  <th class="sx_no">번호</th>
                  <th class="sx_name">그룹 이름</th>
                  <th class="sx_summary">설명</th>
                  <th class="sx_skin">스킨</th>
                  <th class="sx_type">타입</th>
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
            <a href="#none" class="sx-nav-prev sx-pagination-control unactive">이전</a>
            <span id="paginList">
              <a href="#" class="sx-pagination unactive">1</a>
            </span>
            <a href="#none" class="sx-nav-next sx-pagination-control unactive">다음</a>
          </nav>
        </article>
        <footer class="footer">
          <div class="btn_group pull-right">
              <a href="{$rootPath}board-admin/list" class="sx-btn" title="글 목록">전체 글 목록</a>
              <a href="{$rootPath}board-admin/group-add" class="sx-btn sx-btn-info" title="게시글 그룹 추가">게시글 그룹 추가</a>
            </div>
        </footer>
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
    <td>{literal}${no}{/literal}</td>
    <td>
      <a href="{$rootPath}{literal}${category}{/literal}" target="_blank">{literal}${board_name}{/literal}</a>
    </td>
    <td class="sx_summary">
      <a href="{$rootPath}{literal}${category}{/literal}" target="_blank">{literal}${summary}{/literal}</a>
    </td>
    {literal}
    <td>${skin_path}</td>
    <td>${board_type}</td>                   
    <td>${$item.editDate(date)}</td>   
    {/literal}
    <td>
      <a href="{$rootPath}board-admin/{literal}${id}{/literal}/group-modify" class="sx-btn sx-btn-info">수정</a></td>
    <td>
      <a href="{$rootPath}board-admin/{literal}${id}{/literal}/group-delete" class="sx-btn sx-btn-warning">삭제</a>
    </td>
  </tr>
</script>
<!-- pc end -->

<!-- mobile start -->
<script type="jquery-templete" id="warnMsgMobileTmpl">
{literal}
  <li>
    <a href="#">
      <span class="title sx-text-warning">등록된 게시글 그룹 없음</span>
      <span class="summary sx-text-warning">${msg}</span>
    </a>           
  </li>
{/literal}
</script>
<script type="jquery-templete" id="dataListMobileTmpl">
  <li>
    <a href="{$rootPath}{literal}${category}{/literal}" target="_blank">
      <span class="title">
        {literal}${board_name}{/literal}
      </span>      
      <span class="sx_summary">{literal}${summary}{/literal}</span> 
      <span class="sx_skin"><i class="xi-layout-o"></i>{literal}${skin_path}{/literal}</span>
      <span class="sx_type"><i class="xi-check-square-o"></i>{literal}${board_type}{/literal}</span>      
      <span class="sx_date"><i class="xi-clock-o"></i>{literal}${$item.editDate(date)}{/literal}</span>
    </a>
    <div class="sx-btn-group">
      <a href="{$rootPath}board-admin/{literal}${id}{/literal}/group-modify" class="sx-btn sx-btn-info">수정</a>
      <a href="{$rootPath}board-admin/{literal}${id}{/literal}/group-delete" class="sx-btn sx-btn-warning">삭제</a>
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

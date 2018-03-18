 
    <div class="sx-content sx-admin-main">          
      <section class="sx-board-panel">
        <header class="header">
          <h1 class="title">게시글 관리</h1>
          <div class="sx-row clearfix">
            <span class="search_title">
              전체 글(<span class="total_num">0</span>)
            </span>
            <div class="btn_group pull-right">
              <a href="{$rootPath}board-admin/group-list" class="sx-btn" title="글 추가">게시글 그룹 목록</a>
              <a href="{$rootPath}board-admin/add" class="sx-btn sx-btn-info" title="글 추가">그룹 추가</a>
            </div>
          </div>
        </header>
        <article class="sx-box-content sx-board">
          <input type="hidden" name="list_json_path" value="{$rootPath}board-admin/list-json">
          
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
            <table class="table" summary="게시글 리스트 정보를 제공합니다.">
              <caption class="sr-only">게시글 목록</caption>
              <thead>
                <tr>
                  <th class="sx_group">그룹</th>
                  <th class="sx_title">제목</th>
                  <th class="sx_nickname">작성자</th>
                  <th class="sx_date">작성일</th>
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
              <a href="{$rootPath}board-admin/group-list" class="sx-btn" title="글 추가">게시 그룹 목록</a>
              <a href="{$rootPath}board-admin/add" class="sx-btn sx-btn-info" title="글 추가">글 추가</a>
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
    <td class="sx_group">{literal}${category}{/literal}</td>
    <td class="sx_title">
      <a href="{$rootPath}{literal}${category}/${id}{/literal}" target="_blank">{literal}${title}{/literal}</a>
    </td>
    <td class="sx_nickname">
      <a href="{$rootPath}{literal}${category}/${id}{/literal}" target="_blank">{literal}${nickname}{/literal}</a>
    </td>
    {literal}           
    <td>${$item.editDate(date)}</td>   
    {/literal}
    <td class="sx_modify_btn">
      <a href="{$rootPath}board-admin/{literal}${id}{/literal}/modify" class="sx-btn sx-btn-info">수정</a>
    </td>
    <td class="sx_delete_btn">
      <a href="{$rootPath}board-admin/{literal}${id}{/literal}/delete" class="sx-btn sx-btn-warning">삭제</a>
    </td>
  </tr>
</script>
<!-- pc end -->

<!-- mobile start -->
<script type="jquery-templete" id="warnMsgMobileTmpl">
{literal}
  <li>
    <a href="#">
      <span class="title sx-text-warning">등록된 글이 없습니다.</span>
      <span class="summary sx-text-warning">${msg}</span>
    </a>           
  </li>
{/literal}
</script>
<script type="jquery-templete" id="dataListMobileTmpl">
  <li>
    <a href="{$rootPath}{literal}${category}/${id}{/literal}" target="_blank">
      <span class="title">
        {literal}${title}{/literal}
      </span>      
      <span class="sx_skin"><i class="xi-user-o"></i>{literal}${nickname}{/literal}</span> 
      <span class="sx_date"><i class="xi-clock-o"></i>{literal}${$item.editDate(date)}{/literal}</span>
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

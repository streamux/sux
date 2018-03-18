    <div class="sx-content">           
      <section class="section">
        <header class="header">
          <h1 class="title">회원 관리</h1>
          <form action="{$rootPath}member-admin/list" method="post" name="f_search" class="search_form sx-form-horizontal">
            <div class="sx-form-inline clearfix">
              <span class="search_title">전체 회원({$documentData.total_num})</span>
              <div class="sx-input-group pull-right">
                <label for="findGroup" class="sr-only">그룹 정보 설정</label>               
                <select id="findGroup" name="find_group" class="sx-form-control">
                  <option value="" selected="selected">전체</option>
                  {foreach from=$documentData.categories item=item}
                      <option value="{$item.category}" {if $documentData.category ===$item.category} selected="selected" {/if}>{$item.category}</option>
                  {/foreach}
                </select>
                <label for="find" class="sr-only">회원 정보 설정</label>
                <select name="find" id="find" class="sx-form-control">
                  <option value="user_id">아이디 </option>
                  <option value="nickname">닉네임</option>
                  <option value="email_address">이메일</option>
                </select>
                <label for="search" class="sr-only">검색어</label>
                <input type="text" name="search" value="" class="sx-form-control" placeholder="검색어">
                <input type="submit" name="btn_submit" value="검색" class="sx-btn" title="검색">              
                <a href="{$rootPath}member-admin/group" class="sx-btn" title="그룹 목록">그룹 목록</a>
                <a href="{$rootPath}member-admin/add" class="sx-btn sx-btn-info" title="회원추가">회원 추가</a>
              </div>            
            </div>
          </form>
        </header> 
        <div class="sx-box-content">
          <input type="hidden" name="category" value="{$documentData.category}">
          <input type="hidden" name="list_json_path" value="{$rootPath}member-admin/list-json">

          <ul class="list_mobile_panel" id="dataMobileList">
            <li>
              <a href="#">
                <span class="summary">로딩 중...</span>
              </a>     
            </li>
            <!--
              @ jquery templete
              @ name  warnMsgMobileTmpl, dataListMobileTmpl
            -->              
          </ul>
          <div class="list_pc_panel">
            <table class="table" summary="회원 그룹 정보를 제공합니다.">
              <caption class="sr-only">회원 그룹 목록</caption>
              <thead>
                <tr>
                  <th class="sx_id">아이디</th>
                  <th class="sx_nickname">닉네임</th>
                  <th class="sx_email_address">이메일</th>
                  <th class="sx_point">회원 그룹</th>
                  <th class="sx_date">가입일</th>
                  <th class="sx_grade">레벨</th>
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
        </div>
      </section>
    </div>

<!-- pc start -->
<script type="text/jquery-templete" id="warnMsgTmpl">
{literal}
  <tr>
    <td colspan="8"><span class="sx-text-warning"><i class="xi-warning"></i>${msg}</span></td>
  </tr>
{/literal}
</script>
<script type="text/jquery-templete" id="dataListTmpl">
  <tr>
    {literal}
    <td>${user_id}</td>
    <td>${nickname}</td>
    <td>${email_address}</td>
    <td>${category}</td>
    <td>${$item.editDate(date)}</td>             
    <td>${grade}</td>
    {/literal}
    <td>
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/modify" class="sx-btn sx-btn-info">수정</a>
    </td>
    <td>
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/delete" class="sx-btn sx-btn-warning">삭제</a>
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
    <a href="{$rootPath}member-admin/{$documentData.id}/modify/{literal}${id}{/literal}">
      <span class="title">
        {literal}${nickname}{/literal}
      </span>      
      <span class="email_address"><i class="xi-mail-o"></i>{literal}${email_address}{/literal}</span> 
      <span class="user_id"><i class="xi-user-o"></i>{literal}${user_id}{/literal}</span>
      <span class="point"><i class="xi-group"></i>{literal}${category}{/literal}</span>      
      <span class="date"><i class="xi-clock-o"></i>{literal}${$item.editDate(date)}{/literal}</span>
    </a>
    <div class="sx-btn-group">
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/modify" class="sx-btn sx-btn-info">수정</a>
      <a href="{$rootPath}member-admin/{literal}${id}{/literal}/delete" class="sx-btn sx-btn-warning">삭제</a>
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
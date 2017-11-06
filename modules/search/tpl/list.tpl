<div class="board_list">
  <div class="form_search_panel">
    <form action="{$rootPath}search" name="f_board_list_search" class="sx-form-horizontal">
      <div class="sx-form-inline">
        <div class="sx-input-group">
          <input type="text" name="search" size="25" class="sx-form-control" placeholder="검색어를 입력하세">
          <button type="submit" class="sx-btn"><i class="xi-search"></i>검색</button>
        </div>
      </div>          
    </form> 
  </div>
  
  <span class="sx-divider"></span>
  <span class="search_result">"<strong>{$requestData.search}</strong>" 검색결과 - {$documentData.total_num}건</span>
  
  <ul class="list_panel">
  {foreach from=$contentData.list item=$item}
    {if isset($item)}
    <li class="sx-btn-activate">          
      <p class="subject"> 
        {assign var=url value="{$rootPath}{$item.subject.category}/{$item.subject.id}"}
        {if $requestData.search != ''}
          {$url="$url?search={$requestData.search}"}
        {/if}  
        <a href="{$url}" title="{$item.subject.title}">                   
          <strong>{$item.subject.title|nl2br}</strong>
          <span class="sx-badge {$item.subject.css_comment}">{$item.subject.comment_num}</span><br>
          <span class="contents">{$item.contents|nl2br}</span><br>
        </a>
        <a href="{$url}" class="link_address" title="{$item.subject.title}">{$documentData.domain}{$url}</a>
      </p>      
      <p class="info">
        {$item.name}<i class="xi-clock sx-space-center"></i><span class="sx-space-right">{$item.date}</span><i class="xi-eye sx-space-center"></i>{$item.hit}
      </p>      
    </li>
    {else if}
    <li>
      <span class="warn_subject sx-bg-warning">등록된 게시물이 없습니다.</span>      
    </li>
    {/if}
  {/foreach}
  </ul>
 
  <div class="board_pagination">
    <div class="pagin_pc">
      {assign var=naviSkinPath value="$skinRealPath/_navi.tpl"}
      {if $naviSkinPath != ''}
        {include file="$naviSkinPath"}
      {/if}
    </div>
    <div class="pagin_mobile">
      {assign var=naviSkinPath value="$skinRealPath/_navi_mobile.tpl"}
      {if $naviSkinPath != ''}
        {include file="$naviSkinPath"}
      {/if}
    </div>  
  </div>
</div>
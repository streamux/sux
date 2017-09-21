{assign var=category value=$documentData.category}
{assign var=groupData value=$documentData.group}
{assign var=boardTitle value=$groupData.board_name}
{assign var=contentData value=$documentData.contents}

{assign var=rootPath value=$skinPathList.root}
{assign var=skinPath value=$skinPathList.path}
{assign var=skinRealPath value=$skinPathList.realPath}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{assign var=routeURI value="$rootPath$category"}

{include file="$headerPath" title="$boardTitle :: 게시물 목록 - StreamUX"}
<div class="board_list" style="width:{$groupData.width}">
  <!-- banner start -->
  {include file="$skinRealPath/_board_header.tpl"}
  <!-- end -->

  <div class="form_search_panel">
    <form action="{$routeURI}" method="post" name="f_board_list_search" class="sx-form-inline">
      <input type="hidden" name="_method" value="select">           
      <div class="sx-input-group">             
        <select name="find" class="sx-form-control">
          <option value='title'>제 목</option>
          <option value='name'>작성자</option>
          <option value='comment'>내 용</option>
        </select>  
        <input type="text" name="search" size="25" class="sx-form-control" placeholder="검색어를 입력하세">
        <button type="submit" class="sx-btn"><i class="xi-search"></i>검색</button>
        <a href="{$routeURI}/write{$params}" class="sx-btn"><i class="xi-pen-o xi-2x"><span class="sr-only">글쓰기</span></i></a>
      </div>    
    </form>
  </div>

  <ul>
  {foreach from=$contentData.list  item=$item}
    {if isset($item)}
    <li class="sx-btn-activate">
      {if $requestData.search != ''}
      <a href="{$routeURI}/{$item.subject.id}?find={$requestData.find}&search={$requestData.search}">
      {else}
      <a href="{$routeURI}/{$item.subject.id}">
      {/if}
        <p class="subject" style="padding-left:{$item.subject.space}px">
          <span class="label label-primary {$item.subject.icon_box_color}">{$item.subject.icon_box}</span>            
          <span class="title">{$item.subject.title|nl2br}</span>
          <span class="{$item.subject.css_comment}">({$item.subject.comment_num})</span>
          {if $item.subject.img_name != ''}
          <img src="{$skinPath}/images/{$item.subject.img_name}" class="{$item.subject.icon_img}">
          {/if}
          <img src="{$skinPath}/images/icon_new_1.gif" class="{$item.subject.icon_new}"  title="{$item.subject.icon_new_title}">
          <span class="label label-primary {$item.subject.icon_progress_color}">{$item.subject.progress_step_name}</span>
        </p>
      </a>
      <p class="info" style="padding-left:{$item.subject.space}px">
        <span class="sx-space-right">{$item.name}</span><i class="xi-clock sx-space-center"></i><span class="sx-space-right">{$item.date}</span><i class="xi-eye sx-space-center"></i>{$item.hit}
      </p>      
    </li>
    {else if}
    <li>
      <span class="warn_subject sx-bg-warning">등록된 게시물이 없습니다.</span>      
    </li>
    {/if}
  {/foreach}
  </ul>

  <div class="table_panel">  
    <table class="table-striped" summary="게시판 리스트입니다.">
      <thead>
        <tr>        
          <th class="subject">제목</th>
          <th class="author">작성자</th>
          <th class="date">작성일</th>
          <th class="hit">조회수</th>
        </tr>
      </thead>
      <tbody>
      {foreach from=$contentData.list  item=$item}
        {if isset($item)}
        <tr class="sx-btn-activate">       
          <td class="subject">
            {if $requestData.search != ''}
              <a href="{$routeURI}/{$item.subject.id}?find={$requestData.find}&search={$requestData.search}">
            {else}
              <a href="{$routeURI}/{$item.subject.id}">
            {/if}
            <span class="link_area" style="padding-left:{$item.subject.space+25}px">
              <span class="label label-primary {$item.subject.icon_box_color}">{$item.subject.icon_box}</span>            
              <span class="title">{$item.subject.title|nl2br}</span>
              <span class="{$item.subject.css_comment}">({$item.subject.comment_num})</span>
              {if $item.subject.img_name != ''}
              <img src="{$skinPath}/images/{$item.subject.img_name}" class="{$item.subject.icon_img}">
              {/if}
              <img src="{$skinPath}/images/icon_new_1.gif" class="{$item.subject.icon_new}"  title="{$item.subject.icon_new_title}">
              <span class="label label-primary {$item.subject.icon_progress_color}">{$item.subject.progress_step_name}</span>  
            </span></a>
          </td>
          <td><span>{$item.name}</span></td>
          <td><span>{$item.date}</span></td>
          <td><span>{$item.hit}</span></td>
        </tr>
        {else if}
        <tr>
          <td colspan="4" class="warn_subject sx-bg-warning"><span>등록된 게시물이 없습니다.</span></td>
        </tr>
        {/if}
      {/foreach}
      </tbody>
    </table>
  </div>

  <div class="board_pagination" style="width:{$groupData.width}">
  {if $skinPathList.navi != ''}
    {assign var=naviSkinPath value=$skinPathList.navi}
    {include file="$naviSkinPath"}
  {/if}
  </div>  
</div>
{include file="$footerPath"}
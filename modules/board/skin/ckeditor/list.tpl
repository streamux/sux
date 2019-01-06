<div class="board_list" style="width:{$groupData.width}">
  <!-- banner start -->
  {include file="$skinRealPath/_board_header.tpl"}
  <!-- end -->

  {if $requestData.search != ''}
    {assign var=find value=$requestData.find}
    {assign var=search value=$requestData.search}
    {assign var=params value="?find=$find&search=$search"}
  {else}
    {assign var=find value=''}
    {assign var=search value=''}
    {assign var=params value=''}
  {/if}
  <div class="form_search_panel">
    <form action="{$routeURI}" name="f_board_list_search" method="POST" class="sx-form-horizontal">
        <div class="sx-form-inline">
          <div class="sx-input-group">
            <label for="find" class="sr-only">검색 분류</label>
            <select name="find" class="sx-form-control form_control_width">
              <option value='title'>제 목</option>
              <option value='user_name'>작성자</option>
              <option value='content'>내 용</option>
            </select>
            <label for="search" class="sr-only">검색</label>
            <input type="text" name="search" size="25" class="sx-form-control" placeholder="검색어를 입력하세">
            <button type="submit" class="sx-btn"><i class="xi-search"></i>검색</button>
            <a href="{$routeURI}/write{$params}" class="sx-btn"><i class="xi-pen-o xi-2x"><span class="sr-only">글쓰기</span></i></a>
        </div>
      </div>
    </form>
  </div>

  <!-- Mobile -->
  <ul class="list_mobile_panel">

  <!-- Notice -->
  {foreach from=$contentData.notice_list  item=$item}
    {if isset($item)}
    <li class="sx-btn-active sx_notice_list">
      <p class="subject" style="padding-left:{$item.subject.space}px">
        <a href="{$routeURI}/{$item.subject.id}">
        <span class="prefix_icon sx-label {$item.subject.prefix_icon_color}">{$item.subject.prefix_icon}</span>
        <span class="title">{$item.subject.title|nl2br}</span>
        <span class="sx-badge">{$item.subject.comment_num}</span>
        {if $item.subject.icon_img_name != ''}
        <img src="{$skinPath}/images/{$item.subject.icon_img_name}" class="{$item.subject.icon_img}">
        {/if}
        <img src="{$skinPath}/images/icon_new_1.gif" class="{$item.subject.icon_new}"  title="{$item.subject.icon_new_title}">
        <span class="sx-label sx-label-primary">{$item.subject.progress_step_name}</span>
        </a>
      </p>
      <p class="info" style="padding-left:{$item.subject.space}px">
        <span class="sx-space-right">{$item.name}</span><i class="xi-clock sx-space-center"></i><span class="sx-space-right">{$item.date}</span><i class="xi-eye sx-space-center"></i>{$item.hit}
      </p>
    </li>
    {/if}
  {/foreach}

  <!-- List -->
  {foreach from=$contentData.list item=$item}
    {if isset($item)}
    <li class="sx-btn-active">
      <p class="subject" style="padding-left:{$item.subject.space}px">
        {if $requestData.search != ''}
        <a href="{$routeURI}/{$item.subject.id}?find={$requestData.find}&search={$requestData.search}">
        {else}
        <a href="{$routeURI}/{$item.subject.id}">
        {/if}
          <span class="prefix_icon sx-label {$item.subject.prefix_icon_color}">{$item.subject.prefix_icon_label}</span>
          <span class="title">{$item.subject.title|nl2br}</span>
          <span class="sx-badge">{$item.subject.comment_num}</span>
          {if $item.subject.icon_img_name != ''}
          <img src="{$skinPath}/images/{$item.subject.icon_img_name}" class="{$item.subject.icon_img}">
          {/if}
          <img src="{$skinPath}/images/icon_new_1.gif" class="{$item.subject.icon_new}"  title="{$item.subject.icon_new_title}">
          <span class="sx-label sx-label-primary">{$item.subject.progress_step_name}</span>
        </a>
      </p>
      <p class="info" style="padding-left:{$item.subject.space}px">
        <span class="sx-space-right">{$item.name}</span><i class="xi-clock sx-space-center"></i><span class="sx-space-right">{$item.date}</span><i class="xi-eye sx-space-center"></i>{$item.hit}
      </p>
    </li>
    {/if}
  {/foreach}
  {if count($contentData.list) == 0}
   <li class="warn_subject sx-bg-warning">
    등록된 게시물이 존재하지 않습니다.
  </li>
  {/if}
  </ul>
  <!-- end -->

  <!-- PC -->
  <div class="list_pc_panel">
    <table class="table" summary="게시판 리스트입니다.">
      <thead>
        <tr>
          <th class="subject">제목</th>
          <th class="author">작성자</th>
          <th class="date">작성일</th>
          <th class="hit">조회수</th>
        </tr>
      </thead>
      <tbody>

      <!-- Notice -->
      {foreach from=$contentData.notice_list  item=$item}
        {if isset($item)}
        <tr class="sx-btn-active sx_notice_list">
          <td class="subject">
            <a href="{$rootPath}{$item.category}/{$item.subject.id}" class="link_area" style="padding-left:{$item.subject.space+5}px">
              <span class="prefix_icon sx-label {$item.subject.prefix_icon_color}">{$item.subject.prefix_icon}</span>
              <span class="title" style="font-weight:600;">{$item.subject.title|nl2br}</span>
              <span class="sx-badge">{$item.subject.comment_num}</span>
              {if $item.subject.icon_img_name != ''}
              <img src="{$skinPath}/images/{$item.subject.icon_img_name}" class="{$item.subject.icon_img}">
              {/if}
              <img src="{$skinPath}/images/icon_new_1.gif" class="{$item.subject.icon_new}"  title="{$item.subject.icon_new_title}">
              <span class="sx-label sx-label-primary {$item.subject.icon_progress_color}">{$item.subject.progress_step_name}</span>
            </a>
          </td>
          <td class="author"><span style="font-weight:600;">{$item.name}</span></td>
          <td><span style="font-weight:600;">{$item.date}</span></td>
          <td class="hit"><span style="font-weight:600;">{$item.hit}</span></td>
        </tr>
        {/if}
      {/foreach}

      <!-- List -->
      {foreach from=$contentData.list  item=$item}
        {if isset($item)}
        <tr class="sx-btn-active">
          <td class="subject">
            {if $requestData.search != ''}
              <a href="{$routeURI}/{$item.subject.id}?find={$requestData.find}&search={$requestData.search}" class="link_area" style="padding-left:{$item.subject.space+25}px">
            {else}
              <a href="{$routeURI}/{$item.subject.id}" class="link_area" style="padding-left:{$item.subject.space+5}px">
            {/if}
              <span class="prefix_icon sx-label {$item.subject.prefix_icon_color}">{$item.subject.prefix_icon_label}</span>
              <span class="title">{$item.subject.title|nl2br}</span>
              <span class="sx-badge">{$item.subject.comment_num}</span>
              {if $item.subject.icon_img_name != ''}
              <img src="{$skinPath}/images/{$item.subject.icon_img_name}" class="{$item.subject.icon_img}">
              {/if}
              <img src="{$skinPath}/images/icon_new_1.gif" class="{$item.subject.icon_new}"  title="{$item.subject.icon_new_title}">
              <span class="sx-label sx-label-primary {$item.subject.icon_progress_color}">{$item.subject.progress_step_name}</span>
            </a>
          </td>
          <td class="author"><span>{$item.name}</span></td>
          <td><span>{$item.date}</span></td>
          <td class="hit"><span>{$item.hit}</span></td>
        </tr>
        {/if}
      {/foreach}
      {if count($contentData.list) == 0}
        <tr>
          <td colspan="4" class="warn_subject sx-bg-warning">등록된 게시물이 존재하지 않습니다.</td>
        </tr>
      {/if}
      </tbody>
    </table>
  </div>
  <!-- end -->

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
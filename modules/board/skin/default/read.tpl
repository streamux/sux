{assign var=category value=$documentData.category}
{assign var=groupData value=$documentData.group}
{assign var=boardTitle value=$groupData.board_name}
{assign var=contentData value=$documentData.contents}
{assign var=commentData value=$documentData.comments}

{assign var=rootPath value=$skinPathList.root}
{assign var=skinPath value=$skinPathList.path}
{assign var=skinRealPath value=$skinPathList.realPath}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{assign var=progressStepSkinPath value=$skinPathList.progress_step}
{assign var=commentSkinPath value=$skinPathList.comment}
{assign var=routeURI value="$rootPath$category"}

{include file="$headerPath" title="$boardTitle :: 게시물 읽기 - StreamUX"}

<div class="board_read" style="width:{$groupData.width}">
  <!-- banner start -->
  {include file="$skinRealPath/_board_header.tpl"}
  <!-- end --> 
  <div class="head_panel">
    <p class="title">{$contentData.title}</p>
    <p class="sub_info">{$contentData.user_name} &nbsp; {$contentData.date} &nbsp; 조회 {$contentData.readed_count}</p>
  </div>

  <div class="body_panel">
    <div class="contents">
      <p class="{$contentData.css_down}">      
        <a href="{$contentData.fileup_path}">{$contentData.file_name}&nbsp;<b>[ 다운로드 ]</b></a>
      </p>
      <p class="{$contentData.css_img}" style="max-width:{$contentData.css_img_width}"><img src="{$contentData.fileup_path}" width="100%" border="0"></p>
      <p>{$contentData.contents}</p>
    </div> 
    <div class="btn_groups">    
      <a href="{$routeURI}{$params}" class="sx-btn">목록</a>
      <a href="{$routeURI}/write{$params}" class="sx-btn">글쓰기</a>
      <a href="{$routeURI}/reply{$params}" class="sx-btn">답변</a>
      <a href="{$routeURI}/modify{$params}" class="sx-btn">수정</a>
      <a href="{$routeURI}/delete{$params}" class="sx-btn">삭제</a>
    </div>   
  </div>   
</div> 
{if $progressStepSkinPath != ''}   
  {include file="$progressStepSkinPath"}
{/if}

{if $commentSkinPath != ''}  
  {include file="$commentSkinPath"}
{/if}
{include file="$footerPath"}
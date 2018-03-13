{assign var=commentData value=$documentData.comments}
{assign var=progressStepSkinPath value=$skinPathList.progress_step}
{assign var=commentSkinPath value=$skinPathList.comment}

<div class="board_read" style="width:{$groupData.width}">
  <!-- banner start -->
  {include file="$skinRealPath/_board_header.tpl"}
  <!-- end --> 
  <div class="head_panel">
    <p class="title">{$contentData.title}</p>
    <p class="sub_info">{$contentData.nickname} &nbsp; {$contentData.date} &nbsp; 조회 {$contentData.readed_count}</p>
  </div>
  <div class="body_panel">
    <div class="content"> 
      <p class="download_panel {$contentData.is_down}">
        <a href="{$contentData.fileup_path}">{$contentData.file_name} <b>다운로드</b></a>
      </p>
      <p class="{if isset($contentData.is_img)}img_panel{/if} {$contentData.is_img}" style="max-width:{$contentData.is_img_width}"><img src="{$contentData.fileup_path}" width="100%" border="0"></p>
      <div class="content_text">
        {$contentData.content}  
      </div>
    </div> 
    <div class="btn_groups">    
      <a href="{$routeURI}{$params}" class="sx-btn">목록</a>
      <a href="{$routeURI}/write{$params}" class="sx-btn">글쓰기</a>
      <a href="{$routeURI}/{$contentData.id}/reply{$params}" class="sx-btn">답변</a>
      <a href="{$routeURI}/{$contentData.id}/modify{$params}" class="sx-btn">수정</a>
      <a href="{$routeURI}/{$contentData.id}/delete{$params}" class="sx-btn">삭제</a>
    </div>   
  </div>   
</div>
<!-- comment -->
{if $commentSkinPath != ''}  
  {include file="$commentSkinPath"}
{/if}

<!-- progress step -->
{if $progressStepSkinPath != ''}   
  {include file="$progressStepSkinPath"}
{/if}
<div class="board_comment {$contentData.css_comment}" style="width:{$groupData.width}">
  <div class="write_panel">
    <p class="title">댓글쓰기</p>
    <form action="{$routeURI}/{$contentData.id}/comment" name="f_comment" method="post" class="sx-form-horizontal">
      <input type="hidden" name="_method" value="insert">
      <input type="hidden" name="category" value="{$documentData.category}">
      <input type="hidden" name="content_id" value="{$documentData.id}">
      <div class="sx-form-group">
        <label for="comment" class="sr-only">댓글입력</label>
        <textarea name="comment" id="comment" rows="23" class="sx-form-control" placeholder="내용을 입력해주세요."></textarea>
      </div>
      <div class="btn_group sx-form-group">
        <input type="submit" name="comfirm" value="댓글등록" class="sx-btn">
      </div>      
    </form>
  </div>

  <div class="list_panel">
    <input type="hidden" name="url_comment_json" value="{$routeURI}/{$contentData.id}/comment-json">
    <p class="title">댓글 {$commentData.num}</p>
     <ul id="commentList">
      <!-- boardTailCommentTmpl -->
    </ul>
  </div>
</div>

<script type="text/x-jquery-templete" id="boardTailCommentTmpl"> 
  <li class="clearfix">
    <div class="user_info clearfix">
      <div class="sx-user-picture pull-left"></div>
      <p class="nickname pull-left">{literal}${user_id}<br>${date}{/literal}</p>
    </div>
    <div class="comment_body">
      <p class="comment">{literal}${comment}{/literal}</p>
      <p class="btn_group">
      {literal}
        <button class="sx-btn sx-btn-xs" onclick="jsux.fn.read.voteComment(${id});"><i class="xi-heart-o"></i>좋아요(+${voted_count})</button>
      {/literal}
      {literal}{{if user_id == '{/literal}{$sessionData.user_id}{literal}' || ('{/literal}{$sessionData.category}{literal}' === 'administrator' && '{/literal}{$sessionData.grade}{literal}' === '10' ) }}{/literal}
      {literal}
        <button class="sx-btn sx-btn-xs" onclick="jsux.fn.read.deleteComment(${content_id},${id});">삭제</button>
        {{/if}}
      {/literal}        
      </p>
    </div>     
  </li>
</script>

<script type="text/jquery-templete" id="warnMsgTmpl">
{literal}
  <li>
    <span class="comment">${msg}</span>
  </li>
{/literal}
</script>
<!-- mobile end -->
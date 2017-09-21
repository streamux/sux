<div class="board_comment {$contentData.css_comment}" style="width:{$groupData.width}">
  <div class="write_panel">
    <p class="title">댓글쓰기</p>
    <form action="{$routeURI}/{$contentData.id}/comment" name="f_comment" method="post">
      <input type="hidden" name="_method" value="insert">
      <input type="hidden" name="category" value="{$documentData.category}">
      <input type="hidden" name="contents_id" value="{$documentData.id}">
      <div class="sx-form-inline">
         <div class="sx-input-group">
            <label for="nickName" class="sx-control-label">닉네임</span>
            <input type="text" name="nickname" id="nickName" size="12" maxlength="24" value="임꺽정" class="sx-form-control">
             <label for="password" class="sx-space-left">비밀번호</span>
            <input type="password" name="password" id="password" size="12" maxlength="24" value="12" class="sx-form-control">
        </div>
      </div>      
      <div class="sx-form-group">
        <textarea name="comment" rows="23" class="sx-form-control">내용 입력 테스트 글 입니다.</textarea>
      </div>
      <div class="btn_group sx-form-group">
        <input type="submit" name="comfirm" value="댓글등록" class="sx-btn">
        <input type="reset" name="rewrite" value="다시쓰기" class="sx-btn">
      </div>      
    </form>
  </div>

  <div class="list_panel">
    <p class="title">댓글 {$commentData.num}</p>
     <table summary="댓글 리스트 입니다.">
      <tbody>
        {foreach from=$commentData.list item=$item}
        <tr>
          <td class="clearfix">
            <div class="user_info clearfix">
              <div class="sx-user-picture pull-left"></div>
              <p class="nick_name pull-left">{$item.nickname}<br>{$item.date}</p>
            </div>
            <div class="comment_body">
              <span class="comment">{$item.comment}</span>
              <p class="btn_group">
                <a href="{$routeURI}/{$contentData.id}/delete-comment/{$item.id}" class="sx-btn sx-btn-xs"><i class="xi-heart-o"></i>좋아요(+1)</a>
                <a href="{$routeURI}/{$contentData.id}/delete-comment/{$item.id}" class="sx-btn sx-btn-xs">댓글</a>
                <a href="{$routeURI}/{$contentData.id}/delete-comment/{$item.id}" class="sx-btn sx-btn-xs">삭제</a>
              </p>
            </div>            
          </td>
        </tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>
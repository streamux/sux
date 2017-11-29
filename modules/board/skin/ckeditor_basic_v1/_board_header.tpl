{if {$groupData.board_name}}
  <div class="contents_header">
    <div class="btn_write">
      <a href="{$routeURI}/write"><i class="xi-pen-o xi-2x"><span class="sr-only">글쓰기</span></i></a>
    </div>
    <h1>{$groupData.board_name}</h1>
    <p><a href="">home</a> &gt; {$groupData.board_name}</p> 
  </div>
{/if}
  
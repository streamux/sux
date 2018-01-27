<div class="board_adminsetup {$contentData.css_progress_step}" style="width:{$groupData.width}">  
  <form action="{$routeURI}/{$contentData.id}/progress-step" name="f_progress_step" method="post">
    <input type="hidden" name="_method" value="update">
    <input type="hidden" name="category" value="{$documentData.category}">
    <input type="hidden" name="id" value="{$documentData.id}">
    <dl>
      <dt>설정상태</dt>
      <dd>
          <div class="input_group">
            {assign var='stateList' value=['진행완료','진행중','입금완료','취소중','메일발송','초기화']}
            {foreach from=$stateList item=mItem name=state}
              {assign var=index value=$smarty.foreach.state.index}
              <input type="radio" name="progress_step" id="state{$index}" value="{$mItem}"><label for="state{$index}" class="sx-text-normal">{$mItem}</label>
            {/foreach}
          </div>        
      </dd>
    </dl>
    <p class="setup_tip">※ 해당버튼을 선택하여 진행상황을 표시할 수 있습니다.</p>
    <div class="btn_group sx-form-group">   
      <input type="submit" name="submit"  value="설정" class="sx-btn">    
      <input type="cancel" value="취소" class="sx-btn">
    </div>
  </form>
</div>

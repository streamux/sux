{assign var=pagination value=$documentData.pagination}

{if $pagination.okpage != 'yes'}
	<a href="{$pagination.PHP_SELF}?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$pagination.prevpassover}&page={$pagination.befopage}&find={$requestData.find}&search={$requestData.search}&action={$requestData.action}">이전</a>	
{/if}

{section name=page start=$pagination.nowpage loop=$pagination.nowpageend}
	{assign var=index value=$smarty.section.page.index}
	{assign var=nowpassover value=$pagination.limit*($index-1)}

	{if $pagination.total > $nowpassover }
		{if $pagination.passover != $nowpassover }
			<a href="{$pagination.PHP_SELF}?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$nowpassover}&page={$pagination.page}&find={$requestData.find}&search={$requestData.search}&action={$requestData.action}">[{$index}]</a>
		{else}
			&nbsp;<span class="color-red">{$index}</span>&nbsp
		{/if}
	{/if}
{/section}

{if $pagination.total >= $pagination.hanpassoverpage }
	<a href="{$pagination.PHP_SELF}?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$pagination.newpassover}&page={$pagination.nextpage}&find={$requestData.find}&search={$requestData.search}&action={$requestData.action}">다음</a>
{/if}



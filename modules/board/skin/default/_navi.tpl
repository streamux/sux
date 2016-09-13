{if $naviData.okpage != 'yes'}
	<a href="{$naviData.PHP_SELF}?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$naviData.prevpassover}&page={$naviData.befopage}&find={$requestData.find}&search={$requestData.search}&action={$requestData.action}">이전</a>	
{/if}

{section name=page start=$naviData.nowpage loop=$naviData.nowpageend}
	{assign var=index value=$smarty.section.page.index}
	{assign var=nowpassover value=$naviData.limit*($index-1)}

	{if $naviData.total > $nowpassover }
		{if $naviData.passover != $nowpassover }
			<a href="{$naviData.PHP_SELF}?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$nowpassover}&page={$naviData.page}&find={$requestData.find}&search={$requestData.search}&action={$requestData.action}">[{$index}]</a>
		{else}
			&nbsp;<span class="color-red">{$index}</span>&nbsp
		{/if}
	{/if}
{/section}

{if $naviData.total >= $naviData.hanpassoverpage }
	<a href="{$naviData.PHP_SELF}?board={$requestData.board}&board_grg={$requestData.board_grg}&passover={$naviData.newpassover}&page={$naviData.nextpage}&find={$requestData.find}&search={$requestData.search}&action={$requestData.action}">다음</a>
{/if}



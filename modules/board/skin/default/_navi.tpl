{if $navi_data.okpage != 'yes'}
	<a href="{$navi_data.PHP_SELF}?board={$req_data.board}&board_grg={$req_data.board_grg}&passover={$navi_data.prevpassover}&page={$navi_data.befopage}&find={$req_data.find}&search={$req_data.search}&action={$req_data.action}">이전</a>	
{/if}

{section name=page start=$navi_data.nowpage loop=$navi_data.nowpageend}
	{assign var=index value=$smarty.section.page.index}
	{assign var=nowpassover value=$navi_data.limit*($index-1)}

	{if $navi_data.total > $nowpassover }
		{if $navi_data.passover != $nowpassover }
			<a href="{$navi_data.PHP_SELF}?board={$req_data.board}&board_grg={$req_data.board_grg}&passover={$nowpassover}&page={$navi_data.page}&find={$req_data.find}&search={$req_data.search}&action={$req_data.action}">[{$index}]</a>
		{else}
			&nbsp;<font color="blue">{$index}</font>&nbsp
		{/if}
	{/if}
{/section}

{if $navi_data.total >= $navi_data.hanpassoverpage }
	<a href="{$navi_data.PHP_SELF}?board={$req_data.board}&board_grg={$req_data.board_grg}&passover={$navi_data.newpassover}&page={$navi_data.nextpage}&find={$req_data.find}&search={$req_data.search}&action={$req_data.action}">다음</a>
{/if}



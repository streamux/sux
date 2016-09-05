{if $navi_data.okpage != 'yes'}
	<a href="{$navi_data.PHP_SELF}?board={$board}&board_grg={$board_grg}&passover={$navi_data.prevpassover}&page={$navi_data.befopage}&find={$find}&search={$search}&action={$action}">이전</a>	
{/if}

{section name=page start=$navi_data.nowpage loop=$navi_data.nowpageend}
	{assign var=index value=$smarty.section.page.index}
	{assign var=nowpassover value=$navi_data.limit*($index-1)}

	{if $navi_data.total > $nowpassover }
		{if $navi_data.passover != $nowpassover }
			<a href="{$navi_data.PHP_SELF}?board={$board}&board_grg={$board_grg}&passover={$nowpassover}&page={$navi_data.page}&find={$find}&search={$search}&action={$action}">[{$index}]</a>
		{else}
			&nbsp;<font color="blue">{$index}</font>&nbsp
		{/if}
	{/if}
{/section}

{if $navi_data.total >= $navi_data.hanpassoverpage }
	<a href="{$navi_data.PHP_SELF}?board={$board}&board_grg={$board_grg}&passover={$navi_data.newpassover}&page={$navi_data.nextpage}&find={$find}&search={$search}&action={$action}">다음</a>
{/if}



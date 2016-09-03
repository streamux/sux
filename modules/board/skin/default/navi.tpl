{if $okpage != 'yes'}
	<a href="{$PHP_SELF}?board={$board}&board_grg={$board_grg}&passover={$prevpassover}&page={$befopage}&find={$find}&search={$search}&action={$action}">이전</a>	
{/if}

{section name=page start=$nowpage loop=$nowpageend}
	{assign var=index value=$smarty.section.page.index}
	{assign var=nowpassover value=$limit*($index-1)}

	{if $total > $nowpassover }
		{if $passover != $nowpassover }
			<a href="{$PHP_SELF}?board={$board}&board_grg={$board_grg}&passover={$nowpassover}&page={$page}&find={$find}&search={$search}&action={$action}">[{$index}]</a>
		{else}
			&nbsp;<font color="blue">{$index}</font>&nbsp
		{/if}
	{/if}
{/section}

{if $total >= $hanpassoverpage }
	<a href="{$PHP_SELF}?board={$board}&board_grg={$board_grg}&passover={$newpassover}&page={$nextpage}&find={$find}&search={$search}&action={$action}">다음</a>
{/if}



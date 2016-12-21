{assign var=pagination value=$documentData.pagination}
{if $pagination.okpage != 'yes'}
	{if $requestData.search != ''}
		<a href="{$uri}?passover={$pagination.prevpassover}&find={$requestData.find}&search={$requestData.search}">이전</a>
	{else}
		<a href="{$uri}?passover={$pagination.prevpassover}">이전</a>
	{/if}		
{/if}

{section name=page start=$pagination.nowpage loop=$pagination.nowpageend}
	{assign var=index value=$smarty.section.page.index}
	{assign var=nowpassover value=$pagination.limit*($index-1)}

	{if $pagination.total > $nowpassover }
		{if $pagination.passover != $nowpassover }
			{if $requestData.search != ''}
				<a href="{$uri}?passover={$nowpassover}&find={$requestData.find}&search={$requestData.search}">[{$index}]</a>
			{else}
				<a href="{$uri}?passover={$nowpassover}">[{$index}]</a>
			{/if}	
		{else}
			&nbsp;<span class="color-red">{$index}</span>&nbsp
		{/if}
	{/if}
{/section}

{if $pagination.total > $pagination.hanpassoverpage }
	{if $requestData.search != ''}
		<a href="{$uri}?passover={$pagination.newpassover}&find={$requestData.find}&search={$requestData.search}">다음</a>
	{else}
		<a href="{$uri}?passover={$pagination.newpassover}">다음</a>
	{/if}
{/if}
{assign var=pagination value=$documentData.pagination}
{if $pagination.okpage != 'yes'}
	{if $requestData.search != ''}
		<a href="{$uri}?passover={$pagination.prevpassover}&find={$requestData.find}&search={$requestData.search}" class="sx-pagination-constrol sx-space-right"><i class="xi-angle-left xi-2x"></i></a>
	{else}
		<a href="{$uri}?passover={$pagination.prevpassover}" class="sx-pagination-constrol sx-space-right"><i class="xi-angle-left xi-2x"></i></a>
	{/if}		
{/if}

{section name=page start=$pagination.nowpage loop=$pagination.nowpageend}
	{assign var=index value=$smarty.section.page.index}
	{assign var=nowpassover value=$pagination.limit*($index-1)}

	{if $pagination.total > $nowpassover }
		{if $pagination.passover != $nowpassover }
			{if $requestData.search != ''}
				<a href="{$uri}?passover={$nowpassover}&find={$requestData.find}&search={$requestData.search}" class="sx-pagination"><span>{$index}</span></a>
			{else}
				<a href="{$uri}?passover={$nowpassover}" class="sx-pagination"><span>{$index}</span></a>
			{/if}	
		{else}
			<span class="sx-pagination" disabled>{$index}</span>&nbsp
		{/if}
	{/if}
{/section}

{if $pagination.total > $pagination.hanpassoverpage }
	{if $requestData.search != ''}
		<a href="{$uri}?passover={$pagination.newpassover}&find={$requestData.find}&search={$requestData.search}" class="sx-pagination-constrol sx-space-left"><i class="xi-angle-right xi-2x"></i></a>
	{else}
		<a href="{$uri}?passover={$pagination.newpassover}" class="sx-pagination-constrol sx-space-left"><i class="xi-angle-right xi-2x"></i></a>
	{/if}
{/if}
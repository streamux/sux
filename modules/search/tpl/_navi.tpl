{assign var=pagination value=$documentData.pagination}

{assign var=params value=''}
{if $requestData.search != ''}
  {$params="&search={$requestData.search}"}
{/if}

{assign var=routLink value="{$routeURI}?passover={$pagination.prevpassover}{$params}"}
{if $pagination.prevpassover <= 0}
  {$pagination.prevpassover=0}
{/if}
<a href="{$ootPath}search?passover={$pagination.prevpassover}{$params}" class="sx-pagination-control sx-space-right"><i class="xi-angle-left xi-2x"></i></a>

{section name=page start=$pagination.nowpage loop=$pagination.nowpageend}
  {assign var=index value=$smarty.section.page.index}
  {assign var=nowpassover value=$pagination.limit*($index-1)}

  {if $pagination.total > $nowpassover }
    {if $pagination.passover != $nowpassover }
      {if $requestData.search != ''}
        <a href="{$rootPath}search?passover={$nowpassover}{$params}" class="sx-pagination"><span>{$index}</span></a>
      {else}
        <a href="{$rootPath}search?passover={$nowpassover}" class="sx-pagination"><span>{$index}</span></a>
      {/if} 
    {else}
      <span class="sx-pagination" disabled>{$index}</span>&nbsp
    {/if}
  {/if}
{/section}
{if $pagination.total <= $pagination.hanpassoverpage }
  {$pagination.newpassover = $pagination.endpage}
{/if}
<a href="{$rootPath}search?passover={$pagination.newpassover}{$params}" class="sx-pagination-control sx-space-left"><i class="xi-angle-right xi-2x"></i></a>
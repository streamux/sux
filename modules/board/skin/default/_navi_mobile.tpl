{assign var=pagination value=$documentData.pagination}

{assign var=params value=''}
{if $requestData.search != ''}
  {$params="&find={$requestData.find}&search={$requestData.search}"}
{/if}

{assign var=prevpage value=$pagination.passover-$pagination.limit}
{if $prevpage <= 0}
  {$prevpage = 0}
{/if}
<a href="{$routeURI}?passover={$prevpage}{$params}" class="sx-pagination-constrol sx-space-right"><i class="xi-angle-left xi-2x"></i></a>

{$pagination.currentpage} / {$pagination.totalpage}

{assign var=nextpage value=$pagination.passover+$pagination.limit}
{if $nextpage >= $pagination.totalpage}
  {$nextpage = $pagination.totalpage}
{/if}
<a href="{$routeURI}?passover={$nextpage}{$params}" class="sx-pagination-constrol sx-space-left"><i class="xi-angle-right xi-2x"></i></a>
{assign var=pagination value=$documentData.pagination}

{assign var=params value=''}
{if $requestData.search != ''}
  {$params="&search={$requestData.search}"}
{/if}

{assign var=prevpage value=$pagination.passover-$pagination.limit}
{if $prevpage <= 0}
  {$prevpage = 0}
{/if}
<a href="{$ootPath}search?passover={$prevpage}{$params}" class="sx-pagination-control sx-space-right"><i class="xi-angle-left xi-2x"></i></a>

{$pagination.currentpage} of {$pagination.totalpage}

{assign var=passover value=$pagination.passover+$pagination.limit}
{if $passover >= $totalpage}
  {$passover = ($pagination.totalpage-1) * $pagination.limit}
{/if}
<a href="{$ootPath}search?passover={$passover}{$params}" class="sx-pagination-control sx-space-left"><i class="xi-angle-right xi-2x"></i></a>
{{$nextpage}} / {$pagination.limit} / {$pagination.totalpage}
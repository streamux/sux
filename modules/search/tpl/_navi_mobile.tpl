{assign var=pagination value=$documentData.pagination}

{assign var=params value=''}
{if $requestData.search != ''}
  {$params="&search={$requestData.search}"}
{/if}

{assign var=prevpage value=$pagination.passover-$pagination.limit}
{if $prevpage >= 0}
  <a href="{$ootPath}search?passover={$prevpage}{$params}" class="sx-pagination-control sx-space-right"><i class="xi-angle-left xi-2x"></i></a>
{else}
  <a href="#" class="sx-pagination-control unactive sx-space-right"><i class="xi-angle-left xi-2x"></i></a>
{/if}

{$pagination.currentpage} of {$pagination.totalpage}

{assign var=nextpage value=$pagination.passover+$pagination.limit}
{if $nextpage < $pagination.total}
  <a href="{$ootPath}search?passover={$nextpage}{$params}" class="sx-pagination-control sx-space-left"><i class="xi-angle-right xi-2x"></i></a>
{else}
  <a href="#" class="sx-pagination-control unactive sx-space-left"><i class="xi-angle-right xi-2x"></i></a>
{/if}
{assign var=groupData value=$documentData.group}
{assign var=contentData value=$documentData.contents}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{assign var=popupName value=$contentData.popup_name}
{include file="$headerPath" title="$popupName - StreamUX"}
<div class="wrapper">
	<div class="header">
	</div>
	<div class="container" style="padding:{$contentData.skin_top} {$contentData.skin_right} 20px {$contentData.skin_left};background-image:url('skin/{$contentData.skin}/images/bg.jpg');background-repeat:no-repeat;background-size:contain;width:{$contentData.imagesx}px;height:{$contentData.imagesy}px;">
		<div class="comment">
			{$contentData.comment}
		</div>
	</div>
	<form name="f_popup" method="post">
	<div class="footer">		
		<label for="suxpopCheckbox">오늘하루 이창을 열지 않음</label>
		<input type="checkbox" id="suxpopCheckbox" name="suxpop" value="">
		<a href="javascript:closePopup('{$contentData.popup_name}');"><img src="./skin/{$contentData.skin}/images/btn_close.gif" width="55" height="17"></a>
	</div>
	</form>
</div>
{include file="$footerPath"}
<?php
/* Smarty version 3.1.30, created on 2016-12-02 05:09:15
  from "/Applications/MAMP/htdocs/sux/modules/board/skin/default/reply.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5840f3ebe66875_64820749',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3deaf04230037cb55edb27b663eca044b7ba09d' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/board/skin/default/reply.tpl',
      1 => 1480651740,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5840f3ebe66875_64820749 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('groupData', $_smarty_tpl->tpl_vars['documentData']->value['group']);
$_smarty_tpl->_assignInScope('boardTitle', $_smarty_tpl->tpl_vars['groupData']->value['board_name']);
$_smarty_tpl->_assignInScope('contentData', $_smarty_tpl->tpl_vars['documentData']->value['contents']);
$_smarty_tpl->_assignInScope('uri', $_smarty_tpl->tpl_vars['documentData']->value['uri']);
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->tpl_vars['boardTitle']->value)." :: 게시물 답변 - StreamUX"), 0, true);
?>

<div class="board-read" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<div class="panel-heading">
		<p class="title"><?php echo $_smarty_tpl->tpl_vars['contentData']->value['title'];?>
</p>
		<p class="sub-info"><?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_name'];?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['contentData']->value['date'];?>
 &nbsp; 조회 <?php echo $_smarty_tpl->tpl_vars['contentData']->value['readed_count'];?>
</p>
	</div>
	<div class="panel-body">
		<p class="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_down'];?>
">
			<a href="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['fileup_path'];?>
"><?php echo $_smarty_tpl->tpl_vars['contentData']->value['fileup_name'];?>
&nbsp;<b>[ 다운로드 ]</b></a>
		</p>
		<p style="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['img_width'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_img'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['fileup_path'];?>
" width="100%" border="0"></p>
		<p><?php echo $_smarty_tpl->tpl_vars['contentData']->value['contents'];?>
</p>
	</div>		
</div>
<div class="board-write" style="width:<?php echo $_smarty_tpl->tpl_vars['groupData']->value['width'];?>
">
	<form action="<?php echo $_smarty_tpl->tpl_vars['uri']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['contentData']->value['id'];?>
/reply" method="post"  name="f_board_reply" enctype="multipart/form-data">
	<input type="hidden" name="_method" value="insert">
	<input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_id'];?>
">
	<input type="hidden" name="igroup_count" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['igroup_count'];?>
">
	<input type="hidden" name="space_count" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['space_count'];?>
">
	<input type="hidden" name="ssunseo_count" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['ssunseo_count'];?>
">
	<div class="panel-heading">
		<p>
			<label for="user_name" class="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_user_label'];?>
">이름</label>
			<input type="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_name_type'];?>
" name="user_name" id="user_name" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_name'];?>
">
		</p>
		<p>
			<label for="password" class="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['css_user_label'];?>
">비번</label>
			<input type="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_pass_type'];?>
" name="password" id="password" maxlength="10" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['user_password'];?>
">
		</p>
		<p>
			<label for="title">제목</label>
			<input type="text" name="title" id="title" maxlength="50" value="테스터 글">
		</p>
		<p>
			<label for="email_address">이메일</label>
			<input type="text" name="email_address" id="email_address" maxlength="28" value="streammx@naver.com">			
		</p>
	</div>
	<div class="panel-body">
		<p>
			<span class="ui-label-width"><label for="contents">내용</label></span>
			<span><input type="radio" name="type" id="radio_type_text" value="text" <?php echo $_smarty_tpl->tpl_vars['contentData']->value['comment_type_text'];?>
><label for="radio_type_text">TEXT</label></span>
			<span><input type="radio" name="type" id="radio_type_html" value="html" <?php echo $_smarty_tpl->tpl_vars['contentData']->value['comment_type_html'];?>
><label for="radio_type_html">HTML</label></span>
		</p>
		<textarea name="contents" id="contents" cols="64" rows="14">테스트 중입니다.</textarea>
	</div>
	<div class="panel-footer">
		<p class="ui-imgup">
			<label for="imgup_pick">첨부파일</label> <input type="file" name="imgup" id="imgup_pick">
		</p>
		<span class="ui-wallkey">
			<label for="wall_key">등록키 [ <span class="color-red font-weight-bold"><?php echo $_smarty_tpl->tpl_vars['contentData']->value['wallname'];?>
</span> ]</label>
			<input type="text" name="wall" id="wall_key" size="16" maxlength="20">			
			<input type="hidden" name="wallok" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['wallname'];?>
">
			<input type="hidden" name="wallwd" value="<?php echo $_smarty_tpl->tpl_vars['contentData']->value['wallkey'];?>
">
		</span>
		<span class="ui-inlineblock">등록키를 입력해주세요.</span>
	</div>
	<div class="panel-buttons">
		<input name="imageField" type="image" src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_confirm.gif" width="51" height="23" border="0">&nbsp;<a href="#" onclick="history.back();"><img src="<?php echo $_smarty_tpl->tpl_vars['skinPathList']->value['dir'];?>
/images/btn_cancel.gif" width="51" height="23" border="0"></a>
	</div>
	</form>
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}

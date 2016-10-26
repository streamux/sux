<?php
/* Smarty version 3.1.30, created on 2016-10-24 08:39:07
  from "/Applications/MAMP/htdocs/sux/modules/login/tpl/searchid_result.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580dac8b07e6d6_61233556',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bc3b43a1ed648396921d31a14c6ca1343e8ca36e' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/login/tpl/searchid_result.tpl',
      1 => 1477291145,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580dac8b07e6d6_61233556 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"아이디 찾기 결과 - StreamUX"), 0, true);
?>

<div class="article-box ui-edgebox">
	<div class="login">
		<h1 class="title">아이디 찾기 결과</h1>
		<span class="subtitle">SUX Board 솔루션을 이용해 주셔서 진심으로 감사합니다.</span>

		<div class="box ui-edgebox-2px">
			<div class="leave-header">
				<img src="tpl/images/icon_01.gif" title="">						
				<span class="ui-subtitle">조회 결과</span>
				<span class="link-searchinfo">
					<a href="login.php?action=searchID">아이디</a> | <a href="login.php?action=searchPassword">비밀번호 찾기</a>	
				</span>
			</div>
			<div class="leave-body">
				<div class="panel-info-result">
					<ul>
						<li>
							<p><?php echo $_smarty_tpl->tpl_vars['documentData']->value['user_name'];?>
님의 아이디</p>
							<p><span>' <?php echo $_smarty_tpl->tpl_vars['documentData']->value['user_id'];?>
 '</span></p>
						</li>
					</ul>				
				</div>
				<div class="panel-btn">
					<ul>
						<li data-id="confirm">확인</li>
					</ul>							
				</div>
			</div>																	
		</div>
		<div class="panel-notice">
			<ul>
				<li><span>비밀번호를 잊어버렸을 경우 비밀번호 찾기를 이용해 주시기 바랍니다.</span></li>
				<li>기타 궁금한 사항이나 질문은 Q&amp;A 게시판을 이용해 주세요.</li>
			</ul>
		</div>		
	</div>			
</div>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}

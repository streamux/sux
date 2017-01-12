<?php
/* Smarty version 3.1.30, created on 2017-01-07 10:22:31
  from "/Applications/MAMP/htdocs/sux/modules/document/tpl/home.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5870b357e40aa8_72631210',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1781482aba1da7eebbc3059646cd6073a6f290dc' => 
    array (
      0 => '/Applications/MAMP/htdocs/sux/modules/document/tpl/home.tpl',
      1 => 1483693463,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5870b357e40aa8_72631210 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('rootPath', $_smarty_tpl->tpl_vars['skinPathList']->value['root']);
$_smarty_tpl->_assignInScope('title', $_smarty_tpl->tpl_vars['groupData']->value['document_name']);
$_smarty_tpl->_assignInScope('headerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['header']);
$_smarty_tpl->_assignInScope('footerPath', $_smarty_tpl->tpl_vars['skinPathList']->value['footer']);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['headerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->tpl_vars['title']->value)." :: 홈 - STREAMUX"), 0, true);
?>

<div class="header-contents">
	<div class="swiper-container swiper-container-visual">
		<div class="swiper-wrapper">			
			<div class="swiper-slide swiper-slide-size">
				<img data-src="modules/document/tpl/images/slider_img.jpg" class="swiper-lazy">
				<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
			</div>
			<div class="swiper-slide swiper-slide-size">
				<img data-src="modules/document/tpl/images/slider_img2.jpg" class="swiper-lazy">
				<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
			</div>
			<div class="swiper-slide swiper-slide-size">
				<img data-src="modules/document/tpl/images/slider_img3.jpg" class="swiper-lazy">
				<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
			</div>
			<div class="swiper-slide swiper-slide-size">
				<img data-src="modules/document/tpl/images/slider_img4.jpg" class="swiper-lazy">
				<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
			</div>
		</div>
		<div class="swiper-pagination swiper-pagination-visual"></div>
	</div>
</div>
<div class="section contents-body">						
	<div class="article about-us">
		<h1>ABOUT US</h1>
		<p class="title">WELCOME TO STREAMUX</p>
		<p class="comment">StreamUX는 사용자 친화적인 UX에 기반을 둔 설치형 CMS입니다. 간편한 설치와 설정을 통하여 자신만의 웹페이지를 쉽고 빠르게 만들 수 있습니다.</p>		
	</div>
	<div class="article user-guide">
		<h1>USER GUIDE</h1>
		<p class="title">START UP</p>
		<ul class="clearfix">
			<li>
				<a href="modules/member/member.admin.php?action=groupList" title="회원관리 하기">
					<span>
						<i class="xi-pen xi-2x"></i>
					</span>
				</a>
				<h2>회원 관리하기</h2>
				<p>회원 관리설정을 통해 체계적으로 관리해보세요. 회원 관리 메뉴는 <a href="modules/member/member.admin.php?action=groupList">[메뉴 > 관리자 설정 클릭 > 관리자 모드 > 회원 관리]</a>에서 회원그룹을 추가 삭제할 수 있습니다.</p>
			</li>
			<li>
				<a href="modules/board/board.admin.php?action=list" title="게시판 관리하기">
					<i class="xi-home xi-2x"></i>
				</a>
				<h2>게시판 관리하기</h2>
				<p>다양한 게시판를 생성해서 관리해보세요. 게시판 관리 메뉴는 <a href="modules/board/board.admin.php?action=list">[메뉴 > 관리자 설정 클릭 > 관리자 모드 > 게시판 관리]</a>에서 게시판을 생성 후 용도에 맞게 설정할 수 있습니다.</p>
			</li>
			<li>
				<a href="modules/popup/popup.admin.php?action=list" title="팝업 관리하기">
					<i class="xi-sitemap xi-2x"></i>
				</a>
				<h2>팝업 관리하기</h2>
				<p>가장 먼저 알리고 싶은 정보가 있다면 팝업관리를 이용해 보세요. 팝업 관리 메뉴는 <a href="modules/popup/popup.admin.php?action=list">[메뉴 > 관리자 설정 클릭 > 관리자 모드 > 팝업 관리]</a>에서 팝업 추가하기를 한 후 사용할 수 있습니다.</p>
			</li>								
			<li>
				<a href="modules/analytics/analytics.admin.php?action=connecterList" title="통계 관리하기">
					<i class="xi-palette xi-2x"></i>
				</a>
				<h2>통계 관리하기</h2>
				<p>기본적인 통계 관리 기능을 제공합니다. 통계 관리 메뉴는 <a href="modules/analytics/analytics.admin.php?action=connecterList">[메뉴 > 관리자 설정 클릭 > 관리자 모드 > 통계 관리]</a>에서 키워드를 추가한 후 사용 할 수 있습니다.</p>
			</li>
		</ul>	
	</div>						
</div>
<!-- 
	@var is_page
	메인페이지 일때 앱실행
 -->
<?php echo '<script'; ?>
 type="text/javascript">
	is_page = 'main';
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['footerPath']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php }
}

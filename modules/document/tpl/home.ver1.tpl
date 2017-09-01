{assign var=rootPath value=$skinPathList.root}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="홈 -SREAMUX"}
<!-- contents start -->
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
				<a href="${rootPath}member-admin" title="회원관리 하기" target="_blank">
					<span>
						<i class="xi-group xi-2x"></i>
					</span>
				</a>
				<h2>회원 관리하기</h2>
				<p>회원 관리설정을 통해 체계적으로 관리해보세요. 회원 관리 메뉴는 <a href="${rootPath}member-admin" target="_blank">[메뉴 > 관리자 설정(톱니바퀴 아이콘) > 관리자 화면 > 회원 관리]</a>에서 회원그룹을 추가, 삭제할 수 있습니다.</p>
			</li>
			<li>
				<a href="${rootPath}board-admin" title="게시판 관리하기" target="_blank">
					<i class="xi-comment-o xi-2x"></i>
				</a>
				<h2>게시판 관리하기</h2>
				<p>다양한 게시판를 생성해서 관리해보세요. 게시판 관리 메뉴는 <a href="${rootPath}board-admin" target="_blank">[메뉴 > 관리자 설정(톱니바퀴 아이콘) > 관리자 화면 > 게시판 관리]</a>에서 게시판을 생성 후 용도에 맞게 설정할 수 있습니다.</p>
			</li>
			<li>
				<a href="${rootPath}document-admin" title="페이지 관리하기" target="_blank">
					<i class="xi-paper-o xi-2x"></i>
				</a>
				<h2>페이지 관리하기</h2>
				<p>다양한 게시판를 생성해서 관리해보세요. 게시판 관리 메뉴는 <a href="${rootPath}document-admin" target="_blank">[메뉴 > 관리자 설정(톱니바퀴 아이콘) > 관리자 화면 > 페이지 관리]</a>에서 페이지를 생성 후 직접 코딩을 입력해서 컨텐츠를 꾸밀 수 있습니다.</p>
			</li>
			<li>
				<a href="${rootPath}popup-admin" title="팝업 관리하기" target="_blank">
					<i class="xi-forum-o xi-2x"></i>
				</a>
				<h2>팝업 관리하기</h2>
				<p>가장 먼저 알리고 싶은 정보가 있다면 팝업관리를 이용해 보세요. 팝업 관리 메뉴는 <a href="${rootPath}popup-admin" target="_blank">[메뉴 > 관리자 설(톱니바퀴 아이콘) > 관리자 화면 > 팝업 관리]</a>에서 팝업 생성 후 사용할 수 있습니다.</p>
			</li>								
			<li>
				<a href="${rootPath}analytics-admin" title="통계 관리하기" target="_blank">
					<i class="xi-chart-line xi-2x"></i>
				</a>
				<h2>통계 관리하기</h2>
				<p>기본적인 통계 관리 기능을 제공합니다. 통계 관리 메뉴는 <a href="${rootPath}analytics-admin" target="_blank">[메뉴 > 관리자 설정(톱니바퀴 아이콘) > 관리자 화면 > 통계 관리]</a>에서 키워드를 추가한 후 사용 할 수 있습니다.</p>
			</li>
		</ul>	
	</div>						
</div>
<!-- 
	@var is_page
	메인페이지 일때 앱실행
 -->
<script type="text/javascript">
	is_page = 'main';
</script>
<!-- contents end -->
{include file="$footerPath"}
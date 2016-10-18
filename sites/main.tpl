{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$skinDir/_header.tpl" title="홈 - StreamUX"}
<div class="visual-device">		
	<div class="swiper-container">
		<div class="swiper-wrapper">				
			<div class="swiper-slide color-gray-e3">
				<img data-src="../images/slider_img.jpg" style="height:100%" class="swiper-lazy">
				<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
			</div>
			<div class="swiper-slide color-gray-e3">
				<img data-src="../images/slider_img2.jpg" style="height:100%" class="swiper-lazy">
				<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
			</div>
			<div class="swiper-slide color-gray-e3">
				<img data-src="../images/slider_img3.jpg" style="height:100%" class="swiper-lazy">
				<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
			</div>
			<div class="swiper-slide color-gray-e3">
				<img data-src="../images/slider_img4.jpg" style="height:100%" class="swiper-lazy">
				<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
			</div>
		</div>
		<div class="swiper-pagination"></div>
	</div>		
</div>
{include file="$skinDir/_footer.tpl"}
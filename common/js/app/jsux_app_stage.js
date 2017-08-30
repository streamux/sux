$(window).ready(function() {
	
	var gnbModel = jsux.gnb.Model.create(),
		gnbView = jsux.gnb.Menu.create("#gnb", gnbModel),
		mobileGnbView = jsux.mobileGnb.Menu.create("#mobileGnb", gnbModel),
		pageAppHandler = {},
		jsonPath = './files/gnb/gnb.json',
		menuList = null;

	gnbModel.addObserver( gnbView );
	gnbModel.addObserver( mobileGnbView );		

	jsux.mobileGnbView = mobileGnbView;
	pageAppHandler.home = {

		init: function() {
			var visualView = jsux.visual.View.create();
		}
	};
	pageAppHandler.sub = {

		init: function() {

			$(window).on('scroll touchmove mousewheel', function(e) {	
				//trace($(e.currentTarget).scrollTop());
			});

			$('.ui-bg-cover').on('scroll touchmove mousewheel', function(e) {
				e.preventDefault();
				e.stopPropagation();
				return;
			});
		}
	};

	pageAppHandler.jsonLoader = {

		load: function(path) {

			$.ajax({
				url: path,
				dataType: 'json',
				jsonpCallback: 'JSON_CALLBACK',
				success: function(json) {

					var data = json.data;
					menuList = [];
					if (data.length > 0) {						
						$.each(data, function(index, item) {
							menuList.push({
								label: data[index].name,
								link: data[index].url
							});

							if (data[index].sub && data[index].sub.length > 0) {
								menuList[index].menu = [];
								var sub = data[index].sub;
								$.each(sub, function(subIndex, suubItem) {
									menuList[index].menu.push({
										label: sub[subIndex].name,
										link: sub[subIndex].url
									});
								});
							}
						});
					}

					gnbModel.setData( menuList );
					//gnbModel.activate( 1, 2 );
					pageAppHandler.sub.init();
				}
			});
		}
	};

	var mobileMenuSlide = new Swiper('.swiper-container-mobilegnb', {
		scrollbar: '.swiper-scrollbar-mobilegnb',
		direction: 'vertical',
		slidesPerView: 'auto',
		mousewheelControl: true,
		freeMode: true
	});

	switch(is_page) {		
		case 'main':
			pageAppHandler.home.init();
			break;
		default:			
			break;			
	}
	
	pageAppHandler.jsonLoader.load(jsonPath);
});

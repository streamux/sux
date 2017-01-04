/**
 * author	streamux@naver.com
 * date 		2016.04.12
 * update	2016.12.30
 *
 * project-name 	Admin App Stage
 */

$(document).ready(function() {
		
	/**
	 * 추후 현재 Model에서 구현된 Observer기능은 별도 클래스로 분리시켜
	 * Model에서 상속받아 사용하는 구조로 만든다.
	 */
	var gnbModel = jsux.adminGnb.Model.create();
	var gnbView   = jsux.gnb.Menu.create("#gnb", gnbModel);
	//gnbView.setActivateClass('activate-admin');
	var gnbIconView = jsux.adminGnb.Icon.create("#gnbIcon", gnbModel);
	var xmlPath = '/sux/common/gnb_admin.xml';
	var pageAppHandler = {};

	gnbModel.addObserver( gnbView );
	gnbModel.addObserver( gnbIconView );  
	//gnbModel.activate( 1, 2 );

	pageAppHandler.xmlLoader = {

		load: function( path ) {

			$.ajax({
				url: path,
				dataType : "xml",
				success:function( data ) {

					if (!$(data).children().context || $(data).children().length  === 0) return;
					menuList = [];

					var menu = $(data).find('root > menu');
					if (menu.length > 0) {

						$(menu).each(function(index) {
							menuList.push({
								label: $(this).find('> label').text(),
								link: $(this).find('> link').text()
							});

							if ($(this).find('> menu').length > 0) {
								menuList[index].menu = [];								
								menu = $(this).find('> menu');
								$(menu).each(function(subIndex) {
									menuList[index].menu.push({
										label: $(this).find('> label').text(),
										link: $(this).find('> link').text()
									});
								});
							}	
						});						
					}

					gnbModel.setData( menuList );
					//gnbModel.activate( 1, 2 );
				}
			});
		}		
	};

	pageAppHandler.xmlLoader.load(xmlPath);
});
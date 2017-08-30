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
	var jsonPath = jsux.rootPath + '/assets/data/gnb_admin.json';	
	var pageAppHandler = {};

	gnbModel.addObserver( gnbView );
	gnbModel.addObserver( gnbIconView );  
	//gnbModel.activate( 1, 2 );

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
								link: data[index].router_link
							});

							if (data[index].sub && data[index].sub.length > 0) {
								menuList[index].menu = [];
								var sub = data[index].sub;
								$.each(sub, function(subIndex, suubItem) {
									menuList[index].menu.push({
										label: sub[subIndex].name,
										link: sub[subIndex].router_link
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

	pageAppHandler.jsonLoader.load(jsonPath);
});
jsux.fn = {

	datas: {pageview:null, analytics:null},
	naviManager: {	pageview:null, analytics:null, limit: 5, limitGroup: 10},
	currentTabId: 1,
	isLoading: false,

	convertJsonToObj: function( markup, id, value, func) {

		var label = id,
			data = {label: value};

		$('#'+label).empty();
		$(markup).tmpl(data, func).appendTo('#'+label);
	},
	animateStickGraph: function( target, total, hit ) {

		var MAX_WIDTH = Math.round($(target).parent().width()*0.95),
			MIN_WIDTH = 0,
			TOTAL_NUM = total,
			CURRENT_NUM = hit,
			percent = 0,
			field = null;

		percent = Math.round((95 - 0)/(TOTAL_NUM - 0)*(CURRENT_NUM - 0) + 0);
		
		field = $(target).parent().find('span');
		field.empty();
		field.css({'left':0,'width':''});

		$(target).css('width',0);
		$(target).stop();
		$(target).animate({'width':percent+'%'}, {
			duration: 1000,
			progress: function( e ) {
				
				var fw = $(this).width(),
					per = (95 - 0)/(MAX_WIDTH - 0)*(fw - 0)+0,
					txt_per = Math.floor((100 - 0)/(MAX_WIDTH - 0)*(fw - 0)+0);

				if (fw >= 30) {	
					field.css({'width': per+'%'});
				}

				field.empty();
				field.append( Math.round(txt_per)+'%' );
			}
		});
	},
	animatePageview: function() {

		var self = this;

		graphList = $('#articlesHitList .g-graph');
		$(graphList).each(function( index ) {
			self.animateStickGraph( this, self.datas.pageview[index].total, self.datas.pageview[index].hit);
		});
	},
	animateAnalytics: function() {

		var self = this;

		graphList = $('#articlesAnalyticsList .g-graph');
		$(graphList).each(function( index ) {
			self.animateStickGraph( this, self.datas.analytics[index].total, self.datas.analytics[index].hit);
		});
	},
	setDataPageview: function( json ) {

		var markup = '',
			list = '',
			z = '',
			data = this.datas.pageview = json.list;

		markup = $('#hitAnalyticsList_tmpl');

		$('#articlesHitList').empty();
		$(markup).tmpl(data, {
			getRate: function( hit, total) {

				return (hit || total) === 0 ? 0 : Math.round(hit/total*100);
			}
		}).appendTo('#articlesHitList');

		this.naviManager.pageview.setData({	total: json.total_num,
												limit: this.naviManager.limit,
												limitGroup: this.naviManager.limitGroup});	
	},
	setDataToAnalytics: function( json ) {

		var markup = '',
			list = '',
			data = this.datas.analytics = json.list;

		markup = $('#hitAnalyticsList_tmpl');
			
		$('#articlesAnalyticsList').empty();
		$(markup).tmpl(data, {
			getRate: function( hit, total) {

				return (hit || total) === 0 ? 0 : (hit/total*100);
			}
		}).appendTo('#articlesAnalyticsList');

		this.naviManager.analytics.setData({	total: json.total_num,
											limit: this.naviManager.limit,
											limitGroup: this.naviManager.limitGroup});	
	},
	setHitAnalyticsTabs: function() {

		var self = this,
			listTT = $('.ui-tab-promotion .tab-header .tt'),
			listBody = null,
			activateTab = null;

		listBody = $('.ui-tab-promotion > div');

		activateTab = function( id ) {

			var graphList = null;

			if (this.currentTabId == id) {
				return;
			}

			$(listTT).each(function(index) {

				var obj = $(this).find('div');

				if (obj.hasClass('imgbox-true')) {
					obj.removeClass('imgbox-true');
				}

				if (obj.hasClass('imgbox-false')) {
					obj.removeClass('imgbox-false');
				}					

				obj.addClass('imgbox-'+(id === index));

				if ($(listBody[index]).hasClass('activate-true')) {
					$(listBody[index]).removeClass('activate-true');
				}

				if ($(listBody[index]).hasClass('activate-false')) {
					$(listBody[index]).removeClass('activate-false');
				}

				$(listBody[index]).addClass('activate-'+(id === index));				
			});

			// id == 0 is pageview
			if (id === 0) {
				self.animatePageview();
			} else {
				self.animateAnalytics();
			}

			currentTabId = id;
		};
		
		listTT.on('click', function( e ) {

			activateTab( $(this).index() );
		});

		$(listTT[0]).trigger('click');
	},
	reloadData: function( page, limit, mod ) { 

		var self = this,
			params = {
				passover: (page-1) * limit,
				limit: limit
			},
			mode = mod + 'data';

		if (self.isLoading === true) {
			return;
		}
		self.isLoading = true;		

		jsux.getJSON('index.php?action='+mode, params, function( e )  {

			if ( e.mode == 'pageview' ) {
				self.setDataPageview( e.data );
				self.animatePageview();
			} else {
				self.setDataToAnalytics( e.data );
				self.animateAnalytics();
			}
			self.isLoading = false;
		});
	},
	setLayout: function() {

		var self = this,
			listener = {},
			params = {
				passover: 0,
				limit: this.naviManager.limit
			};

		jsux.getJSON('index.php?action=maindata', params,function( e )  {

			var markup = '',
				list = '',
				data = '';

			markup = $('#textfield_tmpl');

			list = $('.connect .box .view-type-textfield');
			$(list).each(function( index ) {

				self.convertJsonToObj( markup, this.id, e.data.connecter[this.id], {
					getUnit: function( label ) {

						return label+'회';
					}
				});
			});

			list = $('.config .box .view-type-textfield');
			$(list).each(function( index ) {

				markup = $('#textfield_tmpl');

				self.convertJsonToObj( markup, this.id, e.data.serviceConfig[this.id], {
					getUnit: function(label) {
						return label+'개';
					}
				});
			});

			list = $('.config .box .view-type-icon');
			$(list).each(function( index ) {

				if ($(this).hasClass('icon-inactivate')) {
					$(this).removeClass('icon-inactivate');
				}
				$(this).addClass('icon-'+e.data.serviceConfig[this.id]);
			});

			if (e.data.pageview.list.length > 0) {			

				listener.changeHitHandler = function( e ) {					
					self.reloadData( e.page, self.naviManager.limit, 'pageview');
				};

				self.naviManager.pageview = new BoardApp.Navi();
				self.naviManager.pageview.setUI({	el: '.pageview .ui-navi',
													id: '#hitNaviList',
													tmpl: '#NaviList_tmpl'});	
				self.naviManager.pageview.addEventListener('change', listener.changeHitHandler);
				self.setDataPageview( e.data.pageview );	
			} else {
				markup = $('#hitAnalyticsWarnMsg_tmpl');

				$('#articlesHitList').empty();
				$(markup).tmpl(e.data.pageview).appendTo('#articlesHitList');
			}

			if (e.data.connectersite.list.length > 0) {	

				listener.changeAnalyticsHandler = function( e ) {									
					self.reloadData( e.page, self.naviManager.limit, 'connectersite');
				};

				self.naviManager.analytics = new BoardApp.Navi();
				self.naviManager.analytics.setUI({	el: '.analytics .ui-navi',
													id: '#analyticsNaviList',
													tmpl: '#NaviList_tmpl'});
				self.naviManager.analytics.addEventListener('change', listener.changeAnalyticsHandler);
				self.setDataToAnalytics( e.data.connectersite );
			} else {
				markup = $('#hitAnalyticsWarnMsg_tmpl');

				$('#articlesAnalyticsList').empty();
				$(markup).tmpl(e.data.connectersite).appendTo('#articlesAnalyticsList');
			}
			
			self.setHitAnalyticsTabs();
		});
	},
	init: function() {

		this.setLayout();
	}
};
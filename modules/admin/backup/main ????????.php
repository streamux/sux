<? include "top.php"; ?>

	<div class="container">	
		<div id="myVisual" class="visual_slide">
			<ol id="indicator" class="indicator">
				<!-- templete
				<li data-target="#myVisual" data-slide-to="0"></li>
				-->
			</ol>
			<div id="inner" class="inner">        
				<div class="item" data-key="1">
					<span class="tt">Welcome!</span>
					<span class="stt">streamux.com</span>
				</div>
				<div class="item" data-key="2">
					<span class="tt">Now On Sale</span>
					<span class="stt">SUX BOARD For mobile</span>
				</div>
				<div class="item" data-key="3">
					<span class="tt">jSUX API</span>
					<span class="stt">For All Cross Platform</span>
				</div>
			</div>
		</div>

		<div class="articles ui_edgebox">

			<div class="connect">
				<h2 class="blind">접속로그현황</h2>
				<div class="tt">
					<div class="imgbox">
						<div class="g_imgbox_left"></div>
						<div class="g_imgbox_center">
							<span>접속로그현황</span>
						</div>
						<div class="g_imgbox_right"></div>      
					</div>        
				</div>  
				<div class="box">
					<div class="today_log">
						<dl>
							<dt>구분</dt>
							<dd>오늘접속</dd>
							<dd>어제접속</dd>
							<dd>전체접속</dd>
						</dl>
						<dl>
							<dt>접속수</dt>
							<dd id="today" class="view_type_textfield"></dd>
							<dd id="yester" class="view_type_textfield"></dd>
							<dd id="total" class="view_type_textfield"></dd>
						</dl>
						<dl>
							<dt>통계그래프</dt>
							<dd><div class="g_graph"><span>0%</span></div></dd>
							<dd><div class="g_graph"><span>0%</span></div></dd>
							<dd><div class="g_graph"><span>0%</span></div></dd>
						</dl>
					</div>
					<div class="real_log">
						<dl>
							<dt>구분</dt>
							<dd>오늘실접속</dd>
							<dd>어제실접속</dd>
							<dd>전체실접속</dd>
						</dl>
						<dl>
							<dt>접속수</dt>
							<dd id="real_today" class="view_type_textfield"></dd>
							<dd id="real_yester" class="view_type_textfield"></dd>
							<dd id="real_total" class="view_type_textfield"></dd>
						</dl>
						<dl>
							<dt>통계그래프</dt>
							<dd><div class="g_graph"><span>0%</span></div></dd>
							<dd><div class="g_graph"><span>0%</span></div></dd>
							<dd><div class="g_graph"><span>0%</span></div></dd>
						</dl>
					</div>
				</div>
			</div>
			<div class="hit">
				<h2 class="blind">페이지별 클릭 수</h2>
				<div class="tt">
					<div class="imgbox">
						<div class="g_imgbox_left"></div>
						<div class="g_imgbox_center">
							<span>페이지 별 클릭 수</span>
						</div>
						<div class="g_imgbox_right"></div>
					</div>
				</div>
				<div class="box">       
					<table summary="페이지 별 클릭 수 정보를 제공합니다." cellspacing="0">
						<caption><span class="blind">페이지 별 클릭 수</span></caption>
						<colgroup>
							<col width="10%">
							<col width="30%">
							<col width="20%">
							<col width="40%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col" class="p_no"><span>번호</span></th>
								<th scope="col" class="p_name"><span>페이지 이름</span></th>
								<th scope="col" class="p_hit"><span>클릭수</span></th>
								<th scope="col" class="p_graph"><span>통계그래프</span></th>
							</tr>         
						</thead>
						<tbody id="articlesHitList">
							<!--
							@ jquery templete
							@ name	hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
							-->
							<tr>
								<td colspan="4"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="analysis">
				<h2 class="blind">접속경로 분석</h2>
				<div class="tt">
					<div class="imgbox">
						<div class="g_imgbox_left"></div>
						<div class="g_imgbox_center">
							<span>접속경로 분석</span>
						</div>
						<div class="g_imgbox_right"></div>
					</div>
				</div>
				<div class="box">
					<table summary="페이지 별 클릭 수 정보를 제공합니다." cellspacing="0">
						<caption><span class="blind">페이지 별 클릭 수</span></caption>
						<colgroup>
							<col width="10%">
							<col width="30%">
							<col width="20%">
							<col width="40%">
						</colgroup>
						<thead>
							<tr>
								<th scope="col"><span>번호</span></th>
								<th scope="col" class="p_name"><span>페이지 이름</span></th>
								<th scope="col" class="p_hit"><span>클릭수</span></th>
								<th scope="col" class="p_graph"><span>통계그래프</span></th>
							</tr>         
						</thead>
						<tbody id="articlesAnalysisList">
							<!--
							@ jquery templete
							@ name	hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
							-->
							<tr>
								<td colspan="4"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="config">
				<h2 class="blind">서비스 설정 상태</h2>
				<div class="tt">
					<div class="imgbox">
						<div class="g_imgbox_left"></div>
						<div class="g_imgbox_center">
							<span>서비스 설정상태</span>
						</div>
						<div class="g_imgbox_right"></div>
					</div>
				</div>
				<div class="box">

					<div class="section_left">
						<ul>                      
							<li><span>팝업 등록</span></li>
							<li id="popupNum" class="view_type_textfield "><span>0개</span></li> 
							<li id="popupIcon" class="view_type_icon icon_inactivate"></li>
						</ul>
						<ul>        
							<li><span>접속경로 등록 </span></li>
							<li id="analysisNum" class="view_type_textfield"><span>0개</span></li> 
							<li id="analysisIcon" class="view_type_icon icon_inactivate"></li>
						</ul>
						<ul>
							<li><span>페이지뷰 등록</span></li>
							<li id="pageviewNum" class="view_type_textfield"><span>0개</span></li>
							<li id="pageviewIcon" class="view_type_icon icon_inactivate"></li>
						</ul>
					</div>
					<div class="section_right">
						<ul>
							<li><span>게시판 등록</span></li>
							<li id="boardNum" class="view_type_textfield"><span>0개</span></li>
							<li id="boardIcon" class="view_type_icon icon_inactivate"></li>
						</ul>
						<ul>
							<li><span>그룹회원 등록</span></li>
							<li id="memberNum" class="view_type_textfield"><span>0개</span></li>
							<li id="memberIcon" class="view_type_icon icon_inactivate"></li>
						</ul>						
					</div>				
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		@ StreamUX Corp
	</div>
</div>

<script type="x-jquery-templete" id="textfield_tmpl">
	<span>${$item.getUnit( label )}</span>
</script>

<script type="x-jquery-templete" id="hitAnalysisWarnMsg_tmpl">
	<tr>
		<td colspan="4"><span class="warn_msg">${msg}</span></td>
	</tr>
</script>

<script type="x-jquery-templete" id="hitAnalysisList_tmpl">
	<tr>
		<td class="p_no"><span>${no}</span></td>
		<td class="p_name"><span>${name}</span></td>
		<td class="p_hit"><span>${hit}회</span></td>
		<td class="p_graph"><div class="g_graph"><span>${$item.getRate(hit, total)}%</span></div></td>
	</tr>
</script>


<script type="text/javascript">
	
	jsuxApp.fn = {

		convertJsonToObj: function( markup, id, value, func) {

			var label = id,
				data = {label: value};

			$("#"+label).empty();
			$(markup).tmpl(data, func).appendTo("#"+label);
		},
		setEvent: function() {


		},
		setLayout: function() {

			var self = this;

			jsuxApp.getJSON("main_json.php", function( e )  {

				var markup = "",
					list = "",
					data = "";

				markup = $("#textfield_tmpl");

				list = $(".connect .box .view_type_textfield");
				$(list).each(function( index ) {

					self.convertJsonToObj( markup, this.id, e.data.connecter[this.id], {
						getUnit: function( label ) {

							return label+"회";
						}
					});
				});

				$("#articlesHitList").empty();

				if (e.data.pageview.list.length > 0) {
					markup = $("#hitAnalysisList_tmpl");
					data = e.data.pageview.list;
					
					$(markup).tmpl(data, {
						getRate: function( hit, total) {

							return (hit || total) == 0 ? 0 : (hit/total*100);
						}
					}).appendTo("#articlesHitList");		
				} else {
					markup = $("#hitAnalysisWarnMsg_tmpl");
					data = e.data.pageview;

					$(markup).tmpl(data).appendTo("#articlesHitList");	
				}
				
				if (e.data.analysis.list.length > 0) {

					markup = $("#hitAnalysisList_tmpl");
					data = e.data.analysis.list;

					$("#articlesAnalysisList").empty();
					$(markup).tmpl(data, {
						getRate: function( hit, total) {

							return (hit || total) == 0 ? 0 : (hit/total*100);
						}
					}).appendTo("#articlesAnalysisList");		
				} else {
					$("#articlesAnalysisList").empty();

					markup = $("#hitAnalysisWarnMsg_tmpl");
					data = e.data.analysis;

					$(markup).tmpl(data).appendTo("#articlesAnalysisList");	
				}

				list = $(".config .box .view_type_textfield");
				$(list).each(function( index ) {

					markup = $("#textfield_tmpl");

					self.convertJsonToObj( markup, this.id, e.data.serviceConfig[this.id], {
						getUnit: function(label) {
							return label+"개";
						}
					});
				});

				list = $(".config .box .view_type_icon");
				$(list).each(function( index ) {

					if ($(this).hasClass("icon_inactivate")) {
						$(this).removeClass("icon_inactivate")
					}
					$(this).addClass("icon_"+e.data.serviceConfig[this.id]);
				});
			});
		},
		init: function() {

			this.setLayout();
			this.setEvent();
		}
	}
</script>

<? include "bottom.php"; ?>
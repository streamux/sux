<div class="articles ui-edgebox">
  <div class="connect">
    <div class="tt">
      <div class="imgbox">
        <h1>접속로그현황</h1>  
      </div>        
    </div>  
    <div class="box">
      <table summary="접속로그현황 정보를 제공합니다.">
        <caption><span class="blind">접속로그현황</span></caption>
        <colgroup>
          <col width="45%">
          <col width="55%">
        </colgroup>
        <thead>
          <tr>
            <th scope="col">구분</th>
            <th scope="col">접속수</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>오늘접속</td>
            <td id="today" class="view-type-textfield"></td>
          </tr>
          <tr>
            <td>어제접속</td>
            <td id="yester" class="view-type-textfield"></td>
          </tr>
          <tr>
            <td>전체접속</td>
            <td id="total" class="view-type-textfield"></td>
          </tr>
        </tbody>
      </table>
      <table summary="접속로그현황 정보를 제공합니다.">
        <caption><span class="blind">접속로그현황</span></caption>
        <colgroup>
          <col width="45%">
          <col width="55%">
        </colgroup>
        <thead>
          <tr>
            <th scope="col">구분</th>
            <th scope="col">접속수</th>
          </tr>           
        </thead>
        <tbody>
          <tr>
            <td>오늘 실접속</td>
            <td id="real_today" class="view-type-textfield"></td>
          </tr>
          <tr>
            <td>어제 실접속</td>
            <td id="real_yester" class="view-type-textfield"></td>
          </tr>
          <tr>
            <td>전체 실접속</td>
            <td id="real_total" class="view-type-textfield"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="ui-tab-promotion">
    <ui class="tab-header">         
      <li class="tt">
        <div class="imgbox-true">
          <h1>페이지 별 클릭 수</h1>
        </div>                        
      </li>
      <li class="tt">
        <div class="imgbox-false">
          <h1>접속경로 분석</h1>
        </div>
      </li>
    </ui>
    <div class="pageview activate-true">       
      <table summary="페이지 별 클릭 수 정보를 제공합니다.">
        <caption><span class="blind">페이지 별 클릭 수</span></caption>
        <colgroup>
          <col width="12%">
          <col width="28%">
          <col width="20%">
          <col width="40%">
        </colgroup>
        <thead>
          <tr>
            <th scope="col" class="p-no">번호</th>
            <th scope="col" class="p-name">페이지 이름</th>
            <th scope="col" class="p-hit">클릭수</th>
            <th scope="col" class="p-graph">통계그래프</th>
          </tr>         
        </thead>
        <tbody id="articlesHitList">
          <!--
          @ jquery templete
          @ name  hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
          -->
          <tr>
            <td colspan="4"></td>
          </tr>
        </tbody>
      </table>
      <div class="sx-navi sx-navi-hide">
        <a href="#none"><span class="sx-navi-prev">이전</span></a>
        <ol id="hitNaviList" class="sx-navi-list">
          <!--
          @ templete boardNaviList_tmpl
          -->
        </ol>
        <a href="#none"><span class="sx-navi-next">다음</span></a>
      </div>
    </div>
    <div class="analytics activate-false">
      <table summary="접속경로 정보를 제공합니다.">
        <caption><span class="blind">접속경로분석</span></caption>
        <colgroup>
          <col width="12%">
          <col width="28%">
          <col width="20%">
          <col width="40%">
        </colgroup>
        <thead>
          <tr>
            <th scope="col">번호</th>
            <th scope="col" class="p-name">접속키워드</th>
            <th scope="col" class="p-hit">클릭수</th>
            <th scope="col" class="p-graph">통계그래프</th>
          </tr>         
        </thead>
        <tbody id="articlesAnalyticsList">
          <!--
          @ jquery templete
          @ name  hitAnalysisWarnMsg_tmpl, hitAnalysisList_tmpl
          -->
          <tr>
            <td colspan="4"></td>
          </tr>
        </tbody>
      </table>
      <div class="sx-navi sx-navi-hide">
        <a href="#none"><span class="sx-navi-prev">이전</span></a>
        <ol id="analyticsNaviList" class="sx-navi-list">
          <!--
          @ templete AnalysisNaviList_tmpl
          -->
        </ol>
        <a href="#none"><span class="sx-navi-next">다음</span></a>
      </div>
    </div>
  </div>
  <div class="config">
    <div class="tt">
      <div class="imgbox">
        <h1>서비스 설정상태</h1>
      </div>
    </div>
    <div class="box">
      <table summary="서비스 설정 상태정보를 제공합니다.">
        <caption><span class="hide">서비스 설정 상태</span></caption>
        <colgroup>
          <col width="27%">
          <col width="13%">
          <col width="10%">
          <col width="27%">
          <col width="13%">
          <col width="10%">
        </colgroup>
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>팝업등록</td>
            <td id="popupNum" class="view-type-textfield"></td>
            <td id="popupIcon" class="view-type-icon icon-inactivate"></td>
            <td>게시판등록</td>
            <td id="boardNum" class="view-type-textfield"></td>
            <td id="boardIcon" class="view-type-icon icon-inactivate"></td>
          </tr>
          <tr>
            <td>접속키워드등록</td>
            <td  id="analysisNum" class="view-type-textfield"></td>
            <td id="analysisIcon" class="view-type-icon icon-inactivate"></td>
            <td>그룹회원</td>
            <td id="memberNum" class="view-type-textfield"></td>
            <td id="memberIcon" class="view-type-icon icon-inactivate"></td>
          </tr>
          <tr>
            <td>페이지뷰등록</td>
            <td id="pageviewNum" class="view-type-textfield"></td>
            <td id="pageviewIcon" class="view-type-icon icon-inactivate"></td>
            <td colspan="3"></td>
          </tr>
        </tbody>
      </table>      
    </div>
  </div>
</div>  
<script type="x-jquery-templete" id="textfield_tmpl">
{literal}
  <span>${$item.getUnit( label )}</span>
{/literal}
</script>
<script type="x-jquery-templete" id="hitAnalyticsWarnMsg_tmpl">
{literal}
  <tr>
    <td colspan="4" style="border-bottom-style:none"><span class="warn-msg">${msg}</span></td>
  </tr>
{/literal}
</script>
<script type="x-jquery-templete" id="hitAnalyticsList_tmpl">
{literal}
  <tr>
    <td class="p-no">${no}</td>
    <td class="p-name">${name}</td>
    <td class="p-hit">${hit}회</td>
    <td class="p-graph"><div class="g-graph"></div><span>0%</span></td>
  </tr>
{/literal}
</script>
<script type="x-jquery-templete" id="NaviList_tmpl">
{literal}
  <li><a href="#none"><span>${no}</span></a></li>
{/literal}
</script>
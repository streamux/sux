<div class="sx-contents sx-admin-main">
  <section class="sx-popup-panel">
    <h1 class="title">팝업 추가</h1>
    <div class="sx-box-content">
      <form action="{$rootPath}popup-admin/add" class="sx-form-horizontal">
        <input type="hidden" name="_method" value="insert">
        <input type="hidden" name="skin_path" value="{$rootPath}popup-admin/skin-json">
        <input type="hidden" name="location_back" value="{$rootPath}popup-admin">

        <p class="text_notice">
          <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" class="icon_notice"><span class="sx-text-notice">*(별표)는 필수 입력 사항입니다.</span>
        </p>        
        <div class="sx-form-group">
          <label for="popupName" class="sx-control-label label_width">*팝업이름</label>
          <input type="text" name="popup_name" id="popupName" size="20" maxlength="20" class="sx-form-control">
        </div>
        <div class="sx-form-group">
          <label for="popupTitle" class="sx-control-label label_width">제목</label>
          <input type="text" name="popup_title" id="popupTitle" size="30" maxlength="30" class="sx-form-control">
        </div>
        <div class="sx-form-group">
          <label for="isUsable" class="sx-control-label label_width">노출</label>
          <select name="is_usable" id="isUsable" class="sx-form-control">
            <option value="n">n</option>
            <option value="y">y</option>
          </select>
        </div>
        <div class="sx-form-inline">
          <label for="emptyInput" class="sx-control-label label_width">노출 기간</label>
          <div class="sx-form-group">
            <label for="periodYear" class="sx-control-label">연도</label>
            <select name="time_year" id="periodYear" class="sx-form-control">
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
              <option value="2027">2027</option>
              <option value="2028">2028</option>
              <option value="2029">2029</option>
            </select>
            <label for="timeMonth" class="sx-control-label">월</label>
            <select name="time_month" id="timeMonth" class="sx-form-control">
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
           <label for="periodDay" class="sx-control-label">일</label>
           <select name="time_day" id="timeDay" class="sx-form-control">
             <option value="1">1</option>
             <option value="2">2</option>
             <option value="3">3</option>
             <option value="4">4</option>
             <option value="5">5</option>
             <option value="6">6</option>
             <option value="7">7</option>
             <option value="8">8</option>
             <option value="9">9</option>
             <option value="10">10</option>
             <option value="11">11</option>
             <option value="12">12</option>
             <option value="13">13</option>
             <option value="14">14</option>
             <option value="15">15</option>
             <option value="16">16</option>
             <option value="17">17</option>
             <option value="18">18</option>
             <option value="19">19</option>
             <option value="20">20</option>
             <option value="21">21</option>
             <option value="22">22</option>
             <option value="23">23</option>
             <option value="24">24</option>
             <option value="25">25</option>
             <option value="26">26</option>
             <option value="27">27</option>
             <option value="28">28</option>
             <option value="29">29</option>
             <option value="30">30</option>
             <option value="31">31</option>
           </select>
           <label for="periodHours" class="sx-control-label">시</label>
            <input type="text" id="periodHours" name="time_hours" size="2" maxlength="2" value="13" class="sx-form-control">
            <label for="periodMinutes" class="sx-control-label">분</label>
            <input type="text" id="periodMinutes" name="time_minutes" size="2" maxlength="2" value="30" class="sx-form-control">
            <label for="periodSeconds" class="sx-control-label">초</label>            
            <input type="text" id="periodSeconds" name="time_seconds" size="2" maxlength="2" value="00" class="sx-form-control">
            까지      
          </div>          
          <p class="text_caption">※ 팝업 노출 종료 시간을 설정하세요.</p>     
        </div>
        <div class="sx-form-group">
          <label for="popupSkin" class="sx-control-label label_width">스킨</label>
          <select id="popupSkin" name="skin" id="skinList" class="sx-form-control">
            {foreach from=$documentData.skin_list item=$item}
            <option>{$item.file_name}</option>
            {/foreach}
          </select>
        </div>
        <div class="sx-form-inline">
          <label for="emptyInput" class="sx-control-label label_width">팝업 크기</label>
          <div class="sx-form-group">
            <label for="popupWidth" class="sx-control-label">넓이</label>
            <input type="text" id="popupWidth" name="popup_width" size="4" maxlength="3" value="100" class="sx-form-control">
            <label for="popupHeight" class="sx-control-label">높이</label>
            <input type="text" id="popupHeight" name="popup_height" size="4" maxlength="3" value="300" class="sx-form-control">
          </div>
        </div>
        <div class="sx-form-inline">
          <label for="emptyInput" class="sx-control-label label_width">팝업위치</label>
          <div class="sx-form-group">
            <label for="popupTop" class="sx-control-label">상단</label>
            <input type="text" id="popupTop" name="popup_top" size="4" maxlength="3" value="0" class="sx-form-control">
            <label for="popupLeft" class="sx-control-label">좌측</label>
            <input type="text" id="popupLeft" name="popup_left" size="4" maxlength="3" value="0" class="sx-form-control">            
          </div>
          <p class="text_caption">※ 모니터 기준</p> 
        </div>
        <div class="sx-form-inline">
          <label for="emptyInput" class="sx-control-label label_width">내용여백</label>
          <div class="sx-form-group">
            <label for="skinTop" class="sx-control-label">상단</label>
            <input type="text" id="skinTop" name="skin_top" size="4" maxlength="3" value="50" class="sx-form-control">
            <label for="skinLeft" class="sx-control-label">좌측</label>
            <input type="text" id="skinLeft" name="skin_left" size="4" maxlength="3" value="25" class="sx-form-control">
            <label for="skinRight" class="sx-control-label">우측</label>
            <input type="text" id="skinRight" name="skin_right" size="4" maxlength="3" value="25" class="sx-form-control">
          </div>
        </div>
        <div class="sx-form-form">
          <label for="popupContents" class="sx-control-label label_width">내용</label>
          <textarea id="popupContents" name="contents" cols="25" rows="6" class="sx-form-control"></textarea>
          <p class="text_caption">※ 팝업에 들어갈 내용을 입력해주세요.</p>       
        </div>
        <div class="row btn_group text-center">
          <input type="submit" id="btnConfirm" class="sx-btn" value="확인">
          <a href="#" id="btnCancel" class="sx-btn">취소</a>
        </div>
      </form>
    </div>    
  </section>
</div>
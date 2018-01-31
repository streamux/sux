<div class="sx-wrapper">
  <div class="sx-header">
    <h1 class="logo">
      <img class="logo" src="{$rootPath}modules/install/tpl/images/logo.png" alt="streamxux"> 
    </h1> 
  </div>
  <div class="sx-container"> 
    <form name="f_setup_db" action="{$rootPath}setup-db" method="post" class="sx-form-horizontal">
      <input type="hidden" name="_method" value="insert"> 
      <div class="terms_box sx-edgebox">
        <h1>데이터베이스 설정</h1>

        <div class="sx-form-group">
          <label for="dbHostName" class="sx-control-label">호스트 주소</label>
          <input type="text" id="dbHostName" name="db_hostname" value="localhost" class="sx-form-control">
        </div>
        <div class="sx-form-group">
          <label for="dbUserid" class="sx-control-label">데이터베이스 계정</label>
          <input type="text" id="dbUserid" name="db_userid" class="sx-form-control" value="" placeholder="ID">
        </div>
        <div class="sx-form-group">
          <label for="dbPassword" class="sx-control-label">비밀번호</label>
          <input type="password" id="dbPassword" name="db_password" class="sx-form-control" value="" placeholder="Password">
        </div>
        <div class="sx-form-group">
          <label for="dbDatabase" class="sx-control-label">데이터베이스 이름</label>
          <input type="text" id="dbDatabase" name="db_database" class="sx-form-control" value="" placeholder="Database Name">
        </div>
        <div class="sx-form-group">
          <label for="dbTablePrefix" class="sx-control-label">테이블 접두사</label>
          <input type="text" id="dbTablePrefix" name="db_table_prefix" value="sux_" class="sx-form-control">
        </div>
      </div>
      <input type="submit" value=' 다 음 ' class="sx-btn">
    </form>
  </div>
  <div class="sx-footer">
    {include file="$copyrightPath"}
  </div>
</div>
<div class="ui-panel-msg"></div>
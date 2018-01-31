      <div class="sx-content sx-admin-main">
        <section class="sx-member-panel">
          <h1 class="title">회원정보 수정</h1>
          <div class="sx-box-content">
            <form action="{$rootPath}member-admin/modify" class="sx-form-horizontal">
              <input type="hidden" name="_method" value="update">
              <input type="hidden" name="category" value="{$documentData.category}">
              <input type="hidden" name="user_id" value="{$documentData.user_id}">
              <input type="hidden" name="id" value="{$documentData.id}">
              <input type="hidden" name="modify_info_path" value="{$rootPath}member-admin/modify-json">
              <input type="hidden" name="location_back" value="{$rootPath}member-admin/list">

              <p class="text_notice">
                <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" class="icon_notice"><span class="sx-text-notice">*(별표)는 필수 입력 사항입니다.</span>
              </p>
              <div class="sx-form-group">
                <label for="category" class="sx-control-label label_width">회원 그룹 *</label>
                <select name="category" id="category" class="sx-form-control">
                  {foreach from=$documentData.categories item=value}
                    <option value="{$value.category}" {if $documentData.category === $value.category} selected="selected" {/if}>{$value.category}</option>
                  {/foreach}
                </select>
              </div>
              <div class="sx-form-group">
                <label for="" class="sx-control-label label_width">아이디</label>
                <span class="sx-form-control" disabled="disabled">{$documentData.user_id}</span>
              </div>
              <div class="sx-form-group">
                <label for="password" class="sx-control-label label_width">비밀번호 *</label>
                <input type="password" id="password" name="password" class="sx-form-control">
                <input type="button" id="btnChangePassword" name="btn_change_password" value="변경하기" class="sx-btn sx-btn-block">
              </div>
              <div id="panelNewPassword" class="panel_newpassword">
                <div class="sx-form-group">
                  <label for="newPassword" class="sx-control-label label_width">신규 비밀번호 *</label>
                  <input type="password" id="newPassword" name="new_password" maxlength="23" class="sx-form-control">
                </div>
                <div class="sx-form-group">
                  <label for="newPasswordConf" class="sx-control-label label_width">신규 비밀번호 확인 *</label>
                  <input type="password" id="newPasswordConf" name="new_password_conf" maxlength="23" class="sx-form-control">
                </div>
              </div>
              <div class="sx-form-group">
                <label for="nickName" class="sx-control label_width">닉네임 *</label>
                <input type="text" id="nickName" name="nickname" class="sx-form-control">
              </div>
              <div class="sx-form-group">
                <label for="emailAddress" class="sx-control label_width">이메일 *</label>
                <input type="text" id="emailAddress" name="email_address" class="sx-form-control">
              </div>
              <p class="text_notice">
                <img src="{$rootPath}modules/admin/tpl/images/icon_notice.gif" class="icon_notice">
                <span>아래 내용은 선택사항입니다.</span>
              </p>
              <div class="sx-form-group">
                <label for="userName" class="sx-control label_width">이름</label>
                <input type="text" id="userName" name="user_name" class="sx-form-control">
              </div>               
              <div class="sx-form-group">
                <label for="hp" class="sx-control label_width">휴대폰 번호</label>
                <input type="text" id="hp" name="hp" class="sx-form-control">
              </div>
              <div class="sx-form-group">
                <label for="job" class="sx-control-label label_width">직업</label>
                <select id="job" name=job class="sx-form-control">
                  <option value="" selected="selected">선택하기</option>
                  <option value=프리랜서>프리랜서</option>
                  <option value=교수>교수</option>
                  <option value=교사>교사</option>
                  <option value=학생>학생</option>
                  <option value=기업인>기업인</option>
                  <option value=회사원>회사원</option>
                  <option value=정치인>정치인</option>
                  <option value=주부>주부</option>
                  <option value=농어업>농어업</option>
                  <option value=기타>기타</option>
               </select>
              </div>
              <div class="sx-form-inline">
                <label for="" class="sx-control-label label_width">취미</label>
                <div class="sx-input-group">
                    <input type="checkbox" id="hoby1" name="hobby0" value="인터넷"><label for="hoby1" class="sx-control-label">인터넷</label>
                    <input type="checkbox" id="hoby2" name="hobby1" value="독서" ><label for="hoby2" class="sx-control-label">독서</label>
                    <input type="checkbox" id="hoby3" name="hobby2" value="여행" ><label for="hoby3" class="sx-control-label">여행</label>
                    <input type="checkbox" id="hoby4" name="hobby3" value="낚시" ><label for="hoby4" class="sx-control-label">낚시</label>
                    <input type="checkbox" id="hoby5" name="hobby4" value="바둑" ><label for="hoby5" class="sx-control-label">바둑</label>
                    <input type="checkbox" id="hoby6" name="hobby5" value="기타" ><label for="hoby6" class="sx-control-label">기타</label>             
                </div>
              </div>
              <div class="sx-form-group">
                <label for="joinPath" class="sx-control-label label_width">가입경로</label>
                <select id="joinPath" name="join_path" class="sx-form-control">
                  <option value="">선택하기</option>
                  <option value=키워드검색>키워드검색</option>
                  <option value=네이버지식인>네이버지식인</option>
                  <option value=다음카페>다음카페</option>
                  <option value=학교소개>학교소개</option>
                  <option value=주변소개>주변소개</option>
                  <option value=차량광고>차량광고</option>
                  <option value=기타>기타</option>
                </select>
              </div>
              <div class="sx-form-group">
                <label for="recommendId" class="sx-control-label label_width">추천 아이디</label>
                <input type="text" id="recommendId" name="recommend_id" maxlength="20" class="sx-form-control">
              </div>
              <div class="sx-form-group">
                <label for="point" class="sx-control-label label_width">포인트</label>
                <input type="text" id="point" name="point" size="6" maxlength="5" class="sx-form-control">
              </div>
              <div class="sx-form-group">
                <label for="grade" class="sx-control-label label_width">레벨</label>
                <input type="text" id="grade" name="grade" size="3" maxlength="2" class="sx-form-control">
              </div>
              <div class="sx-form-group">
                <label for="isWritable" class="sx-control-label label_width">쓰기 허용</label>
                <select id="isWritable" name="is_writable" class="sx-form-control">
                  <option value="yes" selected="selected">yes</option>
                  <option value="no">no</option>
                </select>
              </div>
              <div class="sx-form-group">
                <label for="isKickout" class="sx-control-label label_width">추방 유무</label>
                <select id="isKickout" name="is_kickout" class="sx-form-control">
                  <option value="no">no</option>
                  <option value="yes">yes</option>                
                </select>
              </div>
              <div class="sx-form-group">
                <label for="emptyName" class="sx-control-label label_width">가입 날자</label>
                <span id="date" class="sx-form-control view-type-textfield" disabled="disabled">
                  <!--
                  @ jquery templete
                  @ name  memberLabel_tmpl
                  -->  
                </span>
                </span>
              </div>
              <div class="sx-form-group">
                <label for="emptyName" class="sx-control-label label_width">IP</label>
                <span id="ip" class="sx-form-control view-type-textfield" disabled="disabled">
                  <!--
                  @ jquery templete
                  @ name  memberLabel_tmpl
                  -->  
                </span>
              </div>
              <div class="row btn_group text-center">
                <input type="submit" id="btnConfirm" class="sx-btn" value="확인">
                <a href="#" id="btnCancel" class="sx-btn">취소</a>
              </div>
            </form>            
          </div>
        </section>
      </div>
<script type="text/jquery-templete" id="memberLabel_tmpl">
{literal}
  ${label}
{/literal}
</script>
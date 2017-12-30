<?PHP
class MenuAdminController extends Controller
{
  function insertMenu() {

    $msg = '';
    $resultYN = 'Y';
    $json = array('data'=>array());

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $menuName = $posts['menu_name'];
    if (!(isset($menuName) && $menuName)) {
      $msg = '이름을 입력해주세요.';
      $resultYN = 'N';
    } else {

      $menu_id = 'menu_id' . Utils::getMicrotimeInt();

      $where = new QueryWhere();
      $where->set('menu_id', $menu_id);
      $this->model->select('menu', 'id', $where);

      $num = $this->model->getNumRows();
      if ($num > 0) {
        $msg .= "${menuName}은 이름이 이미 존재합니다.<br>";
        $resultYN = 'N';
      } else {

        $columns = array();
        $columns[] = '';
        $columns[] = $menu_id;
        $columns[] = $menuName;
        $columns[] = $menu_id;
        $columns[] = 0;
        $columns[] = 'now()';

        $result = $this->model->insert('menu', $columns);
        if ($result) {
          $msg .= "메뉴 등록을 완료하였습니다.";
          $resultYN = 'Y';

          $where = new QueryWhere();
          $where->set('menu_id', $menu_id);
          $this->model->select('menu', '*', $where);
          
          $json['data'] = $this->model->getRows();
        } else {
          $msg .= "메뉴 등록을 실패하였습니다.";
          $resultYN = 'N';
        }
      } 
    }

    $json['msg'] .= $msg;
    $json['result'] = $resultYN;

    $this->callback($json);
  }

  function updateMenu() {

    $msg = '';
    $resultYN = 'Y';
    $json = array('data'=>array());

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $id = $posts['id'];
    $menuName = $posts['menuName'];
    $url = $posts['url'];
    $isActive = (int) $posts['is_active'];

    $columns = array();
    $columns['name'] = $menuName;
    $columns['url'] = $url;
    $columns['is_active'] = $isActive;

    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->update('menu', $columns, $where);
    if ($result) {
      $msg .= '메뉴 수정 완료하였습니다.';
      $resultYN = 'Y';
      
      $this->model->select('menu', '*', $where);
      $row = $this->model->getRow();
    } else {
      $msg .= '메뉴 수정을 실패하였습니다.';
      $resultYN = 'N';
    }

    //$msg .= Tracer::getInstance()->getMessage();
    $json['data'] = $row;
    $json['msg'] = $msg;
    $json['result'] = $resultYN;

    $this->callback($json);
  }

  function deleteMenu() {

    $msg = '';
    $resultYN = 'Y';
    $json = array('data'=>array());

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $id = $posts['id'];
    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->delete('menu', $where);
    if ($result) {
      $msg .= '메뉴 삭제를 완료하였습니다.';
      $resultYN = 'Y';
    } else {
      $msg .= '메뉴 삭제를 실패하였습니다.';
      $resultYN = 'N';
    }

    $json['msg'] = $msg;
    $json['result'] = $resultYN;

    $this->callback($json);
  }

  function insertSaveJson() {

    $msg = "";
    $resultYN = "Y";
    $data = array();

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $jsonData = $posts['data'];

    $callback = $context->getRequest('callback');
    $strcallback = strtolower($callback);

    //$contents_path = '/assets/data/gnb.php';
    $realPath = _SUX_PATH_ ;
    $contents_path = '/files/gnb/gnb.json';
    $filePath = Utils::convertAbsolutePath($contents_path, $realPath);
    
    $result = FileHandler::writeFile($filePath, $jsonData);
    if (!$result) {
      $msg .= "메뉴파일 저장을 실패하였습니다.<br>";
      $resultYN = 'N';
    }

    function convertMultiToArray($arr) {

      if (empty($GLOBALS['menuList'])) {
        global $menuList;
        $menuList = array();
      }

      $arr = Utils::convertArrayToObject($arr);
      for($i=0; $i<count($arr); $i++) {
        if ($arr[$i]['sid'] > 0) {
          $menuList[] = $arr[$i]['sid']; // sub id label
        } else {
          $menuList[] = $arr[$i]['id']; // id label
        }        

        if (isset($arr[$i]['sub']) && $arr[$i]['sub'] && count($arr[$i]['sub']) > 0) {          
          convertMultiToArray($arr[$i]['sub']);
        }
      } //end of for
    } // end of func

    // reset
    $columns['is_active'] = 0;
    $result = $this->model->update('menu', $columns);

    $columns = array();
    $menuArr = Utils::convertJsonToArray($jsonData);

    if (count($menuArr['data']) > 0) {
      convertMultiToArray($menuArr['data']);

      // 동일한 값 합치기
      $menuList = array_unique($GLOBALS['menuList']);
      $GLOBALS['menuList'] = null;

      $where = new QueryWhere();
      foreach ($menuList as $key => $value) {
        $where->set('id', $value, '=', 'or');
      }
      $columns['is_active'] = 1;
      $result = $this->model->update('menu', $columns, $where);
      if ($result) {
        $msg .= '메뉴 수정을 완료하였습니다.';
        $resultYN = 'Y';
      } else {
        $msg .= '메뉴 수정을 실패하였습니다.';
        $resultYN = 'N';
      }
    } // end of if
      
    $data = json_decode($jsonData, true);
    $data['result'] = $resultYN;
    $data['msg'] = $msg;

    $this->callback($data);
  }
}
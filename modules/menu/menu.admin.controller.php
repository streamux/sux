<?PHP
class MenuAdminController extends Controller
{
	function insertMenu() {

		$msg = '';
		$resultYN = 'Y';
		$json = array('data'=>array());

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$prefix = $context->getPrefix();

		$name = trim($posts['name']);
		$category = $prefix . substr(md5($name),0, 12);

		if (!(isset($name) && $name)) {
			$msg = '이름을 입력해주세요.';
			$resultYN = 'N';
		} else {

			$where = new QueryWhere();
			$where->set('category', $category);
			$this->model->select('menu', 'id', $where);
			$num = $this->model->getNumRows();
			if ($num > 0) {
				$msg .= "${name}은 이름이 이미 존재합니다.<br>";
				$resultYN = 'N';
			} else {

				$columns = array();
				$columns[] = '';
				$columns[] = $category;
				$columns[] = $name;
				$columns[] = '';
				$columns[] = 'now()';
				$result = $this->model->insert('menu', $columns);
				if (!$result) {
					$msg = "메뉴 등록을 실패하였습니다.";
					$resultYN = 'N';
				} else {
					$where = new QueryWhere();
					$where->set('category', $category);
					$this->model->select('menu', '*', $where);
					$json['data'] = $this->model->getRows();
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
		$url = $posts['url'];

		$columns = array();
		$columns['url'] = $url;

		$where = new QueryWhere();
		$where->set('id', $id);
		$result = $this->model->update('menu', $columns, $where);
		if (!$result) {
			$msg .= '메뉴 수정을 실패하였습니다.';
			$resultYN = 'N';
		}
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
		if (!$result) {
			$msg .= '메뉴 삭제를 실패하였습니다.';
			$resultYN = 'Y';
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
		} else {
			$msg .= "메뉴파일 저장을 완료하였습니다.<br>";
			$resultYN = 'Y';
		}

		$data = json_decode($posts['data'], true);
		$data['result'] = $resultYN;
		$data['msg'] = $msg;

		$this->callback($data);
	}
}
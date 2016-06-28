<?PHP

class TemplateLoader {

	protected $file;
	protected $values = array();
	protected $data = NULL;

	private static $templateFile = null;

	function __construct($file) {

		$this->file = $file;
	}

	function set($key, $value) {

		$this->values[$key] = $value;
	}

	function load($op=NULL) {

		if (!file_exists($this->file)) {
			return 'Error loading template file ($this->file).';
		}

		ob_start();
		include_once($this->file);
		$data = ob_get_clean();

		foreach ($this->values as $key => $value) {
			$data = str_replace('${'.$key.'}', $value, $data);
		}

		if (strtolower($op) === 'hide') {
			return $data;
		}
		echo $data;
	}
}
?>

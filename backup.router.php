<?php
include_once 'libs/epiphany/Epi.php';
Epi::setPath('base','libs/epiphany');
Epi::init('route');
// Epi::init('base','cache','session');
// Epi::init('base','cache-apc','session-apc');
// Epi::init('base','cache-memcached','session-apc');
/*
 * This is a sample page whch uses EpiCode.
 * There is a .htaccess file which uses mod_rewrite to redirect all requests to index.php while preserving GET parameters.
 * The $_['routes'] array defines all uris which are handled by EpiCode.
 * EpiCode traverses back along the path until it finds a matching page.
 *  i.e. If the uri is /foo/bar and only 'foo' is defined then it will execute that route's action.
 * It is highly recommended to define a default route of '' for the home page or root of the site (yoursite.com/).
 */
getRoute()->get('/', array('MyClass', 'MyMethod'));
getRoute()->get('/sample', array('MyClass', 'MyOtherMethod'));
getRoute()->get('/sample/source', array('MyClass', 'ViewSource'));
getRoute()->post('/board-name/comment', array('MyClass', 'driveRequestMethod'));
getRoute()->post('/board-name/(\d+)/comment', array('MyClass', 'driveRequestMethod'));
getRoute()->post('/board-name/(\d+)/comment/(\d+)', array('MyClass', 'driveRequestMethod'));
/*getRoute()->put('/board-name/source', array('MyClass', 'UpdateSource'));
getRoute()->delete('/board-name/source', array('MyClass', 'DeleteSource'));*/
getRoute()->run(); 

/*
 * ******************************************************************************************
 * Define functions and classes which are executed by EpiCode based on the $_['routes'] array
 * ******************************************************************************************
 */
class MyClass
{
	static public function MyMethod()
	{
		echo '<h1>You are looking at the output from MyClass::MyMethod</h1>
					<ul>
						<li><a href="/sux/">Call MyClass::MyMethod</a></li>
						<li><a href="/sux/sample">Call MyClass::MyOtherMethod</a></li>
						<li><a href="/sux/sample/source">View the source of this page</a></li>
						<li>
							<form action="/sux/board-name/21/comment" method="POST" accept-charset="utf-8">
								<input type="submit" name="btn-write" value="Write the comment of this page" placeholder="">
							</form>
						</li>
						<li>
							<form action="/sux/board-name/comment" method="POST" accept-charset="utf-8">
								<input type="hidden" name="_method" value="put" />
								<input type="submit" name="btn-del" value="Update the comment of this page" placeholder="">
							</form>
						</li>
						<li>
							<form action="/sux/board-name/comment" method="POST" accept-charset="utf-8">
								<input type="hidden" name="_method" value="delete" />
								<input type="submit" name="btn-del" value="Delete the comment of this page" placeholder="">
							</form>
						</li>
					</ul>';
	}
	static public function MyOtherMethod()
	{
		echo '<h1>You are looking at the output from MyClass::MyOtherMethod</h1>
				<ul>
					<li><a href="/sux/">Call MyClass::MyMethod</a></li>
					<li><a href="/sux/sample">Call MyClass::MyOtherMethod</a></li>
					<li><a href="/sux/sample/source">View the source of this page</a></li>
					<li>
						<form action="/sux/board-name/comment" method="POST" accept-charset="utf-8">
							<input type="submit" name="btn-write" value="Write the comment of this page" placeholder="">
						</form>
					</li>
					<li>
						<form action="/sux/board-name/comment" method="POST" accept-charset="utf-8">
							<input type="hidden" name="_method" value="put" />
							<input type="submit" name="btn-del" value="Update the comment of this page" placeholder="">
						</form>
					</li>
					<li>
						<form action="/sux/board-name/comment" method="POST" accept-charset="utf-8">
							<input type="hidden" name="_method" value="delete" />
							<input type="submit" name="btn-del" value="Delete the comment of this page" placeholder="">
						</form>
					</li>
				</ul>
				<p><img src="http://www.google.com/images/logos/ps_logo2.png"></p>';
	}
	static public function ViewSource()
	{
		echo '<h1>You are looking at the output from MyClass::ViewSource</h1>
				<ul>
					<li><a href="/sux/">Call MyClass::MyMethod</a></li>
					<li><a href="/sux/sample">Call MyClass::MyOtherMethod</a></li>
					<li><a href="/sux/sample/source">View the source of this page</a></li>
					<li>
						<form action="/sux/board-name/comment" method="POST" accept-charset="utf-8">
							<input type="submit" name="btn-write" value="Write the comment of this page" placeholder="">
						</form>
					</li>
					<li>
						<form action="/sux/board-name/comment" method="POST" accept-charset="utf-8">
							<input type="hidden" name="_method" value="put" />
							<input type="submit" name="btn-del" value="Update the comment of this page" placeholder="">
						</form>
					</li>
					<li>
						<form action="/sux/board-name/comment" method="POST" accept-charset="utf-8">
							<input type="hidden" name="_method" value="delete" />
							<input type="submit" name="btn-del" value="Delete the comment of this page" placeholder="">
						</form>
					</li>
				</ul>';
		/*highlight_file(__FILE__);*/
	}
	static public function driveRequestMethod( $param, $param2 )
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$httpMethod = strtolower($_POST['_method']);

		if ($httpMethod === 'post' || $httpMethod === '') {
			$titleStr = '글쓰기';
		} else if ($httpMethod === 'put' || $httpMethod === 'update') {
			$titleStr = '업데이트';
		} else if ($httpMethod === 'delete') {
			$titleStr = '삭제';
		}

		if (!isset($httpMethod) || $httpMethod === '') {
			$httpMethod = $method;
		}

		if (isset($param)) {
			$titleStr .= '(' .$param .')';
		}

		if (isset($param2)) {
			$titleStr .= '- 댓글 (' .$param2 .')';
		}

		$titleStr .= ' : ' . $httpMethod;

		echo '<h1>' . ${titleStr} . '</h1>
				<ul>
					<li><a href="/sux/">Call MyClass::MyMethod</a></li>
					<li><a href="/sux/sample">Call MyClass::MyOtherMethod</a></li>
					<li><a href="/sux/board-name/source">View the source of this page</a></li>
					<li>
						<form action="/sux/board-name/22/comment/1" method="POST" accept-charset="utf-8">
							<input type="submit" name="btn-write" value="Write the comment of this page" placeholder="">
						</form>
					</li>
					<li>
						<form action="/sux/board-name/comment" method="POST" accept-charset="utf-8">
							<input type="hidden" name="_method" value="put" />
							<input type="submit" name="btn-del" value="Update the comment of this page" placeholder="">
						</form>
					</li>
					<li>
						<form action="/sux/board-name/comment" method="POST" accept-charset="utf-8">
							<input type="hidden" name="_method" value="delete" />
							<input type="submit" name="btn-del" value="Delete the comment of this page" placeholder="">
						</form>
					</li>
				</ul>';

	}
}

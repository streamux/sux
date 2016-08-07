<?php

class MemberModel extends BaseModel {

	var $class_name = 'member_model';

	function init() {
		
	}

	function memberListFromGroup() {

		$context = Context::getInstance();
		$member_group = $context->get('db_member_group');

		$query = new Query();
		$query->setField('name');
		$query->setTable($member_group);
		$result = parent::select($query);
		return $result;
	}

	function fieldFromMember($field) {

		$context = Context::getInstance();
		$table_name = $context->getPost('table_name');
		$memberid = $context->getPost('memberid');

		$query = new Query();
		$query->setField($field);
		$query->setTable($table_name);
		$query->setWhere(array(
			'ljs_memberid'=>$memberid
		));
		$result = parent::select($query);
		return $result;
	}	

	function recordAdd() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$remote_addr = $context->getServer('REMOTE_ADDR');
		$table_name = $posts['table_name'];

		$pwd1 = trim($posts['pwd1']);
		$pwd2 = trim($posts['pwd2']);
		$pwd1 = substr(md5($pwd1),0,8);
		$pwd2 = substr(md5($pwd2),0,8);

		$query = new Query();
		$query->setTable($table_name);
		$query->setColumn(array(
			'',
			$posts['memberid'],
			$pwd1,
			$pwd2,
			$posts['name'],
			$posts['email'],
			$posts['tel1'],
			$posts['tel2'],
			$posts['tel3'],
			$posts['hp1'],
			$posts['hp2'],
			$posts['hp3'],
			$posts['company'],
			$posts['recordnum'],
			$posts['job'],
			$posts['hobby'],
			$posts['path'],
			$posts['proposeid'],
			'now()',
			0,
			'yes',
			100,
			1,
			$remote_addr
		));

		$result = parent::insert($query);
		return $result;
	}

	function recordEdit() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$memberid = $posts['memberid'];

		$pwd1 = trim($posts['pwd1']);
		$pwd2 = trim($posts['pwd2']);
		$pwd1=substr(md5($pwd1),0,8);
		$pwd2=substr(md5($pwd2),0,8);

		$query = new Query();
		$query->setTable($posts['table_name']);
		$query->setColumn(array(
			'ljs_pass1'=>$pwd1,
			'ljs_pass2'=>$pwd2,
			'name'=>$posts['name'],
			'email'=>$posts['email'],
			'tel1'=>$posts['tel1'],
			'tel2'=>$posts['tel2'],
			'tel3'=>$posts['tel3'],
			'hp1'=>$posts['hp1'],
			'hp2'=>$posts['hp2'],
			'hp3'=>$posts['hp3'],
			'company'=>$posts['company'],
			'job'=>$posts['job'],
			'hobby'=>$posts['hobby']
		));
		$query->setWhere(array(
			'ljs_memberid'=>$memberid
		));

		$result = parent::update($query);
		return $result;
	}

	function recordDelete() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$query = new Query();
		$query->setTable($posts['table_name']);
		$query->setWhere(array(
			'ljs_memberid'=>$posts['memberid']
		));

		$result = parent::delete($query);
		return $result;
	}
}
?>
<?php

class MemberModel extends Model {

	var $class_name = 'member_model';

	function init() {
		
	}

	function selectMemberGroup() {

		$context = Context::getInstance();
		$member_group = $context->getTable('member_group');

		$query = new Query();
		$query->setField('*');
		$query->setTable($member_group);
		$result = parent::select($query);
		return $result;
	}

	function selectFromMember($field) {

		$context = Context::getInstance();
		$table_name = $context->getTable('member');
		$category = $context->getParameter('category');
		$userId = $context->getParameter('user_id');

		$where = new QueryWhere();
		$where->set('category',$category,'=');
		$where->set('user_id',$userId,'=','and');

		$query = new Query();
		$query->setField($field);
		$query->setTable($table_name);
		$query->setWhere($where);
		$result = parent::select($query);
		return $result;
	}	

	function insertMemberJoin() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$remote_addr = $context->getServer('REMOTE_ADDR');
		$table_name = $context->getTable('member');

		$query = new Query();
		$query->setTable($table_name);
		$query->setColumn(array(
			'',
			$posts['category'],
			$posts['user_id'],
			$posts['password'],
			$posts['user_name'],
			$posts['nick_name'],
			$posts['email_address'],
			'',
			'',
			$posts['hp1'],
			$posts['hp2'],
			$posts['hp3'],
			'',
			$posts['job'],
			$posts['hobby'],
			$posts['join_path'],
			$posts['access_count'],
			1000,
			1,
			'y',			
			'n',
			'now()',
			$remote_addr
		));

		$result = parent::insert($query);
		return $result;
	}

	function updateMemberModify() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$table_name = $context->getTable('member');
		$category = $context->getParameter('category');
		$userId = $context->getParameter('user_id');

		$where = new QueryWhere();
		$where->set('category',$category,'=');
		$where->set('user_id',$userId,'=','and');

		$query = new Query();
		$query->setTable($table_name);
		$query->setColumn(array(
			'password'=>$posts['password'],
			'user_name'=>$posts['user_name'],
			'nick_name'=>$posts['nick_name'],
			'email_address'=>$posts['email_address'],
			'hp1'=>$posts['hp1'],
			'hp2'=>$posts['hp2'],
			'hp3'=>$posts['hp3'],
			'job'=>$posts['job'],
			'hobby'=>$posts['hobby']
		));
		$query->setWhere($where);

		$result = parent::update($query);
		return $result;
	}

	function deleteDelete() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$context = Context::getInstance();
		$table_name = $context->getTable('member');
		$category = $context->getParameter('category');
		$userId = $context->getParameter('user_id');

		$where = new QueryWhere();
		$where->set('category',$category,'=');
		$where->set('user_id',$userId,'=','and');

		$query = new Query();
		$query->setTable($table_name);
		$query->setWhere($where);

		$result = parent::delete($query);
		return $result;
	}
}

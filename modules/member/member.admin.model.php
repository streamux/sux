<?php

class MemberAdminModel extends BaseModel {

	var $class_name = 'member_admin_model';

	function init() {
		
	}

	function selectFromMemberGroup() {

		$context = Context::getInstance();
		$group = $context->get('db_member_group');

		$query = new Query();
		$query->setField('*');
		$query->setTable($group);

		$result = parent::select($query);
		return $result;
	}

	function selectMemberFromMemberGroup() {

		$context = Context::getInstance();
		$group = $context->get('db_member_group');
		$table_name = $context->getRequest('table_name');

		$query = new Query();
		$query->setField('*');
		$query->setTable($group);
		$query->setWhere(array(
			'name'=>$table_name
		));

		$result = parent::select($query);
		return $result;
	}

	function selectMember() {

		$context = Context::getInstance();
		$table_name = $context->getPost('table_name');
		$table_name = $context->getRequest('table_name');
		
		$query = new Query();
		$query->setField('*');
		$query->setTable($table_name);

		$result = parent::select($query);
		return $result;
	}

	function selectMemberWhereId() {

		$context = Context::getInstance();
		$table_name = $context->getRequest('table_name');
		$memberid = $context->getPost('memberid');

		$query = new Query();
		$query->setField('*');
		$query->setTable($table_name);
		$query->setWhere(array(
			'ljs_memberid'=>$memberid
		));

		$result = parent::select($query);
		return $result;
	}

	function selectMemberLimit() {

		$context = Context::getInstance();
		$table_name = $context->getRequest('table_name');

		$passover = $context->get('member_passover');
		$limit = $context->get('member_limit');

		$query = new Query();
		$query->setField('*');
		$query->setTable($table_name);
		$query->setOrderBy('id desc');
		$query->setLimit($passover, $limit);

		$result = parent::select($query);
		return $result;
	}

	function updateMemberWhereId() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$table_name = $posts['table_name'];
		$id = $posts['id'];

		$column_data = array_slice($posts, 3);
		$column = array();
		foreach ($column_data as $key => $value) {
			
			if ($value != '') {
				if (preg_match('/ljs_pass/', $key)) {	
					$column[$key] = substr(md5($value),0,8);
				} else {
					$column[$key] = $value;
				}	
			}				
		}

		$query = new Query();
		$query->setTable($table_name);
		$query->setColumn( $column );
		$query->setWhere(array(
			'id'=>$id
		));

		$result = parent::update($query);
		//$result = $query->getColumn();
		return $result;
	}

	function createTableMember() {

		$context = Context::getInstance();
		$table_name = $context->getRequest('table_name');

		$query = new Query();
		$query->setTable($table_name);

		$schema = new QuerySchema();
		$schema->add('id','int',null,'notnull', 'autoincrement');
		$schema->add('ljs_memberid','varchar',12,'notnull');
		$schema->add('ljs_pass1','varchar',12,'notnull');
		$schema->add('ljs_pass2','varchar',12,'notnull');
		$schema->add('name','varchar',12,'notnull');
		$schema->add('email','varchar',30);
		$schema->add('tel1','char',3);
		$schema->add('tel2','char',4);
		$schema->add('tel3','char',4);
		$schema->add('hp1','char',3);
		$schema->add('hp2','char',4);
		$schema->add('hp3','char',4);
		$schema->add('company','varchar',12);
		$schema->add('recordnum','varchar',30);
		$schema->add('job','char',20);
		$schema->add('hobby','varchar',40);
		$schema->add('path','char',20);
		$schema->add('proposeid','char',20);
		$schema->add('date','timestamp');
		$schema->add('hit','int');
		$schema->add('writer','varchar',5);
		$schema->add('point','int',11);
		$schema->add('grade','int',11);
		$schema->add('ip','varchar',30);

		$schema->setPrimarykey('id');
		$query->setSchema($schema);

		$result = parent::createTable($query);
		return $result;
	}

	function insertIntoMemberGroup() {

		$context = Context::getInstance();
		$group = $context->get('db_member_group');
		$table_name = $context->getRequest('table_name');

		$query = new Query();
		$query->setTable($group);
		$query->setColumn(array(
			'',
			$table_name,
			'now()'
		));

		$result = parent::insert($query);
		return $result;
	}

	function dropTableMember() {

		$context = Context::getInstance();
		$table_name = $context->getRequest('table_name');

		$query = new Query();
		$query->setTable($table_name);

		$result = parent::dropTable($query);
		return $result;
	}

	function deleteMemberGroup() {

		$context = Context::getInstance();
		$group = $context->get('db_member_group');
		$table_name = $context->getRequest('table_name');

		$query = new Query();
		$query->setTable($group);
		$query->setWhere(array(
			'name'=>$table_name
		));

		$result = parent::delete($query);
		return $result;
	}

	function deleteFromMember() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$table_name = $posts['table_name'];
		$id = $posts['id'];

		$query = new Query();
		$query->setTable($table_name);
		$query->setWhere(array(
			'id'=>$id
		));

		$result = parent::delete($query);
		return $result;
	}
}
?>
<?php

namespace Helpers;

use \PDO;

require_once "config.php";

class DB {
	private static $_instance;
	private $_pdo;

	public function __construct() {
		$this->_pdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
	}

	public function ins() {
		if(!self::$_instance) {
			self::$_instance = new DB;
		}
		return self::$_instance;
	}

	function select_fetch($table, $fields, $where=null, $order=null) { //order= "id, DESC" 
		$query = "SELECT $fields FROM $table";

		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}
		
		if(isset($order)) {
			$order = explode(', ', $order);
			$query .= " ORDER BY $order[0] $order[1]";
		}

		$query = $this->_pdo->query($query);
		$query = $query->fetchAll(PDO::FETCH_OBJ);

		return $query;
	}

	function select_rowCount($table, $fields, $where=null) {
		$query = "SELECT $fields FROM $table";

		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}

		$query = $this->_pdo->query($query);
		$query = $query->rowCount();
		return $query;
	}

	function delete($table, $where=null) {
		$query = "
			DELETE
			FROM $table
		";
		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}
		if($this->_pdo->query($query)){
			return true;
		} else {
			return false;
		}
	}

	function select_innerjoin() {
		$query ="SELECT 
		posts.id AS post_id,
		categories.id AS category_id,
		title, contents, date_created,
		categories.name AS category_name
		FROM posts
		INNER JOIN categories ON
		categories.id = posts.user_id
		ORDER BY post_id DESC";

		$query = $this->_pdo->query($query);
		$query = $query->fetchAll(PDO::FETCH_OBJ);
		return $query;
	}

	//"todo/text, user_id, done, date_created/vitug, 10, 0: NOW()"

	public function innerJoin($table, $field, $join, $sort=null, $where=null) {
		$table = explode("/", $table);

		$field = explode("/", $field);

		$field1 = explode(", ", $field[0]);
		$field2 = explode(", ", $field[1]);

		$query = "SELECT ";

		$query1 = "";
		$query2 = "";

		foreach($field1 as $fields){
		$query1 = $query1."{$table[0]}.{$fields} AS {$table[0]}_{$fields}, ";
		}
		$query1 = rtrim($query1, ", ");

		foreach($field2 as $fields){
		$query2 = $query2."{$table[1]}.{$fields} AS {$table[1]}_{$fields}, ";
		}
		$query2 = rtrim($query2, ", ");

		$query = $query.$query1.", ".$query2;

		$join = explode("=", $join);
		$join1 = explode("/", $join[0]);
		$join2 = explode("/", $join[1]);

		if(sizeof($join2)==1) {

		$query = $query." FROM {$table[0]} ";
		$query = $query."INNER JOIN {$table[1]} ON {$join1[0]}.{$join1[1]} = {$join2[0]}";
		} else {

		$query = $query." FROM {$table[0]} ";
		$query = $query."INNER JOIN {$table[1]} ON {$join1[0]}.{$join1[1]} = {$join2[0]}.{$join2[1]}";
		}

		if(isset($where)) {
			$where = explode("=", $where);

			$query .= " WHERE $where[0] = $where[1]";
		}

		if(isset($sort)) {

		$sort = explode("/", $sort);

		$query .= " ORDER BY $sort[0] $sort[1]";
		}

		$query = $this->_pdo->query($query);
		return $query = $query->fetchAll(PDO::FETCH_OBJ);

	}

	function getLicenseId($query) {
	
		return $this->_pdo->query($query)->fetchAll(PDO::FETCH_OBJ);
	}
	
	function insert($table, $fields, $values) {
		$values = explode(',, ', $values);
		$values[0] = "'".$values[0];
		$values = implode('\', \'', $values);
		$values .= "'";
		$query = timezone." INSERT INTO $table ($fields) VALUES ($values)";

		if($this->_pdo->query($query)){
			return true;
		} else {
			return false;
		}
	}

	function query($query) {
		$query = $this->_pdo->query($query);

		return $query = $query->fetchAll(PDO::FETCH_OBJ);


	}

	function isExist($table, $fields, $where=null) {
		$query = 
			"
			SELECT {$fields} FROM {$table}
			";

		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}

		$query = $this->_pdo->query($query);

		$query = $query->rowCount();

		if($query) {
			return true;
		} else {
			return false;
		}
	}

	function getuser_id($username) {
		$query = "
			SELECT id FROM users WHERE username = '$username'
		";
		$query = $this->_pdo->query($query);
		$query = $query->fetchAll(PDO::FETCH_OBJ);
		foreach ($query as $query_key) {
			return $query_key['id'];
		}
	}

	function get($query, $where=null) {  //SELECT * FROM users WHERE id = '22' 
		$query = explode('/', $query);
		$col_name = $query[2];
		$query = "SELECT $query[1] FROM $query[0]";

		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}
		

		$query = $this->_pdo->query($query);
		$query = $query->fetchAll(PDO::FETCH_OBJ);

		foreach ($query as $query_key) {
			return $query_key[$col_name];
		}
	}

	function lastInsertedId() {
		$id = $this->_pdo->lastInsertId();
		return $id;
	}

	function update($table, $fields, $where=null) { //UPDATE todo SET text = '1234', done = '1' WHERE id = '44';
		//update("todo/text=1234, done=1", "id=44");
		$fields = explode(', ', $fields);
		$fields = implode('\', ', $fields);
		$fields = explode('=', $fields);
		$fields = implode('=\'', $fields);
		$fields .= "'";
		$fields = explode('\'NOW()\'', $fields);
		$fields = implode('NOW()', $fields);
		$query = "UPDATE $table SET $fields";

		if(isset($where)) {
			$where = explode(', ', $where);
			$where = implode('\' AND ', $where);
			$where = explode('=', $where);
			$where = implode('=\'', $where);
			$where .= "'";
			$query .= " WHERE $where";	
		}

		if($this->_pdo->query($query)){
			return true;
		} else {
			return false;
		}
	}
}

?>
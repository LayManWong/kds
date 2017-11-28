<?php

/*
* Database Settings
*/

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'khanstore');
define('DB_USER', 'root');
define('DB_PASS', '');

/**
* Class Database
* handle database connection and simple CRUD operation
*/
class Database
{
	
	function __construct()
	{
        $this->pdo = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    }

    /**
	* create() function [INSERT]
	* require data to be insert and table name
	* @param array $data
	* @param string $table
	*/
    public function create($data, $table)
    {
    	
    	$columns = implode(", ",array_keys($data));
		$values  = array_values($data);
		$qs      = str_repeat("?,",count($values)-1);

    	try
    	{
    		$stmt = $this->pdo->prepare("INSERT INTO $table ($columns) VALUES(${qs}?)");
    		if ($stmt->execute($values)) {	
    			return true;
    		};
    	} catch(PDOException $e) {
    		echo $e->getMessage(); 
		}
		return false;
	}


	/**
	* read() function [SELECT]
	* require column name and table name
	* @param string $column
	* @param string $table
	*/
	public function read($data,$table)
	{

		if (array_key_exists("where", $data)) {
			$column = array_slice($data, -1);
			$where = array_pop($data);

			$columns = implode(", ",array_values($data));
			$query = "SELECT $columns FROM $table WHERE $where";
		} else {
			$columns = implode(", ",array_values($data));
			$query = "SELECT $columns FROM $table";
		}

		$stmt = $this->pdo->prepare($query);
		if ($stmt->execute()) {
			$data=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		};
		return false;
	}

	/**
	* getID() function [SELECT]
	* @param int/string $id
	* @param string $table
	*/
	public function getID($id, $table)
	{
		if (strpos($id, '=') == false) {
			    $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id=:id");
				$stmt->bindparam(":id", $id);
			} else {
				$pieces = explode("=", $id);
				$stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $pieces[0]=:id");
				$stmt->bindparam(":id", $pieces[1]);
			}

		//$stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id=:id");
		//$stmt = $this->pdo->prepare($query);
		if ($stmt->execute()) {
			$data=$stmt->fetch(PDO::FETCH_ASSOC);
			return $data;
		};
		return false;
	}

	/**
	* update() function [UPDATE]
	* @param array $data
	* @param int/string $id
	* @param string $table
	*/
	public function update($data, $id, $table)
	{
		// pass each value of a $data to $values [user defined function]
		$data = array_filter($data, function ($value) {
		    return null !== $value;
		});

		$query = "UPDATE $table SET";
		$values = array();

		foreach ($data as $name => $value) {
		    $query .= ' '.$name.' = :'.$name.',';
		    $values[':'.$name] = $value;
		}

		try
		{
			if (strpos($id, '=') == false) {
				$query = substr($query, 0, -1).' WHERE id = :id;';
				$values[':id'] = $id;
			} else {
				$pieces = explode("=", $id);
				$query = substr($query, 0, -1).' WHERE ' . $pieces[0] . ' = :id;';
				$values[':id'] = $pieces[1];
			}
			$stmt = $this->pdo->prepare($query);

			if ($stmt->execute($values)) {
				return true; 
			}
		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
		return false;
	}

	/**
	* delete() function [DELETE]
	* @param int/string $id
	* @param string $table
	*/
	public function delete($id, $table)
	{

		try {

			if (strpos($id, '=') == false) {
			    $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id=:id");
				$stmt->bindparam(":id", $id);
			} else {
				$pieces = explode("=", $id);
				$stmt = $this->pdo->prepare("DELETE FROM $table WHERE $pieces[0]=:id");
				$stmt->bindparam(":id", $pieces[1]);
			}
			
			if ($stmt->execute()) {
				return true;
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		return false;
	}

	/**
	* update() function [CUSTOM]
	* for custom query [e.g JOIN]
	* @param string $sql
	* @param string $args
	*/
	public function run($sql, $args = NULL)
    {
        if (!$args)
        {
             return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
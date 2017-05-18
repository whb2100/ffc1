<?php
namespace dao;

use PDO;
use Exception;
use PDOException;

/**
 *定义数据库连接所需参数 
 */
define('BACKEND_DBHOST', '192.168.31.78');
define('BACKEND_DBUSER', 'root');
define('BACKEND_DBPW', '123456');
// define('BACKEND_DBNAME', 'filmfinance');
define('BACKEND_DBNAME', 'filmfinance3');
define('BACKEND_DBCHARSET', 'utf8');

/*define('BACKEND_DBHOST', 'localhost');
define('BACKEND_DBUSER', 'root');
define('BACKEND_DBPW', 'c6BV4wiq3SZ7');
define('BACKEND_DBNAME', 'filmfinance');
define('BACKEND_DBCHARSET', 'utf8');*/

class Db {

	public static $db = null;
	private $_dbh = null;
	
	public static function getInstance() {
		if (self::$db == null) {
			self::$db = new self(BACKEND_DBHOST ,BACKEND_DBUSER ,BACKEND_DBPW ,BACKEND_DBNAME);
		}
		return self::$db;
	}
	
	private function __construct($host, $user, $pass, $dbname) {
		try {
			$this->_dbh = new PDO('mysql:dbname='.$dbname.';host='.$host,$user,$pass);
			$this->_dbh->query('SET NAMES '. BACKEND_DBCHARSET);
			$this->_dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
			$this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->_dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
		} catch (PDOException $e) {
			throw new Exception('Can not connect db');
		}
	}  
  
	private function getExecuteResult($sql, $sth) {
		$type = strtolower(substr(trim($sql), 0,6));
		switch ($type) {
			case 'update': case 'delete':
				$result = $sth->rowcount();//返回影响的行数
				break;
			case 'insert':
				$result = $this->getLastId();
				break;
			case 'select':
				$result = $sth->fetchAll(PDO::FETCH_ASSOC);
				break;
			default:
				break;
		}
		return $result;
	}

	public function getOne($sql) {
		try {
			$rs = $this->_dbh->query($sql);
			$result = $rs->fetch(PDO::FETCH_ASSOC);
			if (!empty($result)) {
				return $result;
			}
		} catch (PDOException $e) {
			throw new Exception($this->_dbh->errorInfo());
		}
		return false;
	}

	public function getAll($sql) {
		try {
			$rs = $this->_dbh->query($sql);
			$result = $rs->fetchAll(PDO::FETCH_ASSOC);
			if (!empty($result)) {
				return $result;
			}
		} catch (PDOException $e) {
			throw new Exception($this->_dbh->errorInfo());
		}
		return false;
	}

	public function exec($sql) {
		try {
			$exec = $this->_dbh->exec($sql);
		} catch (PDOException $e) {
			throw new Exception($this->_dbh->errorInfo());
		}
		return $exec;
	}

	/**
	 * 不关注键值
	 *  Execute a prepared statement by passing an array of values
	 $sth = $dbh->prepare('SELECT name, colour, calories
	 FROM fruit
	 WHERE calories < ? AND colour = ?');
	 $sth->execute(array(150, 'red'));
	 $red = $sth->fetchAll();
	 $sth->execute(array(175, 'yellow'));
	 $yellow = $sth->fetchAll();
	 */
	public function executeArr($sql, $arr){
		try {
			$sth = $this->_dbh->prepare($sql);
			$r = $sth->execute($arr);
			if ($r) {
				return  $this->getExecuteResult($sql, $sth);
			}
		} catch (PDOException $e){
			throw new Exception($e->getMessage() . $this->_dbh->errorInfo());
		}
	}
    
	/**
	 * 关联数组:
	 *  Execute a prepared statement by passing an array of values
	 $sql = 'SELECT name, colour, calories
	 FROM fruit
	 WHERE calories < :calories AND colour = :colour';
	 $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	 $sth->execute(array(':calories' => 150, ':colour' => 'red'));
	 $red = $sth->fetchAll();
	 *
	 */
	public function executeAsoc($sql, $arr){
		try {
			$array = array();
			if ($arr) {
				foreach ($arr as $key=>$v) {
					if (strpos($sql, ':' . $key )!==false) {
						$array[':' . $key] = $v;
					}
				}
			}
			$sth = $this->_dbh->prepare($sql);
			if(strstr($sql,'like')){
				foreach ($array as $key=>$value){
					if(strstr($key,'_status') || strstr($key,'_id') && $value){
						$sth->bindValue($key, trim($value));
					}else{
						$sth->bindValue($key, '%'.$value.'%');
					}
				}
				$r = $sth->execute();
			}else{
				$r = $sth->execute($array);
			}

			if ($r) {
				return  $this->getExecuteResult($sql, $sth);
			}
		} catch (PDOException $e){
			throw new Exception($e->getMessage() . $this->_dbh->errorInfo());
		}
	}

	public function getTotal($sql,$arr){
		try {
			$array = array();
			if ($arr) {
				foreach ($arr as $key=>$v) {
					if (strpos($sql, ':' . $key )!==false) {
						$array[':' . $key] = $v;
					}
				}
			}
			$sth = $this->_dbh->prepare($sql);
			if(strstr($sql,'like')){
				foreach ($array as $key=>$value){
					if(strstr($key,'_status') || strstr($key,'_id') && $value){
						$sth->bindValue($key, trim($value));
					}else{
						$sth->bindValue($key, '%'.$value.'%');
					}
				}
				$r = $sth->execute();
			}else{
				$r = $sth->execute($array);
			}
			return $sth->fetchColumn();
		} catch (PDOException $e){
			throw new Exception($e->getMessage() . $this->_dbh->errorInfo());
		}
	}

	public function beginTransaction(){
		return $this->_dbh->beginTransaction();
	}

	public function commit(){
		return $this->_dbh->commit();
	}

	public function rollBack(){
		return $this->_dbh->rollBack();
	}

	public function getLastId(){
		return $this->_dbh->lastInsertId();
	}

	public function closeAutoCommit() {
		$this->_dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
	}

	public function openAutoCommit() {
		$this->_dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
	}

	public function executeAsoc2($sql, $arr) {
		try {
			$array = array();
			if ($arr) {
				foreach ($arr as $key=>$v) {
					if(strpos($sql, ':' . $key) !== false) {
						$array[':' . $key] = $v;
					}
				}
			}
			$sth = $this->_dbh->prepare($sql);
			/*foreach ($arr as $key=>$value){
			 $sth->bindValue(':'.$key, $value);
			 }*/
			$r = $sth->execute($array);
			if ($r) {
				return $this->getExecuteResult($sql, $sth);
			}
		} catch (PDOException $e) {
			throw new Exception($e->getMessage() . $this->_dbh->errorInfo());
		}
	}
		
	public function getTotal2($sql, $arr) {
		try {
			$array = array();
			if ($arr) {
				foreach($arr as $key=>$v) {
					if (strpos($sql, ':' . $key ) !== false) {
						$array[':' . $key] = $v;
					}
				}
			}
			$sth = $this->_dbh->prepare($sql);
			$r = $sth->execute($array);
			return $sth->fetchColumn();
		} catch (PDOException $e){
			throw new Exception($e->getMessage() . $this->_dbh->errorInfo());
		}
	}

	public function executeBatch($sql, $arr){
		try {
			$sth = $this->_dbh->prepare($sql);
			$r = 0;
			if ($arr) {
				foreach($arr as $i=>$j) {
					foreach($j as $key=>$v) {
						if (strpos($sql, ':' . $key) !== false) {
							$sth->bindValue(':' . $key, $v);
							//echo $key.'='.$v.' ';
						}
					}
					//$r += $sth->execute();
					if ($sth->execute()) {
						$r += $sth->rowCount();
					}
				}
			}
			return $r;
		} catch (PDOException $e) {
			throw new Exception($e->getMessage() . $this->_dbh->errorInfo());
		}
	}
}
?>
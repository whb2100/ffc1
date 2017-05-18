<?php 
namespace etc\data;

use dao\Mapper;
use dao\Db;

class EtcMapper extends Mapper{
	function __construct(){
		$this->conn =  Db::getInstance();
	}
}

?>
<?php

namespace sys\data;

use dao\Mapper;
use dao\Db;
use PDO;
use Exception;
use common\Constants;
use common\Access;
use utils\ExcelUtils;

class DepartMapper extends Mapper {
	
	function __construct() {
		$this->conn = Db::getInstance();
	}
	
}

?>
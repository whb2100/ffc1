<?php

namespace basic\data;

use dao\Table;

class CurrencyCode extends Table{
	public $tableName = 't_biz_currency_code';
    public $tableView = 't_biz_currency_code';
    public $primaryKey = 'currency_code_id';

	protected $currency_code_id;
    protected $currency_code;
    protected $currency_desc;

    public static $tablefields = array(
        'currency_code_id',
        'currency_code',
        'currency_desc',
    );

    public function getCurrency_code_id() {
        return $this->currency_code_id;
    }

    public function setCurrency_code_id($currency_code_id) {
        return $this->currency_code_id = $currency_code_id;
    }

    public function getCurrency_code() {
        return $this->currency_code;
    }

    public function setCurrency_code($currency_code) {
        return $this->currency_code = $currency_code;
    }

    public function getCurrency_desc() {
        return $this->currency_desc;
    }

    public function setCurrency_desc($currency_desc) {
        return $this->currency_desc = $currency_desc;
    }
	
}

?>
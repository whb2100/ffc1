<?php

namespace basic\data;

use dao\Table;

class CurrencyType extends Table{
	public $tableName = 't_biz_currency_type';
    public $tableView = 't_biz_currency_type';
    public $primaryKey = 'currency_type_id';

 	protected $currency_type_id;
    protected $currency_type;
    protected $currency_desc;

    public static $tablefields = array(
        'currency_type_id',
        'currency_type',
        'currency_desc',
    );

    public function getCurrency_type_id() {
        return $this->currency_type_id;
    }

    public function setCurrency_type_id($currency_type_id) {
        return $this->currency_type_id = $currency_type_id;
    }

    public function getCurrency_type() {
        return $this->currency_type;
    }

    public function setCurrency_type($currency_type) {
        return $this->currency_type = $currency_type;
    }

    public function getCurrency_desc() {
        return $this->currency_desc;
    }

    public function setCurrency_desc($currency_desc) {
        return $this->currency_desc = $currency_desc;
    }
	
}

?>
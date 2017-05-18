<?php

namespace poInput\data;

use dao\Table;

class Transaction extends Table{
	public $tableName = 't_biz_po_transaction_info';
    public $tableView = 't_biz_po_transaction_info';
    public $primaryKey = 'transaction_id';

 	protected $transaction_id;
    protected $batch_id;
    protected $transaction_code;
    protected $total_amount;
    protected $create_date;
    protected $create_by;
    protected $last_update_date;
    protected $last_update_by;

    public static $tablefields = array(
        'transaction_id',
        'batch_id',
        'transaction_code',
        'total_amount',
        'create_date',
        'create_by',
        'last_update_date',
        'last_update_by',
    );

    public function getTransaction_id() {
        return $this->transaction_id;
    }

    public function setTransaction_id($transaction_id) {
        return $this->transaction_id = $transaction_id;
    }

    public function getBatch_id() {
        return $this->batch_id;
    }

    public function setBatch_id($batch_id) {
        return $this->batch_id = $batch_id;
    }

    public function getTransaction_code() {
        return $this->transaction_code;
    }

    public function setTransaction_code($transaction_code) {
        return $this->transaction_code = $transaction_code;
    }

    public function getTotal_amount() {
        return $this->total_amount;
    }

    public function setTotal_amount($total_amount) {
        return $this->total_amount = $total_amount;
    }

    public function getCreate_date() {
        return $this->create_date;
    }

    public function setCreate_date($create_date) {
        return $this->create_date = $create_date;
    }

    public function getCreate_by() {
        return $this->create_by;
    }

    public function setCreate_by($create_by) {
        return $this->create_by = $create_by;
    }

    public function getLast_update_date() {
        return $this->last_update_date;
    }

    public function setLast_update_date($last_update_date) {
        return $this->last_update_date = $last_update_date;
    }

    public function getLast_update_by() {
        return $this->last_update_by;
    }

    public function setLast_update_by($last_update_by) {
        return $this->last_update_by = $last_update_by;
    }
	
}

?>
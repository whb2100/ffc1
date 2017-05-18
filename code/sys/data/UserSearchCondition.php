<?php
	
	namespace sys\data;
	
	use dao\Table;
	
	class UserSearchCondition extends Table {
		
	protected $user_empcodes;// 登录账号
		
    public function getuUser_empcodes() {
        return $this->user_empcodes;
    }

    public function setUser_empcodes($user_empcodes) {
        return $this->user_empcodes = $user_empcodes;
    }
    
	public static $searchfields = array(
		'user_empcodes'=>'登录账号'
	);
		
}
?>
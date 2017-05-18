<?php
	
	namespace sys\data;
	
	use dao\Table;
	
	class RoleSearchCondition extends Table {
		
	protected $role_names;// 角色名称
		
    public function getRole_names() {
        return $this->role_names;
    }

    public function setRole_names($role_names) {
        return $this->role_names = $role_names;
    }
    
	public static $searchfields = array(
		'role_names'=>'角色名称'
	);
		
}
?>
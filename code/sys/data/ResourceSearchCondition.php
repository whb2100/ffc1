<?php
	
	namespace sys\data;
	
	use dao\Table;
	
	class ResourceSearchCondition extends Table {
		
	protected $resource_names;// 资源名称
		
    public function getResource_names() {
        return $this->resource_names;
    }

    public function setResource_names($resource_names) {
        return $this->resource_names = $resource_names;
    }
    
	public static $searchfields = array(
		'resource_names'=>'资源名称'
	);
		
}
?>
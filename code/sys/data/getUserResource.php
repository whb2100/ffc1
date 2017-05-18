<?php 
    include '../../common/mysql_init.php';
    include '../../common/session_init.php';
    include '../../common/Constants.php';
    
    $roleIdString = " ";
    $userId = $_SESSION[$LOGINED_USER_ID_IN_SESSION];
    
    //根据登陆用户的userId获取该用户的roleId
    $queryResult = mysql_query(sprintf($queryUserRole,$userId));
    while($resultRow = mysql_fetch_array($queryResult)){
        $roleIdString .= $resultRow[0].",";
    }
    $roleIdString = substr($roleIdString, 0, -1);
    
    //根据用户的roleId获取resourceId
    $queryResult = mysql_query(sprintf($queryRoleResource,$roleIdString));
    
    while($resultRow = mysql_fetch_array($queryResult)){
        $resourceIdString .= $resultRow[0].",";
    }
    $resourceIdString = substr($resourceIdString, 0, -1);
    
    $result = array();
    //print_r(sprintf($queryResource."where resource_id in($resourceIdString)"));
    $queryResult = mysql_query(sprintf($queryResource."where resource_id in($resourceIdString)"));
    
    $items = array();
    while ($resultRow = mysql_fetch_assoc($queryResult)){
        array_push($items, $resultRow);
    }
    $result['resource'] = $items;
    
    //print_r($queryResourceParent);
    $queryResult = mysql_query($queryResourceParent);
    $items = array();
    while ($resultRow = mysql_fetch_assoc($queryResult)){
        array_push($items, $resultRow);
    }
    $result['resourceParent'] = $items;
    
    echo json_encode($result);
?>
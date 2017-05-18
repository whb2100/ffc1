<?php 
    include '../../common/mysql_init.php';
    include '../../common/session_init.php';
    include '../../common/Constants.php';
    
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? md5($_POST['password']) : '';
    
    $queryResult = mysql_query(sprintf($queryUser."where user_empcode = '%s' and user_password = '%s' ",$username,$password));
    
	//print_r(sprintf($queryUser."where user_username = '%s' and user_empcode = '%s' ",$username,$password));
    
    if($resultRow = mysql_fetch_array($queryResult)){
        $userId = $resultRow[0];
        $storeId = $resultRow[1];
        $userStatus = $resultRow[2];
        $userRealName = $resultRow[4];
    }else{
        echo json_encode(array(
            'result' => 10001,
            'msg' => '用户名或密码错误！'
        ));
        return;
    }
    if($userStatus != 1){
        echo json_encode(array(
            'result' => 10001,
            'msg' => '该用户不可用！'
        ));
        return;
    }else {
        $queryResult = mysql_query($queryStore."where store_id = $storeId");
        if($resultRow = mysql_fetch_array($queryResult)){
            $_SESSION['STORE_CODE'] = $resultRow[2];
        }
        $_SESSION[$LOGINED_USER_CODE_IN_SESSION] = $username;
        $_SESSION[$LOGINED_USER_NAME_IN_SESSION ] = $userRealName;
        $_SESSION[$LOGINED_USER_ID_IN_SESSION ] = $userId;
        $_SESSION[$LOGINED_USER_STORE_ID_IN_SESSION] = $storeId;
        
        echo json_encode(array(
            'result' => 10000,
            'msg' => '登陆成功！'
        ));
    }
?>
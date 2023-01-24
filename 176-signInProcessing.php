<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php_study/171-session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php_study/163-connection.php';

    $email = $_POST['userEmail'];
    $pw = $_POST['userPw'];

    function goSignInPage($alert){
        echo $alert;
        echo "<a href='./175-signInForm.php>로그인 폼으로 이동</a>";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        goSignInPage("올바른 이메일이 아닙니다.");
        exit;
    }

    if($pw == null || $pw ==''){
        goSignInPage("비밀번호를 입력해 주세요");
        exit();
    }

    $pw = sha1('php200'.$pw);

    $sql = "SELECT email, nickName, memberID FROM member";
    $sql .= " WHERE email = '{$email}' and pw = '{$pw}'";
if (!empty($dbConnect)) {
    $result = $dbConnect ->query($sql);
}
if($result){
    if($result->num_rows == 0){
        goSignInPage("로그인 정보가 일치하지 않습니다");
        exit;
    }else{
        $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['memberID'] = $memberInfo['memberID'];
        $_SESSION['nickName'] = $memberInfo['nickName'];
        Header("Location:../index.php");
    }
}


?>
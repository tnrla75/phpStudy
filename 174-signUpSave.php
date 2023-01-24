<?php

    include $_SERVER['DOCUMENT_ROOT'].'/php_study/171-session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php_study/163-connection.php';

    $email = $_POST['userEmail'];
    $nickName = $_POST['userNickName'];
    $pw = $_POST['userPw'];
    $birthYear = (int) $_POST['birthYear'];
    $birthMonth = (int) $_POST['birthMonth'];
    $birthDay = (int) $_POST['birthDay'];

    function goSignUpPage($alert){
        echo $alert.'<br>';
        echo "<a href='./173-signUpform.php>회원가입 폼으로 이동</a>";
        return;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        goSignUpPage('올바른 이메일이 아닙니다.');
        exit;
    }

    $nickNameRegPattern = '/^[가-힣]{1,}$/';
    if(!preg_match($nickNameRegPattern, $nickName, $matches)){
        goSignUpPage("닉네임은 한글만 입력해 주세요");
        exit;
    }

    if($pw == null && $pw ==''){
        goSignUpPage("비밀번호를 입력해 주세요.");
        exit;
    }
    $pw = sha1('php200'.$pw);

    if($birthYear == 0){
        goSignUpPage("생년 정확히 입력해 주세요");
        exit;
    }

    if($birthMonth == 0){
        goSignUpPage("생월을 정확히 입력해 주세요");
        exit;
    }

    if($birthDay == 0){
        goSignUpPage("생일을 정확히 입력해 주세요");
        exit;
    }

    $birth = $birthYear.'-'.$birthMonth.'-'.$birthDay;

    $isEmailCheck = false;

    $sql = "SELECT email FROM member WHERE email = '{$email}'";
    if (!empty($dbConnect)) {
        $result = $dbConnect->query($sql);
    }

    if($result){
        $count = $result->num_rows;
        if($count == 0){
            $isEmailCheck = true;
        }else{
            goSignUpPage("이미 존재하는 이메일 입니다.");
            exit;
        }
    }else{
        echo "에러발생 : 관리자 문의 요망";
    }

    $isNickNameCheck = false;

    $sql = "SELECT nickName FROM member WHERE nickname = '{$nickName}'";
    $result = $dbConnect ->query($sql);

    if($result){
        $count = $result->num_rows;
        if($count ==0){
            $isNickNameCheck =true;
        }else{
            goSignUpPage("이미 존재하는 닉네임 입니다");
            exit;
        }
    }else{
        echo "에러 발생";
    }

    if ($isNickNameCheck ==true && $isEmailCheck == true){
        $regTime = time();
        $sql = "INSERT INTO member(email, nickname, pw, birthday, regTime)";
        $sql .= "VALUES('{$email}','{$nickName}','{$pw}',";
        $sql .= "'{$birth}', {$regTime})";
        $result = $dbConnect->query($sql);

        if ($result){
            $_SESSION['memberID'] = $dbConnect->insert_id;
            $_SESSION['nickName'] = $nickName;
            Header("Location:../index.php");
        }else{
            echo "회원가입 실패 - 문의";
            exit;
        }
    }else{
        goSignUpPage('이메일 또는 닉네임이 중복값입니다.');
        exit;
    }

?>


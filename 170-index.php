<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php_study/171-session.php';
//echo $_SERVER['DOCUMENT_ROOT'].'/phpstudy/171-session.php';

?>

<html>
<head>

</head>
<body>
<?php
    if(!isset($_SESSION['memberID'])){
?>
        <a href="173-signUpform.php">회원가입</a>
        <br>
        <a href="175-signInForm.php">로그인</a>
<?php
    }else{
?>
        <a href="/183-list.php">게시판</a>
        <br>
        <a href="/189-surveyForm.php">설문조사 프로그램</a>
        <br>
        <a href="/195-1-surveyResultBarChart.php">투표결과 바차트로 보기</a>
        <br>
        <a href="/195-2-surveyResultPiechart.php">투표결과 파이차트로 보기</a>
        <br>
        <a href="/196-editorForm.php">간단한 코딩 에디터</a>
        <br>
        <a href="/200-1-selectForm.php">실시간 검색어 1위 키워드 보기</a>
        <br>
        <a href="177-signOut.php">로그아웃</a>
<?php
    }
?>
</body>
</html>


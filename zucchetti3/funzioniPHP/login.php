<?php
include("connection.php");
session_start();

$pagina = 1;
$UserInput = $_POST["user"];
$PassInput = $_POST["pass"];
$CaptchaInput = $_POST["capt"];

$sql = "SELECT password, username, ID FROM studente ";
$sql .= "WHERE Username = '$UserInput'";

$UserData = $conn->query($sql);

if (mysqli_num_rows($UserData) == 0) {

    $sql = "SELECT password, username, ID FROM professore ";
    $sql .= "WHERE username = '$UserInput'";

    $UserData = $conn->query($sql);

    $pagina = 2;
}

$x = $UserData->fetch_assoc();
$_SESSION['logID'] = $x['ID'];

if (($CaptchaInput == $_SESSION['captcha_code']) && ($PassInput == $x['password'])) {
    if ($pagina == 1) {
        $_SESSION['userType'] = 0;
        echo 1;
    } else {
        $_SESSION['userType'] = 2;
        echo 2;
    }
} else {
    echo 0;
}

<?
if (empty($_SESSION['email']) || empty($_SESSION['username'])) {
    $_SESSION = array();

    session_destroy();
    header("location: ../");
}
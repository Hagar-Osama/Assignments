<?php session_start();
if (isset($_GET['id']) && ! empty($_GET['id'])) {
$connection = mysqli_connect('localhost', 'root', '', 'course');
if (! $connection) {
    die('connection has failed: '. mysqli_connect_error());
}
$mysql_statement = 'select id from users where id = '. $_GET['id'];
$result = mysqli_query($connection, $mysql_statement);
$data = mysqli_fetch_assoc($result);
if (count($data) > 0) {
    $mysql = 'delete from users where id = '. $_GET['id'];
    $result = mysqli_query($connection, $mysql);
    $data = mysqli_fetch_assoc($result);
    if  ($result) {
        $_SESSION['success'] = 'user has been deleted successfully';
        header('location:users.php');
    }
}else {
    $_SESSION['errors'] = 'user not found';
    header('location:users.php');
}

}
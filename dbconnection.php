<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'root');
define('DB_NAME', 'loginsystem');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Проверка подключения
if (mysqli_connect_errno())
{
echo "Ошибка подключения к БД:" . mysqli_connect_error();
 }

?>


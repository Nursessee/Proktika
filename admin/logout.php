<?php
session_start();
$_SESSION['login']=="";

session_unset();
$_SESSION['action1']="Вы успешно вышли..!";
?>
<script language="javascript">
document.location="index.php";
</script>

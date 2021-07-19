<?php session_start();
require_once('dbconnection.php');
//Code for Registration 
if(isset($_POST['signup']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$contact=$_POST['contact'];
	$enc_password=$password;
$sql=mysqli_query($con,"select id from users where email='$email'");
$row=mysqli_num_rows($sql);
if($row>0)
{
	echo "<script>alert('Email уже занят. Пожалуйста, введите другой');</script>";
} else{
	$msg=mysqli_query($con,"insert into users(fname,lname,email,password,contactno) values('$fname','$lname','$email','$enc_password','$contact')");

if($msg)
{
	echo "<script>alert('Регистрация прошла успешно');</script>";
}
}
}

// Code for login 
if(isset($_POST['login']))
{
$password=$_POST['password'];
$dec_password=$password;
$useremail=$_POST['uemail'];
$ret= mysqli_query($con,"SELECT * FROM users WHERE email='$useremail' and password='$dec_password'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="welcome.php";
$_SESSION['login']=$_POST['uemail'];
$_SESSION['id']=$num['id'];
$_SESSION['name']=$num['fname'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
echo "<script>alert('Неправильный логин или пароль');</script>";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
//header("location:http://$host$uri/$extra");
exit();
}
}

//Code for Forgot Password

if(isset($_POST['send']))
{
$femail=$_POST['femail'];

$row1=mysqli_query($con,"select email,password from users where email='$femail'");
$row2=mysqli_fetch_array($row1);
if($row2>0)
{
$email = $row2['email'];
$subject = "Сброс пароля";
$password=$row2['password'];
$message = "Ваш пароль: ".$password;
mail($email, $subject, $message, "From: $email");
echo  "<script>alert('Пароль отправлен');</script>";
}
else
{
echo "<script>alert('Неверный email-адрес');</script>";
}
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Авторизация</title>
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Elegent Tab Forms,Login Forms,Sign up Forms,Registration Forms,News latter Forms,Elements" . />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#horizontalTab').easyResponsiveTabs({
                type: 'default',
                width: 'auto',
                fit: true
            });
        });

    </script>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700,200italic,300italic,400italic,600italic|Lora:400,700,400italic,700italic|Raleway:400,500,300,600,700,200,100' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="main">
        <h1>Регистрация и авторизация пользователя</h1>
        <div class="sap_tabs">
            <div id="horizontalTab" style="display: block; width: 120%; margin: 0px;">
                <ul class="resp-tabs-list">
                    <li class="resp-tab-item" aria-controls="tab_item-0" role="tab">
                        <div class="top-img"><img src="images/top-note.png" alt=""></div><span>Зарегистрировать пользователя</span>

                    </li>
                    <li class="resp-tab-item" aria-controls="tab_item-1" role="tab">
                        <div class="top-img"><img src="images/top-lock.png" alt="" /></div><span>Авторизоваться на сайте</span>
                    </li>
                    <li class="resp-tab-item lost" aria-controls="tab_item-2" role="tab">
                        <div class="top-img"><img src="images/top-key.png" alt="" /></div><span>Восстановление пароля</span>
                    </li>
                    <div class="clear"></div>
                </ul>

                <div class="resp-tabs-container">
                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                        <div class="facts">

                            <div class="register">
                                <form name="registration" method="post" action="" enctype="multipart/form-data">
                                    <p>Имя </p>
                                    <input type="text" class="text" value="" name="fname" required>
                                    <p>Фамилия </p>
                                    <input type="text" class="text" value="" name="lname" required>
                                    <p>Email </p>
                                    <input type="text" class="text" value="" name="email">
                                    <p>Пароль </p>
                                    <input type="password" value="" name="password" required>
                                    <p>Номер телефона </p>
                                    <input type="text" value="" name="contact" required>
                                    <div class="sign-up">
                                        <input type="reset" value="Очистить">
                                        <input type="submit" name="signup" value="Зарегистрироваться">
                                        <div class="clear"> </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
                        <div class="facts">
                            <div class="login">
                                <div class="buttons">


                                </div>
                                <form name="login" action="" method="post">
                                    <input type="text" class="text" name="uemail" value="" placeholder="Введите логин"><a href="#" class=" icon email"></a>

                                    <input type="password" value="" name="password" placeholder="Введите пароль"><a href="#" class=" icon lock"></a>

                                    <div class="p-container">

                                        <div class="submit two">
                                            <input type="submit" name="login" value="Войти">
                                        </div>
                                        <div class="clear"> </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
                        <div class="facts">
                            <div class="login">
                                <div class="buttons">


                                </div>
                                <form name="login" action="" method="post">
                                    <input type="text" class="text" name="femail" value="" placeholder="Введите свой email" required><a href="#" class=" icon email"></a>

                                    <div class="submit three">
                                        <input type="submit" name="send" onClick="myFunction()" value="Отправить">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

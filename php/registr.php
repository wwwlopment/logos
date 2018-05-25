<?php session_start();
$msg="";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if($_SESSION['captcha'] != $_POST['text']) {
		$msg = '<div id="msg"> помилка вводу капчі </div>';
}
if (isset($_POST['username'])&&isset($_POST['password'])) {
		
		$login=$_POST['username'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		
	$db_server="localhost";
	$db_name="BAZA";
	$db_user="root";
	$db_password="777";
	$dsn = "mysql:host=$db_server;dbname=$db_name;charset=utf8";
		$opt = array(
    PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
		 $pdo = new PDO($dsn, $db_user, $db_password, $opt);
//		try { $pdo = new PDO($dsn, $db_user, $db_password, $opt);
//} 
//catch (PDOException $e) {
//	die('Підключення не вдалось: ' . $e->getMessage());
//}
        $login = $pdo->quote($login);
      //  $sql = "SELECT login, email FROM users WHERE login=$login";
		   $sql = "SELECT login FROM users WHERE login=$login";
        if($stmt = $pdo->query($sql)){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row){
	 $msg.="<div id=\"msg\"> Користувач з таким ім\"ям вже зареєстрований </div>";
	}
		}
	 //	$pdo = new PDO($dsn, $db_user, $db_password, $opt);
	 $email = $pdo->quote($email);
	 $sql = "SELECT email FROM users WHERE email=$email";
        if($stmt = $pdo->query($sql)){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($row) {
		$msg.= "<div id=\"msg\"> Користувач з таким емейлом вже зареєстрований</div>";
	}
		}
    if (($_POST['password']==$_POST['password2'])&& ($msg=="")) {
	    // запис в базу юзера
$sql = "INSERT INTO users (login, password, email, birthday, policyes, regtime) VALUES (:login, :password, :email, :birthday, :policyes, :regtime)";
 
 
//Prepare our statement.
$statement = $pdo->prepare($sql);
 
 
//Bind our values to our parameters (we called them :make and :model).
$statement->bindValue(':login', $_POST['username']);
$statement->bindValue(':password', md5($password));
$statement->bindValue(':email', $_POST['email']);
$statement->bindValue(':birthday', $_POST['birthday']);
$statement->bindValue(':policyes', "user");
$statement->bindValue(':regtime', date("Y-m-d H:i:s"));
 
 
//Execute the statement and insert our values.
$inserted = $statement->execute();
 
 
//Because PDOStatement::execute returns a TRUE or FALSE value,
//we can easily check to see if our insert was successful.
if($inserted){
header ('Location: ../index.php?auth');
}
    }
	else {
	$msg.= "<div id=\"msg\">поля вводу пароля не однакові !</div>";
	}
    
}

}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <!--<link rel="stylesheet" href="../css/avtoriz.css" type="text/css">-->
    <title></title>
</head>

<body>
    <div id="header">
            <h2>Зареєструйтесь</h2>
    </div>
    <div id="content">
       <div id="regform">
        <form method="post" >
            <label for="username">Логін :</label><br>
            <input autofocus type="text" name="username" placeholder="логін" id="username"><br>
            <label for="password">Пароль :</label><br>
            <input type="password" name="password" placeholder="пароль" id="password"><br>
            <label for="password2">Введіть пароль ще раз :</label><br>
            <input type="password" name="password2" placeholder="повторно введіть пароль" id="password2"><br>
            <label for="email">Введіть свій e-mail :</label><br>
            <input type="email" name="email" placeholder="введіть Ваш e-mail" id="email"><br>
            <label for="birthday">Введіть дату Вашого народження :</label><br>
            <input type="date" name="birthday" placeholder="дата Вашого народження" id="birthday"><br>
                    <img src="../php/captcha.php">
                        <div>
                            <label>Введіть Капчу :</label><br>
                            <input type="text" name="text" size="15"><br>
                            	<?php if (isset($msg)) {echo $msg;} ?>
                        </div>
                    <!--<input type="submit" value="OK">-->
                
            <button type="submit" >Зареєструватись</button><br>
            <hr>
            <a href='../index.php'>На головну сторінку</a>
        </form>
       </div>
    </div>
    
</body>
</html>
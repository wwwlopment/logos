<?php
	if (isset($_GET['auth'])&&(!isset($_SESSION['login']))){
		require_once($_SERVER['DOCUMENT_ROOT']."/php/loginbox.php");
		}
            if (isset($_GET["exit"])) {
                    unset($_SESSION['login']);
                    session_destroy();
                    setcookie("id", '', time()-3600);
                    setcookie("hash", '', time()-3600);
                    header ('Location: ../index.php');
                    return;
            } 
	if (isset($_POST['username'])&&isset($_POST['password'])) {
		
		$login=$_POST['username'];
		$password=$_POST['password'];
		$result=login($login, $password);
		require_once($_SERVER['DOCUMENT_ROOT']."/php/loginbox.php");	
	}
	else {
	return;
	}
	
	
	// AUTORIZATION PDO
	function login($login, $password){
	
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
        $password = md5($password);
        $sql = "SELECT id, password, policyes FROM users WHERE login=$login";
        //$stmt = $pdo->prepare ('SELECT id, password FROM users WHERE login = :login');
		//$stmt->execute(array('login' => $login));
		
		if(!$stmt = $pdo->query($sql)){
		return $false;
	} else {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if(!$row){
		$result="Невірний логін або пароль !";
		return $result;
	    } else {
                    $db_password = $row['password'];
                    $db_id = $row['id'];
                    if($password == $db_password){
                        $hash = md5(rand(0, 6400000));
                        $sql_update = "UPDATE users SET hash='$hash' WHERE id='$db_id'";
                        if($pdo->exec($sql_update)){
                            setcookie("id", $db_id, time() + 3600);
                            setcookie("hash", $hash, time() + 3600);
				session_start();
				$_SESSION['login']=$_POST['username'];
				$_SESSION['policyes']=$row['policyes'];
				header ('Location: ../index.php');
                            return true;
                        }else{
                            print 'Exception';
                        }
                    }
		$result="Невірний логін або пароль !";
		return $result;
                }
            }
    }
?>
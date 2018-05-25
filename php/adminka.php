<?php
session_start();
if($_SESSION['policyes']!="admin"){
    header('Location: ' . $_SERVER['DOCUMENT_ROOT'] );
    exit;
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
            <h2>Адміністрування</h2>
    </div>

  
    
</body>
</html>
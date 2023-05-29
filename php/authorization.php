<html>
    <head>
    <title></title>
    <meta charset="utf-8" />
    <script src="../js/login.js"></script>
    </head>
<body>
    <?php   
        session_start();
        $connect = mysqli_connect("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
        if (!$connect) {
          die("Ошибка: " . mysqli_connect_error());
        }
        $login = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM logpswd WHERE login = '$login'";
        $result = mysqli_query($connect, $sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($result);
        if (($login=='adm' ) and ($result[0]['password']==md5($password)))
        {
            $_SESSION['user_id'] = 1; 
            echo '<script type="text/javascript">window.location.href="../adm_tablo.php"</script>';
        }
        else if(($login=='disp' ) and ($result[0]['password']==md5($password)))
        {
            $_SESSION['user_id'] = 3;
            echo '<script type="text/javascript">window.location.href="../adm_service.php"</script>';
        }
        else if($result[0]['password']==md5($password))
        {
            $_SESSION['user_id'] = 2;
            echo '<script type="text/javascript">window.location.href="../work.php"</script>';
        }
        else{
            echo '<script type="text/javascript">window.location.href="../index.html"</script>' . mysqli_error($connect);

        }
        mysqli_close($connect);
        
    ?>
</html>
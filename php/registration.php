<html>

<head>
    <title></title>
    <meta charset="utf-8" />
</head>

<body>
    <?php
    
    $login = $_POST["username"];
    if ($login == 'adm')
    {
        echo '<script type="text/javascript">window.location.href="../index.html"</script>';
    }
    else if ($login == 'disp'){
        echo '<script type="text/javascript">window.location.href="../index.html"</script>';
    }
    else
    {   
        $password = $_POST["password"];
        $connect = mysqli_connect("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
        if (!$connect) {
            die("Ошибка: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO logpswd VALUES('$login',MD5('$password'))";
        $result = $connect->query($sql);
        if ($result)
        {
            
            echo '<script type="text/javascript">window.location.href="../work.php"</script>';
        }
        else
            echo '<script type="text/javascript">window.location.href="../index.html"</script>';
            mysqli_close($connect);
    }
    ?>

</html>
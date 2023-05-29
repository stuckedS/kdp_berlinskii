<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    return;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>KDP</title>
    <link rel="stylesheet" href="./css/style2.css">
</head>

<body>
    <main>
        <article>
            <section>

                <?php
                $dbh = new PDO('mysql:dbname=o92644i4_kdp;host=localhost', 'o92644i4_kdp', 'ABOBuS1');
                $table = $_GET['table'];
                if ($table == 'tablo') {
                    echo '<h2 class="#top_div">Онлайн-Табло</h2>';
                    $idd = intval(mb_substr(@$_GET["Idd"], 1, -1));
                    /* Проверка GET-переменной */
                    $sort = @$_GET['sort'];
                    if (array_key_exists($sort, $sort_list)) {
                        $sort_sql = $sort_list[$sort];
                    } else {
                        $sort_sql = reset($sort_list);
                    }
                    /* Запрос в БД */
                    $conn = mysqli_connect("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
                    $sql1 = "SELECT * FROM `Flights` WHERE `idFlights` = $idd";
                    $sth = $dbh->prepare($sql1);
                    $sth->execute();
                    $list = $sth->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <table table border=1px class='table_dark'>
                        <thead>
                            <tr>
                                <th>
                                    <?php echo ('Номер рейса'); ?>
                                </th>
                                <th>
                                    <?php echo ('Дата'); ?>
                                </th>
                                <th>
                                    <?php echo ('Аэропорт вылета'); ?>
                                </th>
                                <th>
                                    <?php echo ('Аэропорт прилета'); ?>
                                </th>
                                <th>
                                    <?php echo ('Компания'); ?>
                                </th>
                            </tr>
                        </thead>
                        <form method="post">
                            <tbody>
                                <?php foreach ($list as $row): ?>
                                    <tr>
                                        <td>
                                            <?php echo "<input type='text' name='idFlights'  value=$row[idFlights]> "; ?>
                                        </td>
                                        <td>
                                            <?php echo "<input type='text' name='Data'  value=$row[Data]>"; ?>
                                        </td>
                                        <td>
                                            <?php echo "<input type='text' name='Airport_out'  value=$row[Airport_out]>"; ?>
                                        </td>
                                        <td>
                                            <?php echo "<input type='text' name='Airport_in' value=$row[Airport_in]>"; ?>
                                        </td>
                                        <td>
                                            <?php echo "<input type='text' name='Company' value=$row[Company]>"; ?>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                    </table>
                    <input class='btn' type="submit" name="test" value="Сохранить">
                    </form>
                    <?php
                    function myFunction()
                    {
                        $connect = new mysqli("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
                        $update_sql = "UPDATE `Flights` SET `Data`='$_POST[Data]',`Airport_out`='$_POST[Airport_out]', 
                                                            `Airport_in`='$_POST[Airport_in]', 
                                                            `Company`='$_POST[Company]' 
                        WHERE idFlights=$_POST[idFlights] ";
                        if ($connect->query($update_sql)) {
                            echo "Данные успешно добавлены";
                        } else {
                            echo "Ошибка: " . $connect->error;
                        }
                        $connect->close();
                    }

                    if (array_key_exists('test', $_POST)) {
                        myFunction();
                    }

                    echo "<br><a class='btn' href=/adm_tablo.php>К таблице</a>";
                    ?>
                    <?php
                } else if ($table == 'pilots') {
                    echo '<h2 class="#top_div">Пилоты</h2>';
                    $idd = intval(mb_substr(@$_GET["Idd"], 1, -1));
                    /* Проверка GET-переменной */
                    $sort = @$_GET['sort'];
                    if (array_key_exists($sort, $sort_list)) {
                        $sort_sql = $sort_list[$sort];
                    } else {
                        $sort_sql = reset($sort_list);
                    }
                    /* Запрос в БД */
                    $conn = mysqli_connect("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
                    $sql1 = "SELECT * FROM `Pilots` WHERE `idPilots` = $idd";

                    $sth = $dbh->prepare($sql1);
                    $sth->execute();
                    $list = $sth->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                        <form method="post">
                            <table table border=1px class='table_dark'>
                                <thead>
                                    <tr>
                                        <th>
                                        <?php echo ('Id пилота'); ?>
                                        </th>
                                        <th>
                                        <?php echo ('Фамилия'); ?>
                                        </th>
                                        <th>
                                        <?php echo ('Имя'); ?>
                                        </th>
                                        <th>
                                        <?php echo ('Отчество'); ?>
                                        </th>
                                        <th>
                                        <?php echo ('Компания'); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list as $row): ?>
                                        <tr>
                                            <td>
                                            <?php echo "<input type='text'  name='idPilots' value='$row[idPilots]'> "; ?>
                                            </td>
                                            <td>
                                            <?php echo "<input type='text' name='Surname' value='$row[Surname]'>"; ?>
                                            </td>
                                            <td>
                                            <?php echo "<input type='text' name='Name' value='$row[Name]'>"; ?>
                                            </td>
                                            <td>
                                            <?php echo "<input type='text' name='Patronymic' value='$row[Patronymic]'>"; ?>
                                            </td>
                                            <td>
                                            <?php echo "<input type='text' name='Company' value='$row[Company]'>"; ?>
                                            </td>
                                        </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <input class='btn' type="submit" name="test" value="Сохранить">
                        </form>
                        <?php
                        function myFunction()
                        {
                            $connect = new mysqli("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
                            $update_sql = "UPDATE `Pilots` SET `Surname`='$_POST[Surname]',`Name`='$_POST[Name]', 
                                                            `Patronymic`='$_POST[Patronymic]', 
                                                            `Company`='$_POST[Company]' 
                        WHERE idPilots=$_POST[idPilots] ";
                            if ($connect->query($update_sql)) {
                                echo "Данные успешно добавлены";
                            } else {
                                echo "Ошибка: " . $connect->error;
                            }
                            $connect->close();
                        }

                        if (array_key_exists('test', $_POST)) {
                            myFunction();
                        }

                        echo "<br><a class='btn' href=/adm_pilots.php>К таблице</a>";
                        ?>
                    <?php

                } else if ($table == 'planes') {
                    echo '<h2 class="#top_div">Самолеты</h2>';
                    $idd = intval(mb_substr(@$_GET["Idd"], 1, -1));
                    /* Проверка GET-переменной */
                    $sort = @$_GET['sort'];
                    if (array_key_exists($sort, $sort_list)) {
                        $sort_sql = $sort_list[$sort];
                    } else {
                        $sort_sql = reset($sort_list);
                    }
                    /* Запрос в БД */
                    $conn = mysqli_connect("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
                    $sql1 = "SELECT * FROM `Aircraft` WHERE `idAircraft` = $idd";

                    $sth = $dbh->prepare($sql1);
                    $sth->execute();
                    $list = $sth->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                            <form method="post">
                                <table table border=1px class='table_dark'>
                                    <thead>
                                        <tr>
                                            <th>
                                        <?php echo ('Id самолета'); ?>
                                            </th>
                                            <th>
                                        <?php echo ('Модель'); ?>
                                            </th>
                                            <th>
                                        <?php echo ('Топливо'); ?>
                                            </th>
                                            <th>
                                        <?php echo ('Вместимость'); ?>
                                            </th>
                                            <th>
                                        <?php echo ('Описание'); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php foreach ($list as $row): ?>
                                            <tr>
                                                <td>
                                            <?php echo "<input type='text'  name='idAircraft' value='$row[idAircraft]'> "; ?>
                                                </td>
                                                <td>
                                            <?php echo "<input type='text' name='Model' value='$row[Model]'>"; ?>
                                                </td>
                                                <td>
                                            <?php echo "<input type='text' name='Fuel' value='$row[Fuel]'>"; ?>
                                                </td>
                                                <td>
                                            <?php echo "<input type='text' name='Capacity' value='$row[Capacity]'>"; ?>
                                                </td>
                                                <td>
                                            <?php echo "<input type='text' name='Description' value='$row[Description]'>"; ?>
                                                </td>
                                            </tr>
                                <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <input class='btn' type="submit" name="test" value="Сохранить">
                            </form>
                        <?php
                        function myFunction()
                        {
                            $connect = new mysqli("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
                            $update_sql = "UPDATE `Aircraft` SET `Model`='$_POST[Model]',`Fuel`='$_POST[Fuel]', 
                                                            `Capacity`='$_POST[Capacity]', 
                                                            `Description`='$_POST[Description]' 
                        WHERE idAircraft=$_POST[idAircraft]";
                            if ($connect->query($update_sql)) {
                                echo "Данные успешно добавлены";
                            } else {
                                echo "Ошибка: " . $connect->error;
                            }
                            $connect->close();
                        }

                        if (array_key_exists('test', $_POST)) {
                            myFunction();
                        }

                        echo "<br><a class='btn' href=/adm_planes.php>К таблице</a>";
                        ?>
                    <?php



                } else if ($table == 'serv') {
                    echo '<h2 class="#top_div">Работники</h2>';
                    $idd = intval(mb_substr(@$_GET["Idd"], 1, -1));
                    /* Проверка GET-переменной */
                    $sort = @$_GET['sort'];
                    if (array_key_exists($sort, $sort_list)) {
                        $sort_sql = $sort_list[$sort];
                    } else {
                        $sort_sql = reset($sort_list);
                    }
                    /* Запрос в БД */
                    $conn = mysqli_connect("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
                    $sql1 = "SELECT * FROM `Employees` WHERE `idEmployees` = $idd";

                    $sth = $dbh->prepare($sql1);
                    $sth->execute();
                    $list = $sth->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                                <form method="post">
                                    <table table border=1px class='table_dark'>
                                        <thead>
                                            <tr>
                                                <th>
                                        <?php echo ('Id Работника'); ?>
                                                </th>
                                                <th>
                                        <?php echo ('Фамилия'); ?>
                                                </th>
                                                <th>
                                        <?php echo ('Имя'); ?>
                                                </th>
                                                <th>
                                        <?php echo ('Отчество'); ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php foreach ($list as $row): ?>
                                                <tr>
                                                    <td>
                                            <?php echo "<input type='text'  name='idEmployees' value='$row[idEmployees]'> "; ?>
                                                    </td>
                                                    <td>
                                            <?php echo "<input type='text' name='Surname' value='$row[Surname]'>"; ?>
                                                    </td>
                                                    <td>
                                            <?php echo "<input type='text' name='Name' value='$row[Name]'>"; ?>
                                                    </td>
                                                    <td>
                                            <?php echo "<input type='text' name='Patronymic' value='$row[Patronymic]'>"; ?>
                                                    </td>
                                                </tr>
                                <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <input class='btn' type="submit" name="test" value="Сохранить">
                                </form>
                        <?php
                        function myFunction()
                        {
                            $connect = new mysqli("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
                            $update_sql = "UPDATE `Employees` SET `Surname`='$_POST[Surname]',`Name`='$_POST[Name]', 
                                                            `Patronymic`='$_POST[Patronymic]'
                        WHERE idEmployees=$_POST[idEmployees]";
                            if ($connect->query($update_sql)) {
                                echo "Данные успешно добавлены";
                            } else {
                                echo "Ошибка: " . $connect->error;
                            }
                            $connect->close();
                        }

                        if (array_key_exists('test', $_POST)) {
                            myFunction();
                        }

                        echo "<br><a class='btn' href=/adm_service.php>К таблице</a>";
                        ?>
                    <?php
                } else if ($table == 'tech') {
                    echo '<h2 class="#top_div">Работники</h2>';
                    $idd = intval(mb_substr(@$_GET["Idd"], 1, -1));
                    /* Проверка GET-переменной */
                    $sort = @$_GET['sort'];
                    if (array_key_exists($sort, $sort_list)) {
                        $sort_sql = $sort_list[$sort];
                    } else {
                        $sort_sql = reset($sort_list);
                    }
                    /* Запрос в БД */
                    $conn = mysqli_connect("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
                    $sql1 = "SELECT * FROM `Technique_serv` WHERE `idTechnique_serv` = $idd";

                    $sth = $dbh->prepare($sql1);
                    $sth->execute();
                    $list = $sth->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                                    <form method="post">
                                        <table table border=1px class='table_dark'>
                                            <thead>
                                                <tr>
                                                    <th>
                                        <?php echo ('Id техники'); ?>
                                                    </th>
                                                    <th>
                                        <?php echo ('Id Водителя'); ?>
                                                    </th>
                                                    <th>
                                        <?php echo ('Тип техники'); ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                <?php foreach ($list as $row): ?>
                                                    <tr>
                                                        <td>
                                            <?php echo "<input type='text'  name='idTechnique_serv' value='$row[idTechnique_serv]'> "; ?>
                                                        </td>
                                                        <td>
                                            <?php echo "<input type='text' name='Employees_idEmployees' value='$row[Employees_idEmployees]'>"; ?>
                                                        </td>
                                                        <td>
                                            <?php echo "<input type='text' name='Type' value='$row[Type]'>"; ?>
                                                        </td>
                                                    </tr>
                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <input class='btn' type="submit" name="test" value="Сохранить">
                                    </form>
                        <?php
                        function myFunction()
                        {
                            $connect = new mysqli("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");
                            $update_sql = "UPDATE `Technique_serv` SET `Employees_idEmployees`='$_POST[Employees_idEmployees]',`Type`='$_POST[Type]'
                        WHERE idTechnique_serv=$_POST[idTechnique_serv]";
                            if ($connect->query($update_sql)) {
                                echo "Данные успешно добавлены";
                            } else {
                                echo "Ошибка: " . $connect->error;
                            }
                            $connect->close();
                        }

                        if (array_key_exists('test', $_POST)) {
                            myFunction();
                        }

                        echo "<br><a class='btn' href=/adm_tech.php>К таблице</a>";
                        ?>
                    <?php
                }
                ?>
            </section>
        </article>
    </main>
</body>
<footer>
    <div class="waves">
        <div class="wave" id="wave1"></div>
    </div>
    <ul class="social">
        <li><a href="https://www.linkedin.com/in/david-berlinskii-b03228194/"><ion-icon Name="logo-linkedin"
                    target="_blank"><ion-icon></a></li>
        <li><a href="https://vk.com/d.berlinsky" target="_blank"><ion-icon Name="logo-vk"><ion-icon></a></li>
        <li><a href="https://www.instagram.com/stucked_s" target="_blank"><ion-icon
                    Name="logo-instagram"></ion-icon></a></li>
        <li><a href="https://github.com/stuckedS" target="_blank"><ion-icon Name="logo-github"></ion-icon></a></li>
    </ul>
    <p>©2023 KDP Berlinskii | All Rights Reserved</p>
</footer>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>
<?php
session_start();
if (!isset($_SESSION['user_id']))
    return;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>KDP</title>
    <link rel="stylesheet" href="./css/style2.css">
</head>

<body>
    <div class="topnav" >
        <a href="adm_tablo.php">Редактировать Онлайн-Табло</a>
        <a class="active" href="adm_planes.php">Редактировать Самолеты</a>
        <a href="adm_pilots.php">Редактировать Пилоты</a>
        <a  href="adm_service.php">Редактировать работников</a>
        <a href="adm_tech.php">Редактировать технику обслуживания</a>
        <a href="adm_test.php">Выходные документы</a>
        <a href="index.html"><ion-icon Name="Exit"><ion-icon></a>
    </div> 
    <main>
        <article>
            <section>
            <h2 class="#top_div">Самолеты</h2>
            <form>
                <div class="form-group">
                    <label>Введите ID</label>
                    <input type="text" class="form-control" id="ID" name="ID" aria-describedby="ID" placeholder="ID">       
                    <a class ='btn btn-primary' type='submit' href=/adm_edit.php?table=planes&Idd='<?php ECHO $_GET["ID"]?>'>Поиск</a>
                </div>
            </form>
            <?php
                /* Все варианты сортировки */
                $sort_list = array(
                    'idAircraft_asc' => '`idAircraft`',
                    'idAircraft_desc' => '`idAircraft` DESC',
                    'Model_asc' => '`Model`',
                    'Model_desc' => '`Model` DESC',
                    'Fuel_asc' => '`Fuel`',
                    'Fuel_desc' => '`Fuel` DESC',
                    'Capacity_asc' => '`Capacity`',
                    'Capacity_desc' => '`Capacity` DESC',
                    'Description_asc' => '`Description`',
                    'Description_desc' => '`Description` DESC',
                );
                /* Проверка GET-переменной */
                $sort = @$_GET['sort'];
                if (array_key_exists($sort, $sort_list)) {
                    $sort_sql = $sort_list[$sort];
                } else {
                    $sort_sql = reset($sort_list);
                }

                /* Запрос в БД */
                $dbh = new PDO('mysql:dbname=o92644i4_kdp;host=localhost', 'o92644i4_kdp', 'ABOBuS1');
                $sth = $dbh->prepare("SELECT * FROM `Aircraft` ORDER BY {$sort_sql}");
                $sth->execute();
                $list = $sth->fetchAll(PDO::FETCH_ASSOC);

                /* Функция вывода ссылок */
                function sort_link_th($title, $a, $b)
                {
                    $sort = @$_GET['sort'];
                    if ($sort == $a) {
                        return '<a   href="?sort=' . $b . '">' . $title . ' <i>▲</i></a>';
                    } elseif ($sort == $b) {
                        return '<a  href="?sort=' . $a . '">' . $title . ' <i>▼</i></a>';
                    } else {
                        return '<a href="?sort=' . $a . '">' . $title . '</a>';
                    }
                } ?>
                <table table border = 1px class='table_dark'>
                    <thead>
                        <tr>
                            <th>
                                <?php echo sort_link_th('Id самолета', 'idAircraft_asc', 'idAircraft_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Модель', 'Model_asc', 'Model_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Топливо', 'Fuel_asc', 'Fuel_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Вместимость', 'Capacity_asc', 'Capacity_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Описание', 'Description_asc', 'Description_desc'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row): ?>
                            <tr>
                                <td>
                                    <?php echo $row['idAircraft']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Model']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Fuel']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Capacity']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Description']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </article>
    </main>
</body>
<footer>
    <div class="waves">
        <div class="wave" id="wave1"></div>
    </div>
    <ul class="social">
        <li><a href="https://www.linkedin.com/in/david-berlinskii-b03228194/"><ion-icon Name="logo-linkedin" target="_blank"><ion-icon></a></li>
        <li><a href="https://vk.com/d.berlinsky" target="_blank"><ion-icon Name="logo-vk"><ion-icon></a></li>
        <li><a href="https://www.instagram.com/stucked_s" target="_blank"><ion-icon Name="logo-instagram"></ion-icon></a></li>
        <li><a href="https://github.com/stuckedS" target="_blank"><ion-icon Name="logo-github"></ion-icon></a></li>
    </ul>
    <p>©2023 KDP Berlinskii | All Rights Reserved</p>
</footer>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>

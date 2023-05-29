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
    <div class="topnav">
        <a class="active" href="adm_tablo.php">Редактировать Онлайн-Табло</a>
        <a href="adm_planes.php">Редактировать Самолеты</a>
        <a href="adm_pilots.php">Редактировать Пилоты</a>
        <a href="adm_service.php">Редактировать работников</a>
        <a href="adm_tech.php">Редактировать технику обслуживания</a>
        <a href="adm_test.php">Выходные документы</a>
        <a href="index.html"><ion-icon Name="Exit"><ion-icon></a>
    </div>
    <main>
        <article>
            <section>
            <h2 class="#top_div">Онлайн-Табло</h2>
                <form>
                    <div class="form-group">
                        <label>Введите ID</label>
                        <input type="text" class="form-control" id="ID" name="ID" aria-describedby="ID" placeholder="ID">       
                        <a class ='btn btn-primary' type='submit' href=/adm_edit.php?table=tablo&Idd='<?php ECHO $_GET["ID"]?>'>Поиск</a>
                    </div>
                </form>
                <?php
                /* Все варианты сортировки */
                $sort_list = array(
                    'idFlights_asc' => '`idFlights`',
                    'idFlights_desc' => '`idFlights` DESC',
                    'Data_asc' => '`Data`',
                    'Data_desc' => '`Data` DESC',
                    'Airport_out_asc' => '`Airport_out`',
                    'Airport_out_desc' => '`Airport_out` DESC',
                    'Airport_in_asc' => '`Airport_in`',
                    'Airport_in_desc' => '`Airport_in` DESC',
                    'Company_asc' => '`Company`',
                    'Company_desc' => '`Company` DESC',
                    'TIme_asc' => '`TIme`',
                    'TIme_desc' => '`TIme` DESC',
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
                $sth = $dbh->prepare("SELECT * FROM `Flights` ORDER BY {$sort_sql}");
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
                <table table border=1px class='table_dark'>
                    <thead>
                        <tr>
                            <th>
                                <?php echo sort_link_th('Номер рейса', 'idFlights_asc', 'idFlights_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Дата', 'Data_asc', 'Data_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Аэропорт вылета', 'Airport_out_asc', 'Airport_out_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Аэропорт прилета', 'Airport_in_asc', 'Airport_in_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Компания', 'Company_asc', 'Company_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Время вылета', 'TIme_asc', 'TIme_desc'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row): ?>
                            <tr>
                                <td>
                                    <?php echo $row['idFlights']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Data']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Airport_out']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Airport_in']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Company']; ?>
                                </td>
                                <td>
                                    <?php echo $row['TIme']; ?>
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
        <li><a href="https://www.instagram.com/stucked_s" target="_blank"><ion-icon
                    Name="logo-instagram"></ion-icon></a></li>
        <li><a href="https://github.com/stuckedS" target="_blank"><ion-icon Name="logo-github"></ion-icon></a></li>
    </ul>
    <p>©2023 KDP Berlinskii | All Rights Reserved</p>
</footer>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>
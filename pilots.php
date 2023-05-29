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
        <a href="work.php">Главная страница</a>
        <a href="tablo.php">Онлайн-Табло</a>
        <a href="planes.php">Самолеты</a>
        <a class="active" href="pilots.php">Пилоты</a>
        <a href="index.html"><ion-icon Name="exit"></ion-icon></a>
    </div>
    <main>
        <article>
            <section>
                <h2 class="#top_div">Пилоты</h2>
                <?php
                /* Все варианты сортировки */
                $sort_list = array(
                    'idPilots_asc' => '`idPilots`',
                    'idPilots_desc' => '`idPilots` DESC',
                    'Surname_asc' => '`Surname`',
                    'Surname_desc' => '`Surname` DESC',
                    'Name_asc' => '`Name`',
                    'Name_desc' => '`Name` DESC',
                    'Patronymic_asc' => '`Patronymic`',
                    'Patronymic_desc' => '`Patronymic` DESC',
                    'Company_asc' => '`Company`',
                    'Company_desc' => '`Company` DESC',
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
                $sth = $dbh->prepare("SELECT * FROM `Pilots` ORDER BY {$sort_sql}");
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
                                <?php echo sort_link_th('Номер пилота', 'idPilots_asc', 'idPilots_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Фамилия', 'Surname_asc', 'Surname_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Имя', 'Name_asc', 'Name_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Отчество', 'Patronymic_asc', 'Patronymic_desc'); ?>
                            </th>
                            <th>
                                <?php echo sort_link_th('Компания', 'Company_asc', 'Company_desc'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row): ?>
                            <tr>
                                <td>
                                    <?php echo $row['idPilots']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Surname']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Patronymic']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Company']; ?>
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
            <li><a href="https://vk.com/d.berlinsky" target="_blank"><ion-icon name="logo-vk"></ion-icon></a></li>
            <li><a href="https://www.instagram.com/stucked_s" target="_blank"><ion-icon name="logo-instagram"></ion-icon></a>
            </li>
            <li><a href="https://github.com/stuckedS" target="_blank"><ion-icon name="logo-github"><ion-icon></a></li>
        </ul>
        <p>©2023 KDP Berlinskii | All Rights Reserved</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>
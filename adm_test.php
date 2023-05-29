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
<?php
    if ($_SESSION['user_id'] == 3) {
        echo '<div class="topnav" >';
        echo '<a href="adm_service.php">Редактировать работников</a>';
        echo '<a href="adm_tech.php">Редактировать технику обслуживания</a>';
        echo '<a class="active" href="adm_test.php">Выходные документы</a>';
        echo '<a href="index.html"><ion-icon Name="Exit"><ion-icon></a>';
        echo '</div> ';
    } else {
        echo '<div class="topnav" >';
        echo '<a href="adm_tablo.php">Редактировать Онлайн-Табло</a>';
        echo '<a href="adm_planes.php">Редактировать Самолеты</a>';
        echo '<a href="adm_pilots.php">Редактировать Пилоты</a>';
        echo '<a class="active"  href="adm_service.php">Редактировать работников</a>';
        echo '<a href="adm_tech.php">Редактировать технику обслуживания</a>';
        echo '<a href="adm_test.php">Выходные документы</a>';
        echo '<a href="index.html"><ion-icon Name="Exit"><ion-icon></a>';
        echo '</div> ';
    }

    ?>
    <main>
        <article>
            <section>
                <h2 class="#top_div">Выходные документы</h2>
                <form>
                    <div class="form-group">
                        <ul class='output'>
                            <ul>
                                <li>
                                    <div class="form-group">
                                        <label><big><b>Накладная для рейса</b></big></label>
                                        <form> </form>
                                        <form method="GET" action="output.php">
                                            <input type="text" id="IDD" name="IDD" aria-describedby="IDD"
                                                placeholder="ID" value="<?php echo $_GET['IDD'] ?>">
                                            <input class='btn' type="submit" name="submit1" value="Поиск">
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label><big><b>Накладная для бригады</b></big></label>
                                        <form method="GET" action="output.php">
                                            <input type="text" id="Data" name="Data" aria-describedby="Data"
                                                placeholder="Data" value="<?php echo $_GET['Data'] ?>">
                                            <input type="text" id="ID" name="ID" aria-describedby="ID" placeholder="ID"
                                                value="<?php echo $_GET['ID'] ?>">
                                            <input class='btn' type="submit" name="submit2" value="Поиск">
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label><big><b>Сотрудники авиакомпаний</b></big></label>
                                        <form method="GET" action="output.php">
                                            <input type="text" id="Сompany" name="Сompany" aria-describedby="Сompany"
                                                placeholder="Сompany" value="<?php echo $_GET['Сompany'] ?>">
                                            <input class='btn' type="submit" name="submit3" value="Поиск">
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </ul>
                    </div>
                </form>
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
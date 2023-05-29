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
        <a class="active" href="work.php">Главная страница</a>
        <a href="tablo.php">Онлайн-Табло</a>
        <a href="planes.php">Самолеты</a>
        <a href="pilots.php">Пилоты</a>
        <a href="index.html"><ion-icon Name="Exit"><ion-icon></a>
    </div>
    <div class="#home">
    </div>
    <main>
        <article>
            <section>
                <h2>Добро пожаловать в наш аэропорт.</h2>
                <div>Сегодня в нашем аэропорту выполняются следующие рейсы</div>
                <?php
                date_default_timezone_set('UTC-3');
                $date1 = date("j-n-Y");
                $conn = mysqli_connect("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");

                if (!$conn) {
                    die("Ошибка: " . mysqli_connect_error());
                }
                if (true) {
                    $sql = "SELECT DISTINCT idFlights,Airport_in ,Airport_out,Company,TIme  FROM Flights  where Data ='$date1'";
                }
                if ($result = mysqli_query($conn, $sql)) {
                    $rowsCount = mysqli_num_rows($result); // количество полученных строк
                    echo "<table border = 1px class='table_dark'>
                    <tr>
                        <th>Id рейса</th>
                        <th>Аэрпорт вылета</th>
                        <th>Аэрпорт прилета</th>
                        <th>Компания</th>
                        <th>Время рейса</th>
                    </tr>";
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td >" . $row["idFlights"] . "</td>";
                        echo "<td >" . $row["Airport_out"] . "</td>";
                        echo "<td >" . $row["Airport_in"] . "</td>";
                        echo "<td >" . $row["Company"] . "</td>";
                        echo "<td >" . $row["TIme"] . "</td>";
                        echo "</tr>";
                    }
                    echo "
                </table>";
                    mysqli_free_result($result);
                } else {
                    echo "Ошибка: " . mysqli_error($conn);
                }
                mysqli_close($conn);
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
        <li><a href="https://www.linkedin.com/in/david-berlinskii-b03228194/"><ion-icon name="logo-linkedin"><ion-icon></a></li>
        <li><a href="https://vk.com/d.berlinsky" target="_blank"><ion-icon name="logo-vk"></ion-icon></a></li>
        <li><a href="https://www.instagram.com/stucked_s/" target="_blank"><ion-icon
                    name="logo-instagram"></ion-icon></a></li>
        <li><a href="https://github.com/stuckedS " target="_blank"><ion-icon name="logo-github"></ion-icon></a></li>
    </ul>
    <p>©2023 KDP Berlinskii | All Rights Reserved</p>
</footer>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>
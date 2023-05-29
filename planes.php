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
    <header>
        <div class="topnav">
            <a href="work.php">Главная страница</a>
            <a href="tablo.php">Онлайн-Табло</a>
            <a class="active" href="planes.php">Самолеты</a>
            <a href="pilots.php">Пилоты</a>
            <a href="index.html"><ion-icon Name="Exit"><ion-icon></a>
        </div>
    </header>
    <main class="main">
        <h2>Модели самолетов в нашем аэропорту</h2>
        <?php
        $eventDate = htmlspecialchars($_POST["eventDate"]);
        $flight_date = trim($_REQUEST['flight-start']);
        $request = "where Data like " . $eventDate;
        $conn = mysqli_connect("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");

        if (!$conn) {
            die("Ошибка: " . mysqli_connect_error());
        }
        if (true) {
            $sql = "SELECT * FROM `Aircraft` GROUP BY Model";
        }
        if ($result = mysqli_query($conn, $sql)) {
            $rowsCount = mysqli_num_rows($result); // количество полученных строк
            echo "<div class='#cont_for_cont'";
            foreach ($result as $row) {
                echo "<div class='#container'>";
                echo "<table width='100%' cellspacing='0' cellpadding='0' margin='auto'>";
                if ($row["Model"] == "Airbus A320") {
                    echo "<h3>" . $row["Model"] . "</h3>";
                    echo "<tr>";
                    echo "<td class='leftcol'>'<img src='photo/A320.jpg'>'</td>";
                    echo "<td vailgn='top'><div class='text'> ".$row["Description"]."
                    <br><br><u>Характеристки самолета:</u>
                    <br>Вместимость топлива:<br><b>"
                        . $row["Fuel"] .
                        "</b><div class='text'>Вместимость пассижиров:<br><b>"
                        . $row["Capacity"] .
                        "</b></div>";
                    echo "<a class ='btn' href=flight.php?Model='Airbus+A320'>Рейсы с данной моделью</a>";
                    echo "</tr>";
                } else if ($row["Model"] == "Boeing 787") {
                    echo "<h3>" . $row["Model"] . "</h3>";
                    echo "<tr>";
                    echo "<td class='leftcol'>'<img src='photo/B-787.jpeg'>'</td>";
                    echo "<td vailgn='top'><div class='text'> ".$row["Description"]."
                    <br><br><u>Характеристки самолета:</u>
                    <br>Вместимость топлива:<br><b>"
                        . $row["Fuel"] .
                        "</b><div class='text'>Вместимость пассижиров:<br><b>"
                        . $row["Capacity"] .
                        "</b></div>";
                        echo "<a class ='btn' href=/flight.php?Model='Boeing+787'>Рейсы с данной моделью</a>";
                        echo "</tr>";
                }else if ($row["Model"] == "Boeing 747-400") {
                    echo "<h3>" . $row["Model"] . "</h3>";
                    echo "<tr>";
                    echo "<td class='leftcol'>'<img src='photo/B-747-400.jpeg'>'</td>";
                    echo "<td vailgn='top'><div class='text'> ".$row["Description"]."
                    <br><br><u>Характеристки самолета:</u>
                    <br>Вместимость топлива:<br><b>"
                        . $row["Fuel"] .
                        "</b><div class='text'>Вместимость пассижиров:<br><b>"
                        . $row["Capacity"] .
                        "</b></div>";
                    echo "<a class ='btn' href=/flight.php?Model='Boeing+747-400'>Рейсы с данной моделью</a>";
                    echo "</tr>";
                } else if ($row["Model"] == "Boeing 777-300") {
                    echo "<h3>" . $row["Model"] . "</h3>";
                    echo "<tr>";
                    echo "<td class='leftcol'>'<img src='photo/B-777.jpeg'>'</td>";
                    echo "<td vailgn='top'><div class='text'>".$row["Description"]."
                    <br><br><u>Характеристки самолета:</u>
                    <br>Вместимость топлива:<br><b>"
                        . $row["Fuel"] .
                        "</b><div class='text'>Вместимость пассижиров:<br><b>"
                        . $row["Capacity"] .
                        "</b></div>";
                    echo "<a class ='btn' href=/flight.php?Model='Boeing+777-300'>Рейсы с данной моделью</a>";
                    echo "</tr>";
                }
                else if ($row["Model"] == "Sukhoi Superjet 100") {
                    echo "<h3>" . $row["Model"] . "</h3>";
                    echo "<tr>";
                    echo "<td class='leftcol'>'<img src='photo/Sukhoi.jpg'>'</td>";
                    echo "<td vailgn='top'><div class='text'>" .$row["Description"]."
                    <br><br><u>Характеристки самолета:</u>
                    <br>Вместимость топлива:<br><b>"
                        . $row["Fuel"] .
                        "</b><div class='text'>Вместимость пассижиров:<br><b>"
                        . $row["Capacity"] .
                        "</b></div>";
                    echo "<a class ='btn' href=/flight.php?Model='Sukhoi+Superjet+100'>Рейсы с данной моделью</a>";
                    echo "</tr>";
                } 
                echo "</table>";
                echo "</div>";
            }
            echo "</div>";
            mysqli_free_result($result);
        } else {
            echo "Ошибка: " . mysqli_error($conn);
        }
        mysqli_close($conn);        
        ?>

    </main>
    <footer>
            <div class="waves">
                <div class="wave" id="wave1"></div>
            </div>
            <ul class="social">
               <li><a href="https://www.linkedin.com/in/david-berlinskii-b03228194/"><ion-icon Name="logo-linkedin" target="_blank"><ion-icon></a></li>
                <li><a href="https://vk.com/d.berlinsky" target="_blank"><ion-icon name="logo-vk"></ion-icon></a></li>
                <li><a href="https://www.instagram.com/stucked_s" target="_blank"><ion-icon name="logo-instagram"></ion-icon></a></li>
                <li><a href="https://github.com/stuckedS" target="_blank"><ion-icon name="logo-github"></ion-icon></a>
                </li>
            </ul>
            <p>©2023 KDP Berlinskii | All Rights Reserved</p>
        </footer>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
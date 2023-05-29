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
        <a href="work.php">Главная страница</a>
        <a href="tablo.php">Онлайн-Табло</a>
        <a href="planes.php">Самолеты</a>
        <a href="pilots.php">Пилоты</a>
        <a href="index.html"><ion-icon Name="Exit"><ion-icon></a>
    </div>
    <main>
        <article>
            <section>
                <?php
                $model=mb_substr($_GET["Model"],1,-1); 
                echo "<h2 text align='center' class = '#top_div'>".$model."</h2>";
               // $eventDate = htmlspecialchars($_POST["eventDate"]);
                $conn = mysqli_connect("localhost", "o92644i4_kdp", "ABOBuS1", "o92644i4_kdp");

                if (!$conn) {
                    die("Ошибка: " . mysqli_connect_error());
                }
                if (true)
                {
                    $sql = "SELECT DISTINCT idAircraft,Airport_in ,Airport_out,Company,Data FROM Aircraft,Flights  where Model = $_GET[Model] AND id_Aircraft = idAircraft";
                }
                if ($result = mysqli_query($conn, $sql)) {

                    $rowsCount = mysqli_num_rows($result); // количество полученных строк
                    echo "<table border = 1px class='table_dark'>
                    <tr>
                        <th>Id самолета</th>
                        <th>Аэрпорт вылета</th>
                        <th>Аэрпорт прилета</th>
                        <th>Компания</th>
                        <th>Дата</th>
                    </tr>";
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td >" . $row["idAircraft"] . "</td>";
                        echo "<td >" . $row["Airport_out"] . "</td>";
                        echo "<td >" . $row["Airport_in"] . "</td>";
                        echo "<td >" . $row["Company"] . "</td>";
                        echo "<td >" . $row["Data"] . "</td>";
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
       <li><a href="https://www.linkedin.com/in/david-berlinskii-b03228194/"><ion-icon Name="logo-linkedin" target="_blank"><ion-icon></a></li>
        <li><a href="https://vk.com/d.berlinsky" target="_blank"></ion-icon name="logo-vk"></ion-icon></a></li>
        <li><a href="https://www.instagram.com/stucked_s" target="_blank"></ion-icon name="logo-instagram"></ion-icon></a></li>
        <li><a href="https://github.com/stuckedS" target="_blank"><ion-icon name="logo-github"></ion-icon></a></li>
    </ul>
    <p>©2023 KDP Berlinskii | All Rights Reserved</p>
</footer>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>




















<!-- <div class="top_div">
                    <div id="con1">
                        Дата вылета:</b>
                        <form action href="tablo.php">
                        <input type="text"  placeholder="YYYY-MM-DD" pattern="(?:19|20)(?:(?:[13579][26]|[02468][048])-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))|(?:[0-9]{2}-(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:29|30))|(?:(?:0[13578]|1[02])-31)))" class="form-control "  name="eventDate" id="" required autofocus autocomplete="nope">
                        
                        </form>
                        </p>
                    </div>
                    <div id="con2">Название компании:</div>
                    <div id="con3">Аэропорт вылета:</div>
                </div> -->
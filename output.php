<?php
if (isset($_GET['submit1'])) {
    // Вызываем функцию
    myFunction1();
} elseif (isset($_GET['submit2'])) {
    // Вызываем функци
    myFunction2();
} elseif (isset($_GET['submit3'])) {
    // Вызываем функцию
    myFunction3();
}

function myFunction1()
{
    $id = $_GET["IDD"];
    require('tfpdf/tfpdf.php');
    $pdo = new PDO('mysql:dbname=o92644i4_kdp;host=localhost', 'o92644i4_kdp', 'ABOBuS1');
    $stmt = $pdo->prepare("SELECT * FROM Flights where `idFlights`=$id");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdf = new tFPDF();
    $pdf->AddPage();
    // Заголовки столбцов
    $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
    $pdf->SetFont('DejaVu', '', 20);
    foreach ($data as $row)
        ;
    $pdf->Cell(0, 0, "Накладная пилота", 0, 0, 'C');
    $pdf->SetFontSize(14);
    $pdf->Ln();
    $pdf->Cell(0, 15, "Номер рейса:" . $row['idFlights']);
    $pdf->Ln();
    $pdf->Cell(0, 15, "Аэропорт прилета:  " . $row['Airport_out']);
    $pdf->Ln();
    $pdf->Cell(0, 15, "Аэропорт вылета:  " . $row['Airport_in']);
    $pdf->Ln();
    $pdf->Cell(0, 15, "Дата:  " . $row['Data']);
    $pdf->Ln();
    $pdf->Cell(0, 15, "Время:  " . $row['TIme']);
    $pdf->Ln();
    $pdf->Cell(0, 15, "Компания:  " . $row['Company']);
    $pdo = new PDO('mysql:dbname=o92644i4_kdp;host=localhost', 'o92644i4_kdp', 'ABOBuS1');
    $stmt = $pdo->prepare("SELECT `Surname`,`Name`,`Patronymic`,`idPilots`,`IdofPilot` from Pilots,Flights where idPilots = IdofPilot and `idFlights`=$id");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pdf->Ln(); foreach ($data as $row)
        ;
    $pdf->Cell(0, 15, "ID:" . $row['IdofPilot']);
    $pdf->Ln();
    $pdf->Cell(0, 15, "Рейс выполнил(а):" . "   " . $row['Surname'] . '   ' . $row['Name'] . ' ' . $row['Patronymic']);
    $pdf->Ln();
    $pdf->Cell(0, 15, "Время прилета" . ":___________________");
    $pdf->Ln();
    $pdf->Cell(0, 15, "Подпись:___________________");
    $pdf->Ln();
    $pdf->Output();


}
function myFunction2()
{
    $Data = strval($_GET["Data"]);
    $id = $_GET["ID"];
    require('tfpdf/tfpdf.php');
    $pdo = new PDO('mysql:dbname=o92644i4_kdp;host=localhost', 'o92644i4_kdp', 'ABOBuS1');
    $stmt = $pdo->prepare("SELECT Flights.`idFlights`,`Data`,`Airport_out`,`Airport_in`,`Id_Aircraft`,`Typeofstay`,`Company`,`TIme`,`IdofPilot`,`idService`,Service.`idBrigade`,Service.`idFlights`,idEmployees,Surname,Name,Patronymic,`Employees_idEmployees`,Job 
    FROM `Flights`,`Service`,Employees,Brigade 
    where (Flights.idFlights=Service.idFlights 
    and Job = 'Бригадир' 
    and idEmployees=Employees_idEmployees 
    and Service.`idBrigade`=$id
    and `Data` like '$Data')");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pdf = new tFPDF();
    $pdf->AddPage();
    $columnWidth = 30;
    $rowHeight = 10;
    // Заголовки столбцов
    $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
    $pdf->SetFont('DejaVu', '', 10);
    foreach ($data as $row);
    $pdf->Ln();
    $pdf->Cell(0, 15, "Бригада №  " . $row['idBrigade'], 0, 0, 'L');
    $pdf->Ln();
    $pdf->Cell($columnWidth, $rowHeight, 'Номер рейса', 1, 0, 'C');
    $pdf->Cell($columnWidth, $rowHeight, 'Дата', 1, 0, 'C');
    $pdf->Cell($columnWidth, $rowHeight, 'Аэропорт вылета', 1, 0, 'C');
    $pdf->Cell($columnWidth, $rowHeight, 'Аэропорт прилета', 1, 0, 'C');
    $pdf->Cell($columnWidth, $rowHeight, 'Компания', 1, 0, 'C');
    $pdf->Cell($columnWidth, $rowHeight, 'Время вылета', 1, 1, 'C'); 
    foreach ($data as $row1) {
        if ($row1['idFlights'] == $x)
        {
            next($data);
        }
        else {
            $pdf->Cell($columnWidth, $rowHeight, $row1['idFlights'], 1, 0, 'C');
            $pdf->Cell($columnWidth, $rowHeight, $row1['Data'], 1, 0, 'C');
            $pdf->Cell($columnWidth, $rowHeight, $row1['Airport_out'], 1, 0, 'C');
            $pdf->Cell($columnWidth, $rowHeight, $row1['Airport_in'], 1, 0, 'C');
            $pdf->Cell($columnWidth, $rowHeight, $row1['Company'], 1, 0, 'C');
            $pdf->Cell($columnWidth, $rowHeight, $row1['TIme'], 1, 1, 'C');
            $x = $row1['idFlights'];
        }
    }
    $pdf->Ln();

    $pdf->SetFont('DejaVu', '', 12);
    $pdf->Cell(0, 15, "Бригадир:  " . "  " . $row['Surname'] . "  " . $row['Name'] . "  " . $row['Patronymic'], 0, 0, 'L');
    $pdf->Ln();
    $pdf->Cell(0, 15, "Подпись:______________________", 0, 0, 'L');
    $pdf->Ln();
    $pdf->Output();




}
function myFunction3()
{
    $company = $_GET["Сompany"];
    require('tfpdf/tfpdf.php');
    $pdo = new PDO('mysql:dbname=o92644i4_kdp;host=localhost', 'o92644i4_kdp', 'ABOBuS1');
    $stmt = $pdo->prepare("SELECT * FROM `Pilots` where `Company` like '$company'");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pdf = new tFPDF();
    $pdf->AddPage();
    $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
    $pdf->SetFont('DejaVu', '', 20);
    $pdf->Cell(0, 15, "Название компании:  " . $company);
    $pdf->Ln();
    $pdf->SetFontSize(14);
    foreach ($data as $row) {
        $pdf->Cell(0, 15, $row['idPilots'] . "  " . $row['Surname'] . " " . $row['Name'] . " " . $row['Patronymic']);
        $pdf->Ln();
    }
    $pdf->Ln();
    $pdf->Cell(0, 15, "Удтверждено(ФИО):_____________________________________________");
    $pdf->Ln();
    $pdf->Cell(0, 15, "Подпись:______________________");
    $pdf->Output();
}

?>
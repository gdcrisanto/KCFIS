
<?php
  require "template.php";
  $sql = "SELECT *
          FROM otherincometab
          WHERE otherIncomeID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET['oiid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $amount = $row['amount'];
    $dateReceived = $row['dateReceived'];
    $receivedFrom = $row['receivedFrom'];
    $ackReceiptNo = $row['ackReceiptNo'];
  }

  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', '', 16);

  $pdf->Ln(10);

  $pdf->Cell(190,8, 'KALAYAAN COLLEGE',0,1, 'C');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(190,5, 'No. 22 Manga Street, New Manila, Quezon City',0,1, 'C');
  $pdf->Cell(190,5, 'Tels. 726-6291 / 724-9651 / 723-0876 / 726-6291',0,1, 'C');
  $pdf->Cell(190,5, 'Email: info@kalayaan.edu.ph | Website: wwww.kalayaan.edu.ph',0,1, 'C');
  $pdf->Line(10,45,200,45);



  $pdf->SetFont('Arial', '', 14);

  $pdf->Ln(10);
  $pdf->Cell(155,10, 'Date', 0,0,'R');
  $pdf->Cell(35,10, ': '.$dateReceived, 0,1,'R');

  $pdf->Ln(10);
  $pdf->Cell(40,10, 'Receipt No.', 0,0);
  $pdf->Cell(55,10, ': '.$ackReceiptNo, 0,1);

  $pdf->Ln(5);
  $pdf->Cell(40,10, 'Received From', 0,0);
  $pdf->Cell(55,10, ': '.$receivedFrom, 0,1);

  $pdf->Ln(5);
  $pdf->Cell(40,10, 'Amount Received', 0,0);
  $pdf->Cell(150,10, ': PHP '.$amount, 0,1);

  $pdf->Ln(20);
  $pdf->Cell(130,10, "Cashier's Signature:", 0,0,'R');
  $pdf->Cell(60,10, '______________________', 0,1,'R');


  $pdf->Output();



 ?>

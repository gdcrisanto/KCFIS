
<?php
  require "template.php";
  $sql = "SELECT *
          FROM studtranstab
          WHERE studtransID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET['studid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studtransID = $row['studtransID'];
    $acctinfoID = $row['acctinfoID'];
    $amountReceived = $row['amountReceived'];
    $dateReceived = $row['dateReceived'];
    $receiptNo = $row['receiptNo'];
    $modeOfPayment = $row['modeOfPayment'];
  }
  $sql = "SELECT *
          FROM acctinfotab
          WHERE acctinfoID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $acctinfoID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studID = $row['studID'];
    $paymentPlan = $row['paymentPlan'];
  }
  $sql = "SELECT *
          FROM studentinfotab
          WHERE studID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $studID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studentno = $row['studentno'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    $mname = $row['mname'];
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



  $pdf->SetFont('Arial', '', 12);

  $pdf->Ln(10);
  $pdf->Cell(155,7, 'Date', 0,0,'R');
  $pdf->Cell(35,7, ': '.$dateReceived, 0,1,'R');

  $pdf->Ln(10);
  $pdf->Cell(40,7, 'Receipt No.', 0,0);
  $pdf->Cell(55,7, ': '.$receiptNo, 0,1);

  $pdf->Ln(5);
  $pdf->Cell(40,7, 'Received From', 0,0);
  $pdf->Cell(55,7, ': '.$lname.', '.$fname.' '.$mname , 0,1);

  $pdf->Cell(40,7, 'Student No.', 0,0);
  $pdf->Cell(150,7, ': '.$studentno, 0,1);

  $pdf->Ln(5);
  $pdf->Cell(40,7, 'Amount Received', 0,0);
  $pdf->Cell(150,7, ': PHP '.$amountReceived, 0,1);

  $pdf->Cell(40,7, 'Mode of Payment', 0,0);
  $pdf->Cell(150,7, ': '.$modeOfPayment, 0,1);

  $pdf->Ln(20);
  $pdf->Cell(130,10, "Cashier's Signature:", 0,0,'R');
  $pdf->Cell(60,10, '______________________', 0,1,'R');


  $pdf->Output();



 ?>

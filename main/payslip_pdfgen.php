<?php
ob_start();
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
include('connect.php');
require('payslip_pdf.php');
define('FPDF_FONTPATH','fonts/');
$period=$_REQUEST['period'];
$payrollid=$_REQUEST['payrollid'];
$main=mysqli_fetch_array(mysqli_query($GLOBALS['connect'],"SELECT main_name as name ,main_location as location,main_tel as tel ,main_address as address, email from settings"));
$companyname=$main['name'];
$companyloc=$main['location'];
$companyaddress=$main['address'];
$companytel=$main['tel'];
$companyemail=$main['email'];
//QUERY ALL DETAILS
$datesquery=mysqli_query($GLOBALS['connect'],"SELECT pt.staffid as id, pt.payrollno as payrollno ,pt.sname as name ,pt.salary as basic ,pt.lunch as lunch,pt.commission as commission ,(pt.salary+pt.overtime+pt.commission+pt.allowance+pt.lunch) as gross,pt.nhif as nhif ,pt.nssf as nssf,pt.advance as advance,pt.tax as paye,pt.taxableincome as taxableincome,pt.totaldeductions as totaldeductions,pt.daterun as payrolldate,pt.overtime as overtime ,pt.allowance as allowance,pt.netpay as net,pt.surrcharge as surrcharge ,pt.helb as helb ,pt.deduction as absent FROM payroll_tbl pt  WHERE pt.payrollrun='$period' and pt.id='$payrollid'");
while ( $row=mysqli_fetch_array($datesquery)) {
  $id=$row['id'];
  $s=mysqli_fetch_array(mysqli_query($GLOBALS['connect'],"SELECT st.type_name as stype, s.national_id as natid ,s.accountno as bankacc ,s.bankcode as bcode FROM staff s  inner join stafftype st on st.id=s.staff_type  where s.id='$id'"));
    $bcode=$s['bcode'];
    $b=mysqli_fetch_array(mysqli_query($GLOBALS['connect'],"SELECT b.bank as bank ,bb.bname as branch FROM staff s inner join bankbranch bb on bb.code=s.branchcode inner join banks b on b.bcode=s.bankcode inner join banks b1 on b.bcode=bb.bankCode where s.id='$id' "));
    $bank=$b['bank'];
    $stype=$s['stype'];
    $natid=$s['natid'];
    $bankacc=$s['bankacc'];
    $branch=$b['branch'];
$date=$row['payrolldate'];
$name=$row['name'];
$basic=$row['basic'];
$id=$row['id'];
$lunch=$row['lunch'];
$commission=$row['commission'];
$allowance=$row['allowance'];
$gross=$row['gross'];
$nhif=$row['nhif'];
$nssf=$row['nssf'];
$advance=$row['advance'];
$paye=$row['paye'];
$surcharge=$row['surrcharge'];
$absent=$row['absent'];
$helb=$row['helb'];
$net=$row['net'];
$commission=$row['commission'];
$net=$row['net'];
$taxableincome=$row['taxableincome'];
$totaldeductions=$row['totaldeductions'];
$payrollno=$row['payrollno'];
$overtime=$row['overtime'];
$pdf = new PDF_Invoice( 'p', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "$companyname",
                  "$companyaddress \n" .
                  "$companyloc \n".
                  "email: $companyemail \n" .
                  "Tel : $companytel ");
$pdf->fact_dev( "MONTHLY","PAYSLIP" );
$pdf->temporaire("$companyname" );
$pdf->addDate( "$date");
$pdf->addClient("PAID");
$pdf->addPageNumber("$period");
$pdf->addClientAdresse("BANKING INFO: \nNo:$payrollno\nBank:$bank\nBranch:$branch\nAccount No: $bankacc");
$pdf->addReglement("$name");
$pdf->addEcheance("$natid");
$pdf->Ln();
$pdf->addNumTVA("$stype");
$pdf->addReference("$id.$date");
$cols=array( 
             "Description"  => 100,
             "Amount"      => 69 );
$pdf->addCols( $cols);
$cols=array( 
             "Description"  => "L",
             "Amount"      => "R");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

$y    = 109;
$line = array( 
               "Description"  => "Basic \n" ,
               "Amount"      => "$basic" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 5;

$line = array( 
               "Description"  => "BENEFITS \n" .
                                 "Allowance \n".
                                 "Lunch \n".
                                 "Bonus \n".
                                 "Commission \n",
               "Amount"      => "\n".
                                " $allowance\n".
                                " $commission\n".
                                " $overtime\n".
                                " $lunch\n");
$size = $pdf->addLine( $y, $line );
$y   += $size + 5;

$line = array( 
               "Description"  => "DEDUCTIONS \n" .
                                  "\n".
                                 "HELB \n".
                                 "Surcharge \n".
                                 "Absenteeism \n".
                                 "Advance \n".
                                 "NSSF \n".
                                 "NHIF \n".
                                 "PAYE \n",
               "Amount"      => "\n".
                                "\n".
                                " $helb\n".
                                " $surcharge\n".
                                " $absent\n".
                                " $advance\n".
                                " $nssf\n".
                                " $nhif\n".
                                " $paye\n");
$size = $pdf->addLine( $y, $line );
$y   += $size + 5;



$line = array( 
               "Description"  => "Gross Pay\n" .
                                 "Taxable Income \n".
                                 "PAYE \n".
                                 "\n".
                                 "NET PAY \n",
               "Amount"      => "$gross\n".
                                " $taxableincome\n".
                                " $paye\n".
                                " \n".
                                " $net\n");
$size = $pdf->addLine( $y, $line );

$pdf->addRemarque("This is a valid computer generated document for any information kindly contact: 0729036698".
                  "\n".
                  "Powered by Techcube Ke!");
//$pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
/*$tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
                    array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
$tab_tva = array( "1"       => 19.6,
                  "2"       => 5.5);
$params  = array( "RemiseGlobale" => 1,
                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                      "remise"         => 0,       // {montant de la remise}
                      "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                  "FraisPort"     => 1,
                      "portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
                      "portHT"         => 0,       // montant des frais de ports HT
                      "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                  "AccompteExige" => 1,
                      "accompte"         => 0,     // montant de l'acompte (TTC)
                      "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
                  "Remarque" => "Avec un acompte, svp..." );

$pdf->addTVAs( $params, $tab_tva, $tot_prods);
$pdf->addCadreEurosFrancs();
*/
$pdf->Output();
}
ob_end_flush();
?>

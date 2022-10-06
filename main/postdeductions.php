<?php
include('header.php');
$period=$_POST['period'];
//
$stafftyperesult=mysqli_query($GLOBALS['connect'], ("SELECT id,type_name from stafftype ");
?>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-5">
                    <h2>Payroll Entries Period: <?php echo $period?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="dash.php">HR Dashboard</a>
                        </li>
                        <li class="active">
                            <strong><a href="#">Payroll Deductions Entries </a></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

 <div class="wrapper wrapper-content white-bg">
<div class="row">
<div class="col-lg-12">          
<form  action="payrollclass.php?period=<?php echo $period?>&&action=postdeductions" method="post">
<?php  while($staff=mysqli_fetch_array($stafftyperesult)) {
//$staff=mysqli_fetch_array($stafftyperesult) ;
$sname=$staff['type_name'];
$sid=$staff['id'];
$len=count($staff);	

	?>
<div class="form-group">
<table class="table table-bordered ">
<h3 align="center"><font color="blue"  ><?php echo $sname?></font></h3>
	<thead>
		<th>Staff Name </th>
		<th>Category </th>
		<th>Salary </th>
		<th>Absenteeism </th>
		<th>NHIF </th>
		<th>NSSF </th>
		<th>Advance </th>
		<th>Surcharge </th>
		<th>Helb </th>
		<th>Total Deductions</th>
	</thead>
	<tbody class="details">
	<?php 
	$seresult=mysqli_query($GLOBALS['connect'], ("SELECT id,staff_name as s ,payrollno as p,salary as sal FROM staff WHERE staff_type='$sid' ");

	while($s=mysqli_fetch_array($seresult)){ 
		$sid=$s['id'];
		//get advance
		$adv=mysqli_fetch_array(mysqli_query($GLOBALS['connect'], ("SELECT totalbenefits as bens FROM payroll_tbl WHERE staffid='$sid' and payrollrun='$period' "));

		$amnt=$adv['bens'];

	$sal1=$s['sal'];	
$sal=$sal1+$amnt;
if ($sal<=5999) {
$nhif=150;			
}elseif ($sal>5999 and $sal<=7999) {
$nhif=300;
}elseif ($sal>7999 and $sal<=11999) {
$nhif=400;
}elseif ($sal>11999 and $sal<=14999) {
$nhif=500;
}elseif ($sal>14999 and $sal<=19999) {
$nhif=600;
}elseif ($sal>19999 and $sal<=24999) {
$nhif=750;
}elseif ($sal>24999 and $sal<=29999) {
$nhif=850;
}elseif ($sal>29999 and $sal<=34999) {
$nhif=900;
}elseif ($sal>34999 and $sal<=39999) {
$nhif=950;
}elseif ($sal>39999 and $sal<=44999) {
$nhif=1000;
}elseif ($sal>44999 and $sal<=49999) {
$nhif=1100;
}elseif ($sal>49999 and $sal<=59999) {
$nhif=1200;
}elseif ($sal>59999 and $sal<=69999) {
$nhif=1300;
}elseif ($sal>69999 and $sal<=79999) {
$nhif=1400;
}elseif ($sal>79999 and $sal<=89999) {
$nhif=1500;
}elseif ($sal>89999 and $sal<=99999) {
$nhif=1600;
}elseif ($sal>99999) {
$nhif=1700;
}		
		?>
	<tr>
		<input class="hidden" name="id[]" value="<?php echo $s['id'] ?>">
		<td><?php echo $s['s']?> </td>
		<td><font color="red"><?php echo $sname ?></font> </td>
		<td><?php echo $sal1?> </td>
		<td><input required=""  name="deds[]" id="deds" value=""  required=""> </td>
		<td><input readonly=""  name="nhif[]" id="nhif" value="<?php echo $nhif?>" > </td>
<?php 
if ($sal1<=20000) {
	$nssf=200;
}elseif ($sal1>20000) {
	$nssf=1080;
}
?>		
		<td><input readonly="" =""  name="nssf[]" id="nssf" value="<?php echo $nssf?>" > </td>
		<!--td><input readonly=""  name="advance[]" id="advance" value="<?php echo $amnt?>" > </td-->
		<td><input  name="advance[]" id="advance" value="" required="" > </td>
		<td><input  name="surch[]" id="sur" value="0" required="" > </td>
		<td><input  name="helb[]" id="helb" value="0" required="" > </td>
		<td><input readonly=""   name="tot[]" id="tot" value="0" > </td>
		
	</tr>
	<?php }?>	
	</tbody>
</table>
</div>
<?php  } ?>
<div class="form-group">
	<button class="btn btn-danger" type="submit">Post Deductions</button>
</div>
</form>




    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });



	$('.details').delegate('#nhif,#deds,#advance,#nssf,#sur,#helb','keyup',function(){
			var tr = $(this).parent().parent();
			var nhif = tr.find('#nhif').val();
			var nssf   = tr.find('#nssf').val();
			var deds = tr.find('#deds').val();
			var advance = tr.find('#advance').val();
			var helb = tr.find('#helb').val();
			var sur = tr.find('#sur').val();
			var amount = parseFloat(nhif)+parseFloat(deds)+parseFloat(advance)+parseFloat(nssf)+parseFloat(sur)+parseFloat(helb);
			tr.find('#tot').val(amount);
			total();
		});

    </script>
<?php
include('header.php');
$ward=$_POST['wname'];
$result=mysqli_query($GLOBALS['connect'], ("SELECT * FROM student WHERE ward='$ward'  ORDER BY id DESC");


?>
    <link href="dataTables/dataTables.bootstrap.css" rel="stylesheet" >
    <link href="dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="dataTables/dataTables.tableTools.min.css" rel="stylesheet">
  <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Students List</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li class="active">
                            <strong>Student List</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5><?php echo $ward?> Ward Student List</h5>
                            <div class="ibox-tools">
                                <a href="addstudent.php" class="btn btn-primary btn-xs">New Applicant</a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row m-b-sm m-t-sm">
<div class="table-responsive">
<table class="table table-bordered  dataTables-example"  align="center" id="tableid" datapagesize="20"   >
         <thead>
          <th colspan="11" >

          


        <h4>Student Details</h4>         
             </th>
             
                <tr> 
                    <th class="header" id="usr">Student Name</th>  
                    <th class="header" id="usr">Institution</th>
                    <th class="header" id="usr">Admission Number</th>
                    <th class="header" id="usr">Institution Type</th>
                    <th class="header" id="usr">Ward</th>
                    
                </tr> 
            </thead> 

            <tbody> 
             <?php while ($row = mysqli_fetch_array($result)) { ?>             
                <tr > 
                    <td>  <a href="studentmore.php"><?php echo $row['studentname']?> </a></td>
                    <td><?php echo $row['institution'] ?></td>
                    <td><?php echo $row['admno'] ?></td>
                    <td><?php echo $row['institutiontype']?></td>
                    <td><?php echo $row['ward']?></td>

                  

                 </tr>    
                
                           <?php } ?>
                  
            </tbody> 


            </table>
            </div>
            </div>              
    <script type="text/javascript" src="js/jquery-2.1.1.js"></script> 
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>      
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>


             <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
    </script>
    <style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
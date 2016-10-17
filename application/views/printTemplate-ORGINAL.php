<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
       <meta content="text/html; charset=UTF-8" http-equiv="content-type">
       <title>Header and Footer example</title>
       <style type="text/css">
            @page {
                margin: 0;
            }
            body {
                font-family: Helvetica;
                margin: 1cm;
                text-align: justify;
            }
            #header,
            #footer {
                position: fixed;
                left: 0;
                right: 0;
                color: #aaa;
                background-color: white;
                
            }
            #header {
                top: 0;
                height: 3.5cm;
                border-bottom: 0.1pt solid #aaa;
                margin-left: 1cm;
                margin-right: 1cm;
            }
            #footer {
                bottom: 0;
                margin-left: 1cm;
                margin-right: 1cm;
                height: 2cm;
            }
            #header table,
            #footer table {
                width: 100%;
                border-collapse: collapse;
                border: none;
                position: absolute;
                bottom: 0;
            }
            .page-number {
                text-align: center;
            }
            .page-number:before {
                content: "Page " counter(page);
            }
            .content-table{
                padding-bottom: 2.5cm;
                padding-top: 4cm;
                font-size: 12px;
                width : 100%;
            }
            .left-pane {
                left: 0;
                position: fixed;
                top: 3.35cm;
            }
            .left-pane img{
                height: 13.9cm;
                width:0.8cm;
            }
            .logo {
                height: 2.5cm;
            }
            #header td {
                vertical-align: bottom;
            }
            .pageBottom {
                top: 15px;
                font-size: 12px;
            }
            @media print{
                .left-pane img{
                    height: 23.4cm;
                }
            }
            .sedar-table-head{
                background-color: #E4E1D4;
            }
       </style>
    </head>
    <body>
       <div id="header">
          <table>
             <tbody>
                <tr>
                   <td width="88%" style="text-align: center;"><b>Measurement</b></td>
                   <td style="text-align: right;"><img class="logo" src="<?php echo base_url(); ?>application/assets/img/logo_sedar.png"></td>
                </tr>
             </tbody>
          </table>
       </div>
       <div class="left-pane">
	    <img src="<?php echo base_url(); ?>application/assets/img/bar_sedar.png">
        </div>
       <div id="footer">
        <hr>
          <table class="pageBottom" >
                <tbody>
                    <tr class="foot">
                        <td class="labelFontSize"> Prepared By </td>
                        <td>: MH_CR_UID </td>
                        <td class="labelFontSize">Approved By</td>
                        <td>: MH_APPROVE_UID</td>
                        <td class="labelFontSize">Run Date</td>
                        <td>: <?php echo date('d-M-Y-h:i:s A'); ?></td>
                        <td class="removeBorder" style="text-align: right;">PageNo : 1 of 2</td>
                    </tr>
                </tbody>
            </table>
       </div>
       <div> 
       <table class="content-table">
        <thead>
            <tr class="sedar-table-head">
                <th>S no</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Points</th>
            </tr>
        </thead>
            <?php $count=0; for($i=0; $i<=50; $i++){?>
            <tr>
                <td><?php echo $count; ?></td>
                <td>Jill</td>
                <td>Smith</td>
                <td>50</td>
            </tr>
            <?php $count++;} ?>
        </table></div>
    </body>
 </html>

<?php
$html = '<div style="margin:1px; page-break-after: always;">
    <style type="text/css">
                @media print {
                    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
                }
                table {
                    font-size: 12px;
                    padding: 4px;
                }

                tr {
                    page-break-after: always;
                }

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                    font-size: 60%;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                body {
                    
                }

                .watermark{
                    opacity: 0.75;
                    background-image: url("' . $app_watermark . '");
                    position: relative; 
                    height: 100vh;
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background-size: cover;

                }

                .watermark::before {    
                    content: "";
                    background-image: url("' . $app_watermark . '");
                    background-size: cover;
                    position: absolute;
                    top: 0px;
                    right: 0px;
                    bottom: 0px;
                    left: 0px;
                    opacity: 0.75;
                }
               
                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr {
                    border: 1px solid green dashed;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
                .info{
                    text-align: left;
                }
            </style>
            <div class="pagebreak">
            <div class="footer">
                <hr>
                <b>' . $row->sys_tagline . '</b>
            </div>
            <div class="watermark">
                <body>
                    <h3 class="list_header" align="center">
                        <img src="' . $app_logo . '" align="center">
                            <br>
                            ' . $row->sys_name . ' <br>
                            ' . $row->sys_contacts . ' <br>
                            ' . $row->sys_email  . ' <br>
                            ' . $row->sys_postal_addr . ' <br>
                        <hr style="width:100%" ><br>
                        APPOINTMENT REF# : ' . $id . '  
                    </h3>
                    <h5 class="info">Patient Details</h5>
                    <h5 class="info">Doctor Details</h5>
                </body>
            </div>
        </div>
    </div>';

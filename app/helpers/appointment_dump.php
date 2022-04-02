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

                .watermark {
                    opacity: 0.2;
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                    width: 100%;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
            <div class="pagebreak">
            <div class="footer">
                <hr>
                <b>iAfya - The Ultimate Healthcare Information Management System</b>
            </div>
            <div class="body">
                <h3 class="list_header" align="center">
                    <img src="' . $app_logo . '" align="center">
                    <h3>
                        iAfya  -  <br>

                    </h3>

                    <hr style="width:100%" , color=green>
                    <h3>  APPOINTMENT REF# : ' . $id . '  </h3>
                </h3>
                <img class="watermark" src="' . $app_watermark . '">
            </div>
        </div>
    </div>';

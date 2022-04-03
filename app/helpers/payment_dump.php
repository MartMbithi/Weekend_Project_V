<?php
$html = '<div style="margin:1px; page-break-after: always;">
            <style type="text/css">
                @media print {
                    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
                }
                

                #b_border {
                    border-bottom: dashed thin;
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


                .pagenum:before {
                    content: counter(page);
                }

                /* Thick Green border */
                hr {
                    border: 1px solid green dashed;
                }
                
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }

                /* Patient */
                .patient_details{
                    float: left;
                    text-align:left;
                    width:33.33333%;
                }

                /* Doctor */
                .doctor_details{
                    float: right;
                    text-align:right;
                    width:33.33333%;
                }

                /* Appointment Details */
                .appointment_details{
                    float: left;
                    text-align:center;
                    width:33.33333%;
                }

                /* Letter Head */
                .letter_head{
                    color: green; 
                }

                .pagenum:before {
                    content: counter(page);
                }

            </style>
            <div class="pagebreak">
            <div class="footer letter_head list_header">
                <hr>
                <b>' . $row->sys_tagline . '</b>
            </div>
            <body>
                <h3 class="list_header" align="center">
                    <img src="' . $app_logo . '" align="center">
                    <br>
                    ' . $row->sys_name . ' <br>
                    ' . $row->sys_contacts . ' <br>
                    ' . $row->sys_email  . ' <br>
                    ' . $row->sys_website  . ' <br>
                    ' . $row->sys_postal_addr . ' 
                </h3>
                <h3 class="list_header letter_head" align="center">
                    <hr style="width:100%" >
                    PAYMENT RECEIPT NO: ' . $b . ' <br>
                    <hr style="width:100%" >
                </h3>
                <br>
                <div id="textbox">
                    <p class="patient_details list_header">
                        <b> 
                            <u>
                                Patient Details
                            </u>
                        </b>
                        <br>
                            ' . $users->user_number . '<br>
                            ' . $users->user_name . ' <br>
                            ' . $users->user_email . ' <br>
                            ' . $users->user_phone . ' 
                        <br>
                    </p>
                </div>
                <br><br><br><br><br><br>
                <h3 class="list_header letter_head" >
                    <hr style="width:100%" >
                    TREATMENT DETAILS <br>
                    <hr style="width:100%" >
                </h3>
                
            </body>
            <br><br><br><br>
            <div class="list_header letter_head" align="center">
                <p>Scan To Verify</p>
                <img src="' . $qrbase64 . '" width="100px" height="100px">
            </div>
        </div>
    </div>';

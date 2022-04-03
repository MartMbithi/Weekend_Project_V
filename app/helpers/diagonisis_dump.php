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
                    font-size: 80%;
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
                    MEDICAL RECORD <br>
                    <hr style="width:100%" >
                </h3>
                <br>
                <div id="textbox">
                    ';
                    $sql = "SELECT * FROM users WHERE user_id = '$row->diag_patient_id'";
                    $prepare = $mysqli->prepare($sql);
                    $prepare->execute(); //ok
                    $return = $prepare->get_result();
                    $grade_points = 0;
                    $cumulative_cr_hrs = 0;
                    while ($users = $return->fetch_object()) {
                        $html .=
                    '
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
                    '; }
                    $html .= '  
                    <p class="appointment_details list_header">
                        <b>
                            <u>
                                Medical Info
                            </u>
                        </b>
                        <br>
                            Ref: ' . $id . '<br>
                            Date: ' . date('d M Y', strtotime($row->diag_date_created)) . ' <br>
                            Cost:  Ksh ' . number_format($row->diag_cost, 2). ' <br>
                            Payment Status:  ' . $row->diag_payment_status. ' <br>
                        <br>
                    </p>             
                    <p class="doctor_details list_header">
                        ';
                        $sql = "SELECT * FROM users WHERE user_id = '$row->diag_doctor_id'";
                        $prepare = $mysqli->prepare($sql);
                        $prepare->execute(); //ok
                        $return = $prepare->get_result();
                        while ($doc = $return->fetch_object()) {
                            $html .=
                            '
                            <b>
                                <u>
                                    Doctor Details
                                </u>
                            </b>
                            <br>
                                ' . $doc->user_number . '<br>
                                ' . $doc->user_name . ' <br>
                                ' . $doc->user_email . ' <br>
                                ' . $doc->user_phone . '
                            <br>
                    </p>
                </div>';  }
                $html .= '
                <br><br><br><br><br><br>
                <h3 class="list_header letter_head" align="center">
                    <hr style="width:100%" >
                        DIAGNOSIS, PRESCRIPTIONS & TREATMENT DETAILS
                        <br>
                    <hr style="width:100%" >
                </h3>
                <h5 class="list_header letter_head">
                ' . $row->diag_title . '
                </h5>
                <p class="list_header">
                ' . $row->diag_details . '
                </p>
            </body>
            <br><br><br><br><br><br>
            <div class="list_header letter_head" align="center">
                <p>Scan To Verify</p>
                <img src="' . $qrbase64 . '" width="150px" height="150px">
            </div>
        </div>
    </div>';

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
                .invoice-box {
                    margin: auto;
                    padding: 30px;
                    border: 1px solid #006400;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                    font-size: 16px;
                    line-height: 24px;
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                    color: #000;
                }
                .invoice-box table {
                    width: 100%;
                    line-height: inherit;
                    text-align: left;
                }
                .invoice-box table td {
                    padding: 5px;
                    vertical-align: top;
                }
                .invoice-box table tr td:nth-child(2) {
                    text-align: right;
                }
                .invoice-box table tr.top table td {
                    padding-bottom: 20px;
                }
                .invoice-box table tr.top table td.title {
                    font-size: 45px;
                    line-height: 45px;
                    color: #000;
                }
                .invoice-box table tr.information table td {
                    padding-bottom: 40px;
                }
                .invoice-box table tr.heading td {
                    background: #eee;
                    border-bottom: 1px solid #ddd;
                    font-weight: bold;
                }
                .invoice-box table tr.details td {
                    padding-bottom: 20px;
                }
                .invoice-box table tr.item td {
                    border-bottom: 1px solid #000;
                }
                .invoice-box table tr.item.last td {
                    border-bottom: none;
                }
                .invoice-box table tr.total td:nth-child(2) {
                    border-top: 2px;
                    font-weight: bold;
                }
                @media only screen and (max-width: 600px) {
                    .invoice-box table tr.top table td {
                        width: 100%;
                        display: block;
                        text-align: center;
                    }
                    .invoice-box table tr.information table td {
                        width: 100%;
                        display: block;
                        text-align: center;
                    }
                }
                /** RTL **/
                .invoice-box.rtl {
                    direction: rtl;
                    font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
                .invoice-box.rtl table {
                    text-align: right;
                }
                .invoice-box.rtl table tr td:nth-child(2) {
                    text-align: left;
                }
                .center {
                    text-align: center;
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
                <div class="invoice-box">
                    <table cellpadding="0" cellspacing="0">
                        <tr class="information">
                            <td colspan="2">
                                <table>
                                    <tr>
                                    <td>
                                        Payment REF #: ' . $row->bill_ref_code . '<br />
                                        Created: ' . $row->bill_date_added . '<br />
                                        <span class="letter_head">
                                            Status : PAID
                                        </span>
                                    </td>
                                        <td>
                                            ' . $row->user_number . '<br>
                                            ' . $row->user_name . ' <br>
                                            ' . $row->user_email . ' <br>
                                            ' . $row->user_phone . ' 
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="heading">
                            <td class="letter_head">Item</td>
                            <td class="letter_head">Price</td>
                        </tr>
                        <tr class="item">
                            <td>' . $row->diad_ref . '<br>' . $row->diag_title . ' Payment </td>
                            <td>Ksh ' . number_format($row->bill_amount, 2) . '</td>
                        </tr>
                        <tr class="total">
                            <td></td>
                            <td class="letter_head">Total: Ksh ' . number_format($row->bill_amount, 2) . '</td>
                        </tr>
                    </table>
                </div>
            </body>
            <br><br><br><br>
            <div class="list_header letter_head" align="center">
                <p>Scan To Verify</p>
                <img src="' . $qrbase64 . '" width="100px" height="100px">
            </div>
        </div>
    </div>';

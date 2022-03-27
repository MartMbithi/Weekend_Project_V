<?php
/* Register All User Analytics Here based on access levels */
/* Set Sessions And User Access Levels */
$user_id = $_SESSION['user_id'];
$access_level = $_SESSION['user_access_level'];

if ($access_level == 'admin' || $access_level == 'doctor') {
    /* Doctor / Admin Analytics */


    /* 1. Registered Patients */
    $query = "SELECT COUNT(*)  FROM users WHERE user_access_level = 'patient' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($patients);
    $stmt->fetch();
    $stmt->close();


    /* 2. Available Doctors */
    $query = "SELECT COUNT(*)  FROM users WHERE user_access_level = 'doctor' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($doctors);
    $stmt->fetch();
    $stmt->close();


    /* 3. Appointments */
    $query = "SELECT COUNT(*)  FROM appointments  ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($appointments);
    $stmt->fetch();
    $stmt->close();


    /* 4. Revenue - Based On Hospital Billings */
    $query = "SELECT SUM(bill_amount)  FROM bills  ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($bills);
    $stmt->fetch();
    $stmt->close();
} else {
    /* Patients Analytics */

    /* 1. My Appointments */
    $query = "SELECT COUNT(*)  FROM appointments  WHERE app_user_id = '$user_id' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($appointments);
    $stmt->fetch();
    $stmt->close();

    /* 2. Pending Hospital Bill Payment */
    $query = "SELECT SUM(bill_amount)  FROM bills b
    INNER JOIN diagonisis d ON d.diag_id = b.bill_diag_id
    WHERE d.diag_patient_id = '$user_id' AND b.bill_status = 'Pending' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($pending_bills);
    $stmt->fetch();
    $stmt->close();


    /* 3. Overall Expenditure */
    $query = "SELECT SUM(bill_amount)  FROM bills b
    INNER JOIN diagonisis d ON d.diag_id = b.bill_diag_id
    WHERE d.diag_patient_id = '$user_id' AND b.bill_status = 'Paid' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($pending_bills);
    $stmt->fetch();
    $stmt->close();
}

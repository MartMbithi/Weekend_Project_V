<?php
/* Handle Logout Logic Here */
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_access_level']);
unset($_SESSION['user_name']);
unset($_SESSION['payment_module_status']);
session_destroy();
header("Location: login");
exit;

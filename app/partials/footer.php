<?php
$ret = "SELECT * FROM  settings";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($settings = $res->fetch_object()) { ?>
    <div class="footer">
        <div class="copyright">
            <p>Copyright © 2022 - <?php echo date('Y'); ?> <?php echo $settings->sys_name; ?> - <?php echo $settings->sys_tagline; ?></p>
        </div>
    </div>
<?php } ?>
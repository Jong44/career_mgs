<?php
    foreach ($job as $j) :
    $datestring = '%Y-%m-%d';
    $date = mdate($datestring);
    $id_job = $j['id_job'];
    if($j['exp_date'] <= $date){
        $this->db->query("update job set status = 0 where id_job = '$id_job'");
    } 
    endforeach;
    $this->db->query("update notification set status = 1");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets')?>/css/style.css">
    <script src="https://kit.fontawesome.com/860ae798ee.js" crossorigin="anonymous"></script>
    <title>Notification</title>
</head>
<body> 
    <div class="content">
        <?php include 'partials/header.php'?>
        <p class="bold" style="font-size:20px">Recent Notification</p>
        <?php $datestring = '%d %M, %Y ';?>
        <p class="light"><?php echo mdate($datestring); ?></p> 
        <?php foreach ($notif as $n) : ?>
        <div class="rows">
            <div class="icon-notif">
                <i class="fa-solid fa-bell"></i>
            </div>
            <div class="text">
                <div class="text1">
                    <p class="bold"><?= $n['content'] ?></p>
                    <p class="light"><?= $n['name'] ?></p>
                </div>
                <p class="lights"><?= $n['date'] ?></p>
            </div>
        </div>
        <?php endforeach ?>
        <div class="delete">
            <a href="<?= base_url('proses/deleteNotif')?>" class="btn-delete">Delete</a>
        </div>
    </div>
</body>
</html>
<?php
    foreach ($job as $j) :
    $datestring = '%Y-%m-%d';
    $date = mdate($datestring);
    $id_job = $j['id_job'];
    if($j['exp_date'] <= $date){
        $this->db->query("update job set status = 0 where id_job = '$id_job'");
    } 
    endforeach
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets')?>/css/style.css">
    <script src="https://kit.fontawesome.com/860ae798ee.js" crossorigin="anonymous"></script>
    <link rel="icon" href="./assets/img/lg-ico.ico">
    <title>Candidates</title>
</head>
<body>
    <div class="content">
        <?php include 'partials/header.php'?>
        <div class="row">
            <form action="<?= base_url('user/candidates')?>" method="post">
            <div class="search">
                <span><i class="fa-solid fa-search"></i></span>
                <input type="text" placeholder="Search Candidates Name" name="name">
            </div>
            <div class="kategory1">
                <select name="jobs" id="jobs">
                    <option value="">Search Job</option>
                    <?php  foreach ($job as $j) :?>
                    <option value="<?=$j['nama_job']?>"><?=$j['nama_job']?></option>
                    <?php endforeach ?>
               </select>
            </div>
            <div class="kategory2">
                <select name="rate" id="rate">
                    <option value="">Search Rating</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                    <option value="0">0</option>
                </select>
            </div>
            <button type="submit">Filter</button>
            </form>
        </div>
        <div class="rows">
            <?php foreach ($candidates as $c):?>
            <div class="card">
                <img src="<?= base_url('../../mgsweb/assets/img/candidates') ?>/<?=$c['img_profil']?>" alt="<?=$c['full_name']?>">
                <p class="nama"><?=$c['first_name']?> <?=$c['last_name']?></p>
                <p><?=$c['category']?></p>
                <a class="btn-white" href="<?= base_url('user/detail')?>/<?=$c['id_candidates']?>">View Details</a>
            </div>
            <?php endforeach ?>
        </div>
        <p><?php echo $links; ?></p>
    </div>

</body>
</html>
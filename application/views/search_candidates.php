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
                <input type="text" placeholder="Search Candidates Name">
            </div>
            <div class="kategory1">
                <select name="jobs" id="jobs">
                    <option>Search Job</option>
                    <option value="ui/ux">UI/UX Designer</option>
                    <option value="back">Back-End Developers</option>
                    <option value="front">Front-End Developers</option>
                    <option value="devops">DevOps Engineer</option>
                    <option value="qa">Quality Asurance Engineer</option>
               </select>
            </div>
            <div class="kategory2">
                <select name="rate" id="rate">
                    <option class="active">Search Rating</option>
                    <option value="5">5</option>
                    <option value="4-5">4-5</option>
                    <option value="3-4">3-4</option>
                    <option value="3">1-3</option>
                </select>
            </div>
            <button type="submit">Filter</button>
            </form>
        </div>
        <div class="rows">
            <?php foreach ($result as $r):?>
            <div class="card">
                <img src="<?= base_url('assets')?>/img/takina.jpg" alt="<?=$r['first_name']?> <?=$r['last_name']?>">
                <p class="nama"><?=$r['first_name']?> <?=$r['last_name']?></p>
                <p><?=$r['category']?></p>
                <a class="btn-white" href="<?= base_url('user/detail')?>/<?=$r['id_candidates']?>">View Details</a>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</body>
</html>
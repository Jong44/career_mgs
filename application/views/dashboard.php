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
    <script src="https://kit.fontawesome.com/860ae798ee.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?= base_url('assets')?>/img/lg-ico.ico">
    <link rel="stylesheet" href="<?= base_url('assets')?>/css/style.css">
    <title>Dashboard</title>
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
        <div class="row">
        <div class="items">
            <span class="icons"><i class="fa-solid fa-user-group"></i></span>
            <div class="cl">
                <span class="count"><?=$countCandidates?></span>
                <p>Active Member</p>
            </div>
        </div>
        <div class="items">
            <span class="icons1"><i class="fa-solid fa-briefcase"></i></span>
            <div class="cl">
                <span class="count"><?=$countActiveJob?></span>
                <p>Published Job</p>
            </div>
        </div>
        <div class="items">
            <span class="icons1"><i class="fa-solid fa-book-bookmark"></i></span>
            <div class="cl">
                <span class="count"><?=$countDraftJob?></span>
                <p>Expired Jobs</p>
            </div>
        </div>
        <div class="items">
            <span class="icons"><i class="fa-solid fa-users"></i></span>
            <div class="cl">
                <span class="count">348</span>
                <p>Team Members</p>
            </div>
        </div>
        </div>
        <div class="cart">
        <canvas id="myChart"></canvas>  
        </div>
        <h3>Recent Applicatons</h3>
        <div class="row">
            <?php foreach ($recent as $r) :?>
            <div class="card">
                <img src="<?= base_url('../../mgsweb/assets/img/candidates') ?>/<?=$r['img_profil']?>" alt="<?=$r['full_name']?>">
                <p class="nama"><?=$r['first_name']?> <?=$r['last_name']?></p>
                <p><?=$r['category']?></p>
                <a class="btn-white" href="<?=base_url('user/detail')?>/<?=$r['id_candidates']?>">View Details</a>
            </div>
            <?php endforeach ?>
        </div>
        <h3>Recent Jobs</h3>
        <div class="recent-jobs">
            <div class="row">
                <h4>Job Title</h4>
                <h5>Applicatons</h5>
                <h5>Status</>
                <h6>Deadline</h6>
                <h6 class="act">Actions</h6>
            </div>
            <?php foreach ($recentJobs as $r) :?>
            <div class="card-jobs">
                <p><?= $r['nama_job']  ?></p>
                <div class="profil">
                    <div class="circle" style="background-color: red;">
                        <img src="<?= base_url('assets')?>/img/user.png" alt="user">
                    </div>
                    <div class="circle" style="background-color: green;">
                        <img src="<?= base_url('assets')?>/img/user.png" alt="user">
                    </div>
                    <div class="circle" style="background-color: blue;">
                        <img src="<?= base_url('assets')?>/img/user.png" alt="user">
                    </div>
                    <div class="circle" style="background-color: yellow;">
                        <img src="<?= base_url('assets')?>/img/user.png" alt="user">
                    </div>
                    <div class="circle" style="background-color: orange;">
                        10+
                    </div>
                </div>
                <div class="status">
                    <?php 
                        $datestring = '%Y-%m-%d';
                        $date = mdate($datestring);
                        if($r['status'] == 1){
                            ?><span class="status"><?php echo 'Ongoing'?></span><?php
                        } 
                        else{
                            ?><span class="ending"><?php echo 'Expired'?></span><?php
                        }
                    ?>
                </div>
                <div class="deadline">
                    <span><?= $r['exp_date']?></span>
                    <span>
                        <?php 
                        if($r['exp_date'] >= $date){
                            $d = $r['exp_date'];
                            $a = $r['post_date'];
                            $days = (strtotime($d) - strtotime($date)) / (24*60*60);
                            echo floor($days);
                            $duration = (strtotime($d) - strtotime($a)) / (24*60*60);
                            $day1 = floor($days); 
                            $day2 = floor($duration);
                            $currentTime = $day2 - $day1;
                        } else {
                            echo '0';
                        }
                        ?>
                        days left
                    </span>
                </div>
                <div class="indicator">
                    <div class="progress" id="progress-<?= $r['id_job']?>">
                    </div>
                </div>
                <div class="actions">
                    <a href="<?= base_url('user/applied')?>/<?= $r['id_job']?>"><span class="hijau"><i class="fa-solid fa-eye"></i></span></a>
                    <a href="<?= base_url('user/editJob')?>/<?= $r['id_job']?>"><span class="ungu"><i class="fa-solid fa-clipboard-list"></i></span></a>
                    <a href="#"><span class="biru"><i class="fa-solid fa-share-nodes"></i></span></a>
                </div>
            </div>
                <script>
                    
                    const indicators<?= $r['id_job']?> = document.querySelectorAll('#progress-<?= $r['id_job']?>');
                    const currentTime<?= $r['id_job']?> = <?= $currentTime ?>;
                    const duration<?= $r['id_job']?> = <?= $day2 ?>;
                    let progress<?= $r['id_job']?> = (currentTime<?= $r['id_job']?> / duration<?= $r['id_job']?>) * 100;

                    indicators<?= $r['id_job']?>.forEach ( indicators<?= $r['id_job']?> =>{
                    indicators<?= $r['id_job']?>.style.width = progress<?= $r['id_job']?> + '%';
                    })
                    
                </script>
            <?php endforeach ?>
        </div>
        <br><br><br><br>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            <?php foreach ($chart as $y): ?>
                '<?= $y['year_apply'] ?>',
                <?php endforeach ?>
        ],
        datasets: [{
            label: 'Jumlah Pendaftar',
            backgroundColor: '#ADD8E6',
            borderColor: 'rgb(75, 192, 192)',
            data: [
                <?php foreach ($chart as $y):?>
            '<?= $y['candidates'] ?>',
            <?php endforeach ?>
                
            ]
            }]
        },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
    });
 
  </script>

</body>

</html>
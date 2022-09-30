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
    <title>Jobs</title>
</head>
<body>
    <div class="content">
    <div class="alert" id="alerts">
    </div>
        <?php include 'partials/header.php'?>
        <div class="row">
            <form action="<?= base_url('user/jobs')?>" method="post" >
            <div class="kategory1">
                <select name="jobs" id="jobs">
                    <option value="">Search Job</option>
                    <?php  foreach ($jobs as $j) :?>
                    <option value="<?=$j['nama_job']?>"><?=$j['nama_job']?></option>
                    <?php endforeach ?>
               </select>
            </div>
            <div class="kategory2">
                <select name="urutan" id="urutan">
                    <option value="">Urutkan</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <div class="kategory3">
                <select name="expired" id="expired">
                    <option value="">Search By Expired</option>
                    <option value="1">Ongoing</option>
                    <option value="0">Expired</option>
                </select>
            </div>
            <button type="submit">Filter</button>
            <a class="btn-white" href="<?= base_url('user/form_job')?>">Create Job</a>
            </form>
        </div>
        <div class="list-jobs">
            <div class="rows">
            <?php foreach ($job as $j): ?>
                <div class="content-alert" id="alert">
                    <div class="head">
                        <p>
                            <i class="fa-solid fa-triangle-exclamation"></i>
                             Perhatian!
                        </p>
                        <span class="close"><i class="fa-solid fa-xmark" id="close"></i></span>
                    </div>
                    <div class="body">
                        <p>Apakah Anda Yakin Ingin Menghapus?</p>
                        <p>Semua data yang terkandung akan hilang</p>
                    </div>
                    <div class="footer">
                        <button class="alert-white">Cancel</button>
                        <a href="<?= base_url('proses/deleteJobs')?>/<?=$j['id_job']?>" class="alert-red">Hapus</a>
                    </div>
                </div>
                <div class="published-jobs">
                    <div class="head">
                        <div class="title">
                            <img src="<?= base_url('assets')?>/img/ui.png" alt="">
                            <div class="p">
                                <p>We're Hiring </p>
                                <p class="p-lg"><?=$j['nama_job']?></p>
                            </div>
                            
                            <?php
                            
                            if($j['status'] == 1){
                                ?><div class="status">
                                <p><?php echo 'Ongoing'?></p>
                            </div>
                            <?php
                            }
                            else {
                            ?><div class="end">
                                <p><?php echo 'Expired'?></p>
                            </div><?php
                            }
                            ?>

                        </div>
                        <div class="menu">
                            <div class="pipeline">
                                <span class="icon"><i class="fa-solid fa-add"></i></span>
                                <p>Pipeline</p>
                            </div>
                            <a href="<?=base_url('user/applied')?>/<?=$j['id_job']?>">
                                <div class="candidates">
                                    <span class="icon1"><i class="fa-solid fa-user-group"></i></span>
                                    <p>Candidates</p>
                                </div>
                            </a>
                            <a href="<?=base_url('user/editJob')?>/<?=$j['id_job']?>">
                            <div class="edit">
                                <span class="icon2"><i class="fa-solid fa-pen"></i></span>
                                <p>Edit</p>
                            </div>
                            </a>
                        <span id="btnDelete" class="icon" style="font-size:15px;" ><i class="fa-solid fa-trash"></i></>
                        </div>
                    </div>
                    <div class="body">
                        <div class="frame1">
                            <p class="p-lg"><?=$j['nama_job']?></p>
                            <p><?=$j['category']?></p>
                            <span class="apply">Post Date: <?=$j['post_date']?></span>
                            <span class="apply">Exp Date: <?=$j['exp_date']?></span>
                        </div>
                        <div class="frame2">
                            <span class="apply"><?=$j['jmlh_apply']?> Applied</span>
                            <div class="profils">
                                <div class="circle" style="background-color: red;">
                                    <img src="<?= base_url('assets')?>/img/user.png" alt="user">
                                </div>
                                <div class="circle" style="background-color: green;">
                                    <img src="<?= base_url('assets')?>/img/user.png" alt="user">
                                </div>
                                <div class="circle" style="background-color: orange;">
                                    10+
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>    
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <script>

        const btnDelete = document.querySelectorAll('#btnDelete');
        let alert = document.querySelector('#alert');
        let alerts = document.querySelector('#alerts');
        let close = document.querySelector('#close');
        let cancel = document.querySelector('.alert-white');
        let content = document.querySelector('.content');

        btnDelete.forEach( btnDelete => {
            btnDelete.addEventListener('click', (e)=>{
                alert.style.display = "block";
                alerts.style.display = "block";
            })
 
        })

        close.addEventListener("click", function(){
            alert.style.display = "none";
            alerts.style.display = "none";
        });

        cancel.addEventListener("click", function(){
            alert.style.display = "none";
            alerts.style.display = "none";
        });
    </script>
</body>
</html>
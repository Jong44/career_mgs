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
    <title>Detail | <?=$candidates['first_name']?> <?=$candidates['last_name']?></title>
</head>
<body>
    <div class="content">
        <?php include 'partials/header.php'?>
        <div class="rows">
            <div class="col11">
                <div class="card-candidates">
                    <div class="profile">
                        <img src="<?= base_url('../../mgsweb/assets/img/candidates') ?>/<?=$candidates['img_profil']?>" alt="<?=$candidates['full_name']?>">
                    </div>
                    <p><?=$candidates['full_name']?></p>
                    <p class="category"><?=$candidates['category']?></p>
                    <a class="btn" href="#">
                        <span>Application</span>
                        <span><i class="fa-solid fa-caret-down"></i></span>
                    </a>
                </div>
                <div class="card-candidates1">
                    <div class="body">
                        <div class="icon">
                            <i class="fa-solid fa-user-tag"></i>
                        </div>
                        <div class="isi">
                            <p class="label">First Name</p>
                            <p><?=$candidates['first_name']?></p>
                        </div>
                    </div>
                    <div class="body">
                        <div class="icon">
                            <i class="fa-solid fa-user-tag"></i>
                        </div>
                        <div class="isi">
                            <p class="label">Last Name</p>
                            <p><?=$candidates['last_name']?></p>
                        </div>
                    </div>
                    <div class="body">
                        <div class="icon">
                            <i class="fa-solid fa-inbox"></i>
                        </div>
                        <div class="isi">
                            <p class="label">Email Addrees</p>
                            <p><?=$candidates['email']?></p>
                        </div>
                    </div>
                    <div class="body">
                        <div class="icon">
                            <i class="fa-solid fa-square-phone-flip"></i>
                        </div>
                        <div class="isi">
                            <p class="label">Phone Number</p>
                            <p><?=$candidates['no_hp']?></p>
                        </div>
                    </div>
                    <div class="body">
                        <div class="icon">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div class="isi">
                            <p class="label">Date Of Application</p>
                            <p><?=$candidates['date_apply']?></p>
                        </div>
                    </div>
                    <div class="body">
                        <div class="icon">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="isi">
                            <p class="label">Rate</p>
                            <p></p>
                        </div>
                    </div>
                    <div class="body">
                        <div class="icon">
                            <i class="fa-solid fa-share-nodes"></i>
                        </div>
                        <div class="isi">
                            <p class="label">Sosial</p>
                            <div class="sosial">
                                <a href="<?= $candidates['fb']?>"><span><i class="fa-brands fa-facebook-f"></i></span></a>
                                <a href="<?= $candidates['linked'] ?>"><span><i class="fa-brands fa-linkedin-in"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col22">
                <div class="menu">
                    <div class="tabs">
                        <input type="radio" name="tabs" id="tabs1"  checked="checked">
                        <label for="tabs1"><span><i class="fa-solid fa-graduation-cap"></i></span> <span>Application</span></label>
                        <div class="tab">
                            <div class="experience">
                            <p class="bold" style="color:black;">Experience</p>
                            <?php foreach ($employe as $e): 
                                    if ($e != null){ 
                                    $start= strtotime($e['start']);
                                    $end= strtotime($e['end']);
                                    $dateStart = date('M d, Y', $start);
                                    $dateEnd = date('M d, Y', $end);
                                    $total = number_format(($end - $start) / (12*30*24*60*60),1) ;
                                
                                    ?>
                                <div class="rows">
                                    <p>Total Year Experience: </p>
                                    <p class="biru">(<?= $total ?> Years)</p>
                                </div>
                                    <div class="card-experience">
                                        <div class="dot">
                                            <i class="fa-solid fa-circle"></i>
                                        </div>
                                        <div class="exp">
                                            <div class="rows">
                                                <p><?= $e['department']?></p>
                                                <p>(<?= $dateStart?> - <?= $dateEnd?>)</p>
                                            </div>
                                            <p><?= $e['deisgnation']?></p>
                                    </div>     
                                    </div>
                                    <?php
                                        }
                                    
                                    ?>
                                <?php endforeach ?>
                            </div>
                            <div class="education">
                                <p class="bold">Education Qualification</p>
                                <?php foreach ($edu as $e): 
                                    
                                    if ($e != null){ ?>
                                        <div class="card-education">
                                        <div class="dot">
                                            <i class="fa-solid fa-circle"></i>
                                        </div>
                                        <div class="edc">
                                            <p class="bold"><p><?= $e['exam']?></p></p>
                                            <p><p><?= $e['level']?></p></p>
                                            <div class="rows">
                                                <p class="biru"><?= $e['institute_name']?></p>
                                                <p>(<?= $e['year']?>)</p> 
                                            </div>
    
                                        </div>
                                    </div>
                                    <?php
                                    }
                                
                                    ?>
                                <?php endforeach ?>
                            </div>
                        </div>

                        <input type="radio" name="tabs" id="tabs2" >
                        <label for="tabs2"><span><i class="fa-solid fa-id-badge"></i></span> <span>Resume</span></label>
                        <div class="tab">
                            <iframe src="http://localhost/mgsweb/assets/img/candidates/<?=$candidates['resume']?>" frameborder="0"></iframe>
                        </div>

                        <input type="radio" name="tabs" id="tabs3">
                        <label for="tabs3"><span><i class="fa-solid fa-file-pen"></i></span> <span>Evaluation</span></label>
                        <div class="tab">
                            <div class="evaluation">
                                <div class="rows">
                                    <a class="btn" href="">Attachment Name</a>
                                    <a class="btn-white" href="">Browse</a>
                                </div>
                                <form action="">
                                    <div class="card-attachment">
                                        <textarea name="attachment" id="" cols="30" rows="10" placeholder="Add Comment"></textarea>
                                    </div>
                                </form>
                                <div class="rows">
                                    <a class="btn" href="">Attachment Name</a>
                                    <a class="btn-white" href="">Browse</a>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col33">
                <div class="salary">
                    <p class="bold">Salary</p>
                    <div class="card-salary">
                        <div class="dot">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <div class="current">
                            <p  class="bold">Current Salary</p>
                            <p><?=$candidates['current_salary']?></p>
                        </div>
                    </div>
                    <div class="card-salary">
                        <div class="dot">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <div class="current">
                            <p  class="bold">Expect Salary</p>
                            <p>Rp <?=$candidates['expected_salary']?></p>
                        </div>
                    </div>
                </div>
                <div class="notes">
                    <p class="bold">Notes</p>
                    <p class="light">Only team members can see notes.</p>
                    <form action="<?= base_url('proses/insertNotes') ?>" method="post">
                        <input type="hidden" value="<?=$candidates['id_candidates']?>" name="id_candidates">
                        <div class="card-notes">
                            <textarea name="notes" id="note" cols="30" rows="10" placeholder="Add a note here"><?=$candidates['notes']?></textarea>
                        </div>
                        <div class="rows">
                            <button type="submit" class="btn">Submit</button>
                            <button type="reset" class="btn-white">Cancel</button>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
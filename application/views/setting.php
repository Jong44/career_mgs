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
    <title>Setting</title>
</head>
<body>
    <div class="content">
        <?php include 'partials/header.php'?>
        <form action="<?= base_url('user/update')?>" method="post" enctype="multipart/form-data" class="setting">
            <div class="setting">
                <input type="hidden" name="id_user" value="<?=$user['id_user']?>">
                <div class="rows">
                    <div class="input">
                        <p>Username</p>
                        <input type="text" value="<?=$user['username']?>" name="username">
                    </div>
                    <div class="input">
                        <p for="">Email</p>
                        <input type="text" value="<?=$user['email']?>" name="email">
                    </div>
                </div>
                <div class="rows">
                    <div class="input">
                        <p for="">Mobile number</p>
                        <input type="phone" id="" value="<?=$user['no_hp']?>"  name="no_hp">
                    </div>
                    <div class="input">
                        <p for="">Industry</p>
                        <input type="text" value="<?=$user['industry']?>"  name="industry">
                    </div>
                </div>
                <div class="rows">
                    <div class="input">
                        <p for="">Country</p>
                        <input type="text" value="<?=$user['country']?>"  name="country">
                    </div>
                    <div class="input">
                        <p for="">State</p>
                        <input type="text" value="<?=$user['state']?>"  name="state">
                    </div>
                </div>
                <div class="rows">
                    <div class="input1">
                        <p for="">City</p>
                        <input type="text" value="<?=$user['city']?>"  name="city">
                    </div>
                    <div class="input1" style="margin-right:10px">
                        <p for="">Postal Code</p>
                        <input type="number" value="<?=$user['postal_code']?>"  name="postal_code">
                    </div>
                    <div class="input">
                        <p for="">Time Zone</p>
                        <input type="text" value="<?=$user['time_zone']?>"  name="time_zone">
                    </div>
                </div>
                <div class="rows">
                    <div class="input">
                        <p for="">Language</p>
                        <input type="text" value="<?=$user['language']?>"  name="language">
                    </div>
                    <div class="input">
                        <p for="">Website URL</p>
                        <input type="text" value="<?=$user['web_url']?>"  name="web_url">
                    </div>
                </div>
                <input type="file" name="filefoto">
            </div>
            <button class="btn-setting" type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
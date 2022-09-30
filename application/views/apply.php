

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/860ae798ee.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?= base_url('assets/img/lg-ico.ico')?>">
    <link rel="stylesheet" href="<?= base_url('assets')?>/css/style.css">
    <title>Applied</title>
</head>
<body>
    <div class="content">
        <?php include 'partials/header.php'?>
        <p class="bold-lg"><?php if ($applied != null){
                echo $applied['category'];
            }
            else {
                echo $job['nama_job'];
            }
            ?></p>
        <?php $datestring = '%d %M, %Y ';?>
        <p class="light"><?php echo mdate($datestring); ?></p> 
        <div class="rows">
            <div class="cols1">
                <div class="filter">
                    <p class="bold-lg">Filter</p>
                </div>
                <div class="card-filter">
                    <form action="">
                        <label class="container">All
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        </label>
                        <label class="container">New
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        </label>
                        <label class="container">Rated
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        </label>
                        <label class="container">No Rated
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        </label>
                        <button type="submit">Filter</button>
                    </form>
                </div>
            </div>
            <div class="cols2">
            <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">Name</div>
                        <div class="col col-2">Date</div>
                        <div class="col col-3">Status</div>
                        <div class="col col-4">Rating</div>
                    </li>
                    <?php foreach ($apply as $a):?>
                        
                    <li class="table-row">
                        <div class="col col-1">
                            <div class="rows">
                                <img src="<?= base_url('../../mgsweb/assets/img/candidates') ?>/<?= $a['img_profil'] ?>" alt="<?= $a['full_name'] ?>">
                                <p><?= $a['last_name']?></p>
                            </div>
                        </div>
                        <div class="col col-2"><p><?= $a['date_apply']?></p></div>
                        <div class="col col-3" data-label="Amount">
                            <div class="shape">
                                <p><?php
                                if ($a['status'] == 1) {
                                    echo 'Applied';
                                }
                                else {
                                    echo 'Reject';
                                }
                                ?>
                               </p>
                            </div>
                        </div>
                        <div class="col col-4" data-label="Payment Status">

                        </div>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
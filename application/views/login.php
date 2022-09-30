<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="./assets/img/lg-ico.ico">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>
    <div class="konten">
        <div class="bg">
            <div class="kiri">
                <img src="assets/img/bg-kiri.png" alt="">
            </div>
            <div class="kanan">
                <img src="assets/img/bg-kanan.png" alt="">
            </div>
        </div>
        <div class="text">
            <div class="up">
                <p>We are</p>
            </div>
            <div class="mgs">
                <p>MGS Career</p>
            </div>
            <p>Welcome back, Please login to your account.</p>
        </div>
        <div class="form">
            <form action="<?= site_url('Welcome/proses_auth')?>" method="post">
                <div class="mb-3">
                    <label for="inputemail" class="form-label">Your Email</label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Email Address">
                </div>
                <div class="mb-3">
                    <label for="inputpassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="inputpassword" placeholder="Password">
                </div>
                <div class="mb-2 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <button type="button" class="btn btn-outline-primary">Sign up</button>
            </form>
            <br>
            <?php
                      if($this->session->flashdata('pesan') <> ''){
                  ?>
                    <div class="alert alert-dismissible alert-danger">
                      <?php echo $this->session->flashdata('pesan');?>
                    </div>
                  <?php
                  }
                  ?>
        </div>
    </div>
</body>
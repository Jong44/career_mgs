<head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
    
    <div class="sidebar">
    <span id="minimize"><i class="fa-solid fa-bars"></i></span>
    <span id="maximize"><i class="fa-solid fa-bars"></i></span>   
        <div class="profile">               
            <img src="<?= base_url('assets/img/profile')?>/<?php echo $this->session->userdata('img_profile');?>" alt="<?php echo $this->session->userdata('img_pofile');?>">
                <p class="nama"><?php echo $this->session->userdata('username');?></p>
                <p class="class"><?php echo $this->session->userdata('industry');?></p>
            </div>
           <div class="menu-sidebar">
           <ul>
                <li class="active">
                    <a href="<?= base_url('user')?> " id="menu">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('user/jobs')?>">
                        <span class="icon"><i class="fa-solid fa-briefcase"></i></span>
                        <span class="item">Jobs</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('user/candidates')?>" id="menu">
                        <span class="icon"><i class="fa-solid fa-user-group"></i></span>
                        <span class="item">Candidates</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('user/setting')?>/<?php echo $this->session->userdata('id_user');?>" id="menu">
                        <span class="icon"><i class="fa-sharp fa-solid fa-gear"></i></span>
                        <span class="item">Setting</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('welcome/log_out')?>" id="menu">
                        <span class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                        <span class="item">Log Out</span>
                    </a>
                </li>
            </ul>
           </div>
        </div>
    </div>
    <script>
        $(".wrapper .sidebar ul li a").click(function(){
            $(".wrapper .sidebar ul").find(".active").removeClass("active");
            $(this).parent().addClass("active");
        })
        let minimize = document.querySelector('#minimize');
        let maximize = document.querySelector('#maximize');
        let sidebar = document.querySelector('.sidebar')
        let menu = document.querySelector('.profile')
        let menus = document.querySelector('.menu-sidebar');
        minimize.addEventListener("click", function(){
            let contens = document.querySelector('.content');
            sidebar.style.width = "50px";
            sidebar.style.padding = "20px 15px";
            contens.style.left = "7%";
            menu.style.display = "none";
            menus.style.display = "none";
            minimize.style.display = "none";
            maximize.style.display = "block";
        });

        maximize.addEventListener("click", function(){
            let contens = document.querySelector('.content');
            sidebar.style.width = "350px";
            sidebar.style.padding = "30px";
            menu.style.display = "block";
            menus.style.display = "block";
            minimize.style.display = "block";
            maximize.style.display = "none";
            contens.style.left = "27%";
        });
    </script>

</body>
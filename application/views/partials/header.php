
        <div class="row">
            <div class="col1">
                <a class="btn btn-primary" href="http://localhost/mgsweb/user" role="button">View Company Page</a>
            </div>
            <div class="col2">
                <a href="<?= base_url('user/notif')?>">
                <div class="count">
                    <?php 
                    if ( $countNotifications != 0 ){
                        ?><span><?= $countNotifications ?></span><?php
                    }
                    ?>
                    <i class="fa-solid fa-bell"></i>
                </div>
                </a>
                <span><i class="fa-solid fa-user"></i></span>
                <span class="nama"><?php echo $this->session->userdata('username');?></span>
            </div>
        </div>
        

<div class="section">
    <div class="clearfix">
        <i class="status fa fa-check-circle-o pull-left"> </i><span class="pull-left">Congratulation! You have successfully installed <?php echo $project_name?></span>  
    </div>

    <div class="note">
        Don't forget to delete your installation directory!
    </div>
    
    <a class="text-success" href="<?php echo $dashboard_url; ?>">
        <div class="text-center">
            <div class="login-icon"><i class="fa fa-desktop"></i></div>
            <div>Go to HOME PAGE - <?php echo $dashboard_url; ?> </div>
        </div>
    </a>
    <hr>
    <a class="go-to-login-page" href="<?php echo $dashboard_url; ?>/admin">
        <div class="text-center">
            <div  class="login-icon"><i class="fa fa-users"></i></div>
            <h4>Go to ADMIN PAGE - <?php echo $dashboard_url; ?>/admin </h4>
        </div>
    </a>
</div>
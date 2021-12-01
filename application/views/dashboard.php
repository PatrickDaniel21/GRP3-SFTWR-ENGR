Welcome to Dashboard

<?php 
if($this->session->userdata('UserLoginSession')){
    // TRANSFER THE DATA IN UserLoginSession TO $udata
    $udata = $this->session->userdata('UserLoginSession');

    // PRINT WELCOME WITH USER username
    echo 'Welcome'.' '.$udata['username'];
}
else {
    redirect(base_url('welcome/login'));
}
?>

<!-- LOGOUT OPTION -->
 <a href="<?=base_url('welcome/logout')?>">Logout</a>
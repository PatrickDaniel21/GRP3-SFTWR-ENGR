<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Clikit | Organization</title>

    <style type="text/css">
    *{
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        box-sizing: border-box;
    }
    body{
        background-image: url( <?= base_url() ?>assets/img/bg10.jpg );
        	background-repeat: no-repeat;
			background-size: cover;
    }
    .background{
        position: absolute;
        height: 100%;
        width: 100%;
    }
    ion-icon{
        font-size: 1.5rem;
        margin-right: 8px;
    }
    nav{
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #1E0E0E;
        padding: 13px 7%;
        position: sticky;
        top: 0;
        z-index: 100;
        margin-bottom: 10px;
    }
    .nav-left p{
        width: 160px;
        margin-right: 45px;
        color: #efefef;
        font-size: 20px;
    }
    .nav-left, .nav-right{
        display: flex;
        align-items: center;
    }
    .nav-user-icon img{
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
    }
    .nav-user-icon{
        margin-left: 30px;
    }
    .search-box{
        background: #efefef;
        width: 200px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        padding: 0 15px;
        margin-bottom: 10px;
        height: 30px;
    }
    .search-box p{
        width: 18px;
        color: #626262;
    }
    .search-box input{
        font-size: small;
        width: 100%;
        background: transparent;
        padding: 10px;
        outline: none;
        border: 0;
    }
    .container{
        display: flex;
        justify-content: space-between;
        padding-top: 15px;
    }
    .left-sidebar{
        flex-basis: 25%;
        position: sticky;
        top: 70px;
        align-self: flex-start;
        color: #800;
        padding-right: 15px;
    }
    .right-sidebar{
        flex-basis: 25%;
        position: sticky;
        top: 70px;
        align-self: flex-start;
        background-image: url( <?= base_url() ?>assets/img/bg1.jpg );
        padding: 20px;
        border-radius: 4px;
        color: #2C1515;
        letter-spacing: 0.5px;
        margin-left:10px;
        margin-top: 8px;
    }
    .main-content{
        flex-basis: 47%;
    }
    .imp-links a{
        text-decoration: none;
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        color: #efefef;
        width: fit-content;
    }
    .imp-links a img, .imp-linkss a img{
        width: 25px;
        height: 25px;
        margin-right: 15px;
        border-radius: 50%;
    }
    .imp-links{
        border-bottom: 1px solid #ccc;
    }

    .imp-linkss a{
        text-decoration: none;
        display: flex;
        align-items: center;
        color: #efefef;
        width: fit-content;
    }

    .imp-linkss{
        background:#905152;
        width: 80%;
        padding: 10px;
        border-radius: 10px;
    }
    .imp-linkss:hover{
        background:#683032;
        width: 80%;
        border-radius: 10px;
    }
    
    .sidebar-title{
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }
    .right-sidebar h4{
        color: #59292B;
        letter-spacing: 1px;
        font-weight: 600;
        font-size: 16px;
    }

    .right-sidebar h3{
        color: #3B1C1C;
        font-weight: 600;
    }
    .sidebar-title a{
        color: #3B1C1C;
        font-weight: 600;
    }
    .event{
        display: flex;
        font-size: 14px;
        margin-bottom: 20px;
    }
    .left-event{
        background: white;
        border-radius: 10px;
        height: 65px;
        width: 65px;
        margin-right: 15px;
        padding-top: 10px;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 0 10px rgb(0, 0, 0, 0.1);
    }
    .event p{
        font-size: 12px;
    }
    .event a{
        font-size: 12px;
        text-decoration: none;
        color: #1876f2;
    }
    .left-event span{
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #3B1C1C;
        color: #F5F5F5;
        font-size: 10px;
        padding: 4px 0;
    }
    .sidebar-ads{
        width: 100%;
        margin-bottom: 20px;
        border-radius: 4px;
    }
    .write-post-container{
        width: 100%;
        background: #F5F5F5;
        border-radius: 6px;
        padding: 20px;
        color: #626262;
    }
    .user-profile{
        display: flex;
        align-items: center;
    }
    .user-profile img{
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 15px;
    }
    .user-profile p{
        margin-bottom: -5px;
        font-weight: 500;
        color: #626262;
    }
    .user-profile small{
        font-size: 12px;
    }
    .user-profile label{
        padding-right:5px;
        padding-bottom:2px;
        font-size:13px;
    }
    .user-profile .status{
        color: #626262;
        font-size:13px;
        border-radius: 5px;
        cursor: pointer;
    }
    .user-profile .status:hover{
        background-color:#905152;
    }
    .user-profile span{
        font-size: 13px;
        color: #626262;
    }
    .post-input-container{
        padding-left: 55px;
        padding-top: 20px;
    }
    .post-input-container textarea{
        width: 95%;
        border: 0;
        outline: 0;
        border-bottom: 1px solid #ccc;
        background: transparent;
        resize: none;
    }
    .add-post-links{
        display: flex;
        margin-top: 10px;
    }
    .add-post-links ion-icon{
        text-decoration: none;
        display: flex;
        align-items: center;
        color: #626262;
        margin-right: 4px;
        font-size: 18px;
    }
    .add-post-links p{
        text-decoration: none;
        display: flex;
        align-items: center;
        color: #626262;
        margin-right: 30px;
        font-size: 13px;
    }
    .add-post-links img{
        width: 20px;
        margin-right: 10px;
    }
    .post-container{
        position: relative;
        width: 100%;
        background: #F5F5F5;
        border-radius: 6px;
        padding: 20px;
        color: #626262;
        margin: 20px 0;
    }
    .post-text{
        color: #606162;
        margin: 15px 0;
        font-size: 15px;
    }
    .post-text span{
        color: #626262;
        font-weight: 500;
    }
    .post-text a{
        color: #1876f2;
        text-decoration: none;
    }
    .post-img{
        width: 100%;
        border-radius: 4px;
        margin-bottom: 5px;
    }
    .post-row{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .activity-icons div img{
        width: 18px;
        margin-right: 10px;
    }
    .activity-icons div{
        display: inline;
        align-items: center;
        margin-right: 30px;
    }
    .post-profile-icon{
        display: flex;
        align-items: center;
    }
    .post-profile-icon img{
        width: 20px;
        border-radius: 50%;
        margin-right: 5px;
    }
    .post-row a{
        color: #9a9a9a;
    }
    .profile{
        transform: translateX(-8px);
    }
    .btn1{
        color: white;
        background:none;
        border-radius:5px 0px 0px 5px;
        width: auto;
        padding: 3px 10px 3px 10px;
        border: none;
    }
    .btn1:hover{
        color: white;
    }
    .btn2{
        color: white;
        background:none;
        border-radius:0px 5px 5px 0px;
        width: auto;
        padding: 3px 8px 3px 8px;
        border: none;
    }
    .btn1:hover{
        color: white;
    }
    .dropdown-item:hover{
        color:white;
        background:#905152;
        opacity: 1px;
    }
    .logo{
        text-decoration: none;
    }
    .logo img{
        width: 20%;
    }
    .btn{
		color: #fff;
		text-align: center;
		background:  #800000;
		width: 450px;
		height: 35px;
		transform: translateX(-5.5%);
	}

	.btn:hover{
        color: #fff;
		background-color: #522020;
	}
    .btn-group ion-icon{
        color: #55504E;
        font-size: 20px;
        position: absolute;
        right: -180px;
        top: -30px; 
    }
    .btn-group1{
        position: relative;
        transform: translateX(900%);
    }
    .dropdown-menu1{
        background-color: rgba(0,0,0,.7);
    }
    textarea{
        font-size: 15px;
        background-color: #905152;
        border: none;
        color: white;
        padding: 4px;
    }
    textarea::placeholder{
        color: white;
    }
    .posting::placeholder{
        color: #9a9a9a;
    }
    .dropdown-menu1 .dropdown-item{
        color:white;
    }
    .btnf{
		color: #fff;
		text-align: center;
        text-decoration: none;
        border: none;
		background:  transparent;
        padding: 3px 10px;
	}

	.btnf:hover{
        color:white;
        background:#905152;
        opacity: 1px;
	}
    .book{
        color:#ff9e14;
        position: absolute;
        transform: translateX(1270%);
    }
    .book ion-icon{
        color:#ff9e14;
    }
    .orgpic{
        position: relative;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-right: 15px;
        margin-bottom: 13px;
    }
    .orgname{
        position: relative;
        color: white;
        font-size: 35px;
    }
    .join{
        text-decoration: none;
        color: white;
        float: right;
        margin: 20px 10px;
    }
    .join:hover{
        color: white;
    }
    .join1{
        background-color: #52D452;
        color: white;
        border-radius: 5px;
        border: none;
        padding: 7px;
        float: right;
        margin: 20px 10px;
        
    }
   
    
    </style>
</head>
<body>
    
    <!-- <?php 
    // if($this->session->userdata('UserLoginSession')){
    //     // TRANSFER THE DATA IN UserLoginSession TO $udata
    //     $udata = $this->session->userdata('UserLoginSession');
    // ?>
        // PRINT WELCOME WITH USER username
        echo 'Welcome'.' '.$udata['username']; -->

        <nav>
        <div class="nav-left">
            <a class="logo" href="<?=base_url('index.php/user')?>">
                <img src=<?= base_url('assets/img/DEN-LOGO.png')?>> 
            </a>
        </div>
        <div class="nav-right">

            <div id="bs-example-navbar-collapse-2">
                <div class="btn-group" style="float:right;">

                    <div class="profile">
                        <a href=<?php echo base_url('/user');?>>
                            <?php if($this->session->userdata('image') == ""){
                            ?>
                                <img src=<?= base_url('assets/img/default_dp.png')?>          
                                    style="height: 35px;
                                    width: 35px;
                                    border-radius: 50%; I
                                    display: table-cell;margin: e auto;" alt="Profile image">
                            <?php
                            }else{
                            ?>
                                <img src=<?= base_url('upload/'.($this->session->userdata('image')))?>          
                                    style="height: 35px;
                                    width: 35px;
                                    border-radius: 50%; I
                                    display: table-cell;margin: e auto;" alt="Profile image">
                            <?php
                            }
                            ?>
                            
                        </a>
                    </div>
                    
                    <div class="btn-group">
                    <button type="button" class="btn1"><?php echo $this->session->userdata('username');?></button>
                    <button type="button" class="btn2  dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?=base_url('index.php/user')?>">Go to Freedom Wall</a></li>
                        <li><a class="dropdown-item" href="<?=base_url('orgs')?>">Go to Organization</a></li>
                        <li><a class="dropdown-item" href="<?=base_url('orgs/createorg')?>">Create Organization</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?=base_url('user/editprofile')?>">View Profile</a></li>
                        <li><a class="dropdown-item" href="<?=base_url('user/editprofile#changepass')?>">Change Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?=base_url('welcome/logout')?>">Logout</a></li>
                    </ul>
                    </div>

                </div>
            </div>
        </div>
    </nav>

    <div class="container">
    
        <div class="left-sidebar">
            <div class="imp-links mt-3">
                <a href="<?=base_url('index.php/user')?>"><ion-icon name="people-circle"></ion-icon>Freedom Wall</a>
                <a href="<?=base_url('orgs')?>"><ion-icon name="library"></ion-icon>Organizations</a>
            </div>   

            <div class="imp-linkss mt-5">
                <a href="<?=base_url('orgs/contact/'.$this->uri->segment(3))?>"><ion-icon name="call"></ion-icon>Contact Us</a>
            </div> 
            <div class="imp-linkss mt-3">
                <a href="<?=base_url('orgs/aboutus')?>"><ion-icon name="call"></ion-icon>About</a>
            </div>   
        </div>
        
        <div class="main-content">
            <div class="mt-2 mb-2">
        
            </div>

            <?php
                foreach($data->result() as $row)
                {
                    if($this->uri->segment(3) == $row->org_id){
            ?>

                <?php if($row->org_image == ""){
                ?>
                    <img class="orgpic" src=<?= base_url('assets/img/orgs_logo.png')?>>
                <?php
                    }else{
                 ?>
                    <img class="orgpic" src=<?= base_url('upload/'.$row->org_image)?>>
                <?php
                    }
                ?>
                
                <span class="orgname"><?php echo $row->org_name?></span>

                

                <?php if(($row->orgadmin_id == $this->session->userdata('id')) || 
                         ($row->orgmember_id == $this->session->userdata('id') && $row->orgmember_status == '1' && $this->uri->segment(3) == $row->orgm_id)){
                ?>
                    <button style="position: relative;"  type="submit" class="join1">Joined</button>
                <?php
                }else{
                ?>
                    <a style="position: relative;" class="join" href="<?=base_url('orgs/orgjoined/'.$row->org_id)?>">Join / Register</a>
                <?php
                }
                ?>

               

            <?php
                    break;
                    }
                }
            ?>

            

            <?php
                foreach($data->result() as $row)
                {
                    if($this->uri->segment(3) == $row->	org_id){
            ?>

                <div class="post-container">
                    
                    <div class="post-row">
                        <div class="user-profile">
                            
                            <?php if($row->org_image == ""){
                            ?>
                                    <img src=<?= base_url('assets/img/orgs_logo.png')?>>
                            <?php
                                }else{
                            ?>
                                    <img src=<?= base_url('upload/'.$row->org_image)?>>
                             <?php
                                 }
                            ?>

                            <div>
                                <?php if($row->org_status == "1"){
                                ?>
                                    <span class="book"><ion-icon name="bookmarks"></ion-icon></span>
                                <?php
                                }
                                ?>

                                <p><?php echo $row->org_name?></p>
                                <span><?php echo $row->org_published_date ?></span>
                                
                            </div>
                        </div>
                        <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                    </div>

                    <p class="post-text"><?php echo $row->org_post?></p>

                </div>

            <?php
                    }
                }
            ?>

        </div>
        <div class="right-sidebar">
            <div class="sidebar-title">
                <h4>Events / Activities</h4>
            </div>
            <div class="event">
                <div class="left-event">
                    <h3>18</h3>
                    <span>March</span>
                </div>
                <div class="right-event">
                    <h4>Org 1 Event</h4>
                    <p>Summarized words that fit in a few words</p>
                </div>
            </div>
            <div class="event">
                <div class="left-event">
                    <h3>22</h3>
                    <span>June</span>
                </div>
                <div class="right-event">
                    <h4>Org 2 Event</h4>
                    <p>Summarized words that fit in a few words</p>
                </div>
            </div>
            <div class="sidebar-title">
                <h4>Org Advertisements</h4>
            </div>
            <img src="images/advertisement.png" class="sidebar-ads">
        </div>

        
    </div>
    
  

    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
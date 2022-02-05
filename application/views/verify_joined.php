<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>C.L.I.K.I.T</title>

    <style>
        body{
            color: #efefef; 
            font-size: 16px; 
            text-decoration: none; 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            background-image: url( <?= base_url() ?>assets/img/bg10.jpg );
            background-repeat: no-repeat;
			background-size: cover;
        }
		#wrapper{
            max-width: 600px; 
            margin: auto auto; 
            padding: 20px;
        }
        #content{
            font-size: 16px; 
            padding: 25px; 
            background-color: #292731;
			moz-border-radius: 10px; 
            -webkit-border-radius: 10px; 
            border-radius: 10px; 
            -khtml-border-radius: 10px;
			border-color: #807575; 
            border-width: 4px 1px; 
            border-style: solid;
        }
        .icon{
            padding-top: 15px
        }
        ion-icon{
            font-size: 150px;
            color: #AED67A;
        }
        .button{
            display: flex; 
            justify-content: center; 
            margin-top: 10px;
            padding-top: 15px;
        }
        .button2{
            border: 1px solid #AED67A;
            background-color: #344025;
            color: #fff; 
            text-decoration: none; 
            font-size: 15px; 
            padding: 10px 20px;
            width: 200px;
            border-radius: 10px;
            letter-spacing:2px;
            word-spacing:2px;
        }

        .button2:hover{
            color: #fff; 
            background-color: #576B3D;
        }

        /* ERROR */
        .icon1 ion-icon{
            font-size: 150px;
            color: #893333;
        }
        .button{
            display: flex; 
            justify-content: center; 
            margin-top: 10px;
            padding-top: 15px;
        }
        .button1{
            border: 1px solid #893333;
            background-color: #360000;
            color: #fff; 
            text-decoration: none; 
            font-size: 18px; 
            padding: 10px 20px;
            width: 200px;
            border-radius: 10px;
            letter-spacing:2px;
            word-spacing:2px;
        }

        .button1:hover{
            color: #fff; 
            background-color: #893333;
        }

    </style>
</head>
<body>
        <?php
		    if($message === '1'){
        ?>
                <div id="wrapper">
                    <div id="content">

                        <center>

                            <h1 style="font-size: 25px;">Successfully Verified</h1>
                            <p class="icon"><ion-icon name="shield-checkmark-outline"></ion-icon></p>
                            <p>You successfully joined your new member</p>
                        </center>
                        
                    </div>
                </div>
         <?php
            }
        ?>
        <?php
          if($message === '0'){
        ?>
                    <div id="wrapper">
                        <div id="content">

                            <center>

                                <h1 style="font-size: 25px;">Invalid Link</h1>
                                <p class="icon1"><ion-icon name="alert-circle-outline"></ion-icon></p>
                                <p>You unsuccessfully joined your new member</p>
                            </center>
                            
                        </div>
                    </div>
        <?php
                }
        ?>

    <?php $this->load->view('endline');?>  
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clikit | Email</title>

    
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Cedarville+Cursive&family=Poppins:ital,wght@0,100;0,500;0,600;0,700;1,400&display=swap');
        body{
            color: #000; 
			font-size: 16px; 
			text-decoration: none; 
			font-family: 'Poppins', sans-serif;
			justify-content: center; 
            background-color: #2C1515;

        }
        .row{
            max-width: 600px; 
			margin: auto auto; 
			padding: 20px;
        }
        .row1{
            text-align: center;
            font-size: 14px; 
			padding: 25px; 
			background-color: #905152;
			border-color: #3B1C1C; 
			border-width: 4px 1px; 
			border-style: solid;
        }
        .row1 .h1{
            font-size: 34px;
        }
        .row1 .messages{
            display: flex; 
			justify-content: center; 
			margin-top: 10px;
        }
        .row1 .btn{
            
            border: 1px solid #3B1C1C;  
            background:  #59292B;
            color: #fff; 
            text-decoration: none; 
            font-size: 16px; 
            padding: 10px 20px; 
            border-radius: 10px;
            margin: 20px 0;
        }
        .row1 .btn:hover{
            background-color: #3B1C1C;
        }

        .row2{
            text-align: center;
            font-size: 14px; 
			background-color: #3B1C1C;
			border-radius: 0 0 10px 10px; 
			border-color: #3B1C1C; 
			border-width: 4px 1px; 
			border-style: solid;
            color: white;
            padding-bottom: 17px;
        }
        .row3{
            text-align: center;
            font-size: 14px; 
			background-color: #3B1C1C;
			border-radius: 10px 10px 0 0; 
			border-color: #3B1C1C; 
			border-width: 4px 1px; 
			border-style: solid;
            color: white;
        }
        .email{
            width: 100%;
            height: 100%;
         }
         .logo{
            position: absolute;
            width: 18%;
            transform: translate(-115%,600%);
         }
         .welcome{
            position: absolute;
            font-size: 22px;
         }
         .text{
            font-size: 15px;
            padding: 0 15px;
            text-decoration: none;
            color: white;
            
         }
         .stay{
            text-align: center;
            font-size: 35px;
            color: whitesmoke;
            font-family: 'Cedarville Cursive', cursive;
         }
         .stay1{
            text-align: center;
            font-size: 10px;
            color: whitesmoke;
         }
    </style>
</head>
<body>

    <div class="row">

        <div class="row3">
            <p class="stay"> Email Verification</p>
        </div> 
		<div class="row1">						
			<div class="text">
                <p >Hey <?php echo $fullname;?>, you're almost ready to start enjoying C.L.I.K.I.T.  <br>
                Please verify that your email address is <?php echo $email;?>
                 <br> <br>
                Simply click the button below to verify your email address.</p>
            </div>
		
           
			<p class="messages">
                <center>	
					<a class="btn" href="<?=base_url('welcome/verify_email/'.$verification_key)?>">	
							Verify email address
					</a>
                </center>
			</p>

            
            
		</div>  
        <div class="row2">
            <p class="stay"> Stay in touch in Clikit</p>

            <p class="stay1">Email sent by C.L.I.K.I.T  <br>
                Copyright &copy; 2022 C.L.I.K.I.T. All Rights Reserved
            </p>
        </div> 
	</div>
    
</body>
</html>
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
            text-align: justify;
            text-justify: inter-word;
            
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
            <p class="stay"> Messages Request Sent </p>
        </div> 
		<div class="row1">						
			<div class="text">
                <h1>Thank You!</h1>
                <p><br> 
                   The <?php echo $org_name;?> received your messages request.<br>
                   Someone from their team will contact you soon.

                  <br><br>
                 <b>Contact Us | Messages Content</b> <br>
                 <b>Subject:</b> <?php echo $subject;?><br>
                 <b>Messages:</b> <?php echo $message;?></p>
            </div>

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
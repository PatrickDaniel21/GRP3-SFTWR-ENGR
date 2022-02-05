<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Clikit | About Us</title>

	<!-- CSS STYLE FOR SIGN UP -->
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,500;0,600;0,700;1,400&display=swap');
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			outline: none;
			text-decoration: none;
			list-style: none;
			font-family: 'Poppins', sans-serif;
		}

		body{
			background-image: url( <?= base_url() ?>assets/img/bg10.jpg );
        	background-repeat: no-repeat;
			background-size: cover;
		}

		/* WRAPPER FOR LOGO AND FORM */
		.wrapper{
			display: flex;
			width: 70rem;
			height: 570px;
			position: absolute;
			top: 50%;
			left:50%;
			transform: translate(-50%,-50%);
		}

		/* SIZE OF BOX IN FORM */
		.wrapper .right{
			width: 65%;
			height: 100%;
			padding: 30px;
			padding-left: 60px;
			padding-right: 60px;
			background: #632626;
			background-repeat: no-repeat;
			background-size: cover;
			border-radius: 0 20px 20px 0;
		}

		/* SIZE OF BOX IN LOGO */
		.wrapper .left{
			width: 35%;
			height: 100%;
			padding: 30px;
			background-image: url( <?= base_url() ?>assets/img/bg5.jpg );
			background-repeat: no-repeat;
			background-size: cover;
			border-radius: 20px 0 0 20px ;
		}

		.wrapper .left img{
			width: 100%;
			transform: translate(1%,250%);
		}

		/* FORM GREETINGS */
		.wrapper .right h3{
			font-size: 2.5rem;
			color: #fff3f2;
			font-weight: 600;
			line-height: 72px;
			letter-spacing: 1px;
			word-spacing: 2px;
			text-align: center;
			margin-bottom: 15px;
			margin-top: 10px;
		}

		.wrapper .right .form{
			margin-top: 0;
		}

		/* TITLE OF FORM QUESTIONS */
		.wrapper .right .form label{
			color: #fff3f2;
			letter-spacing: 1px;
			margin-top: 3px;
			font-weight: 500;
			font-size: 14px;
		}

		/* LOGIN QUESTION TEXT */
		.wrapper .right h4{
			color: #fff3f2;
			font-size: small;
			letter-spacing: 1px;
			word-spacing: 1px;
			text-align: center;
		}

		/* INPUT BOX */
		.wrapper .right .input{
			width: 100%;
			padding: 3px;
			border: 3px;
			font-size: 13px;
			background:  #EFF0F2;
		}

		/* INPUT PLACEHOLDER */
		input::placeholder{
			color: #838383;
			font-size: 13px;
			font-weight: 100%;
			font-weight: normal;
		}

		/* FORM ERROR MESSAGES*/
		.wrapper .right .text-danger{
			font-size: 13px;
			padding-bottom:-1.25em;
			margin-bottom:-1.25em;
		}

		/* PASSWORD OR EMAIL ERROR */
		.wrapper .right .pass{
			font-size: 16px;
			margin-top:20px;
			margin-bottom:none;
		}

		/* CREATE ACCOUNT BUTTON */
		.wrapper .right .btn{
			color: #fff;
			text-align: center;
			background:  #8E5758;
			width: 250px;
			height: 35px;
			transform: translate(0%,110%);
		}

		.wrapper .right .btn:hover{
			background-color: #260200;
		}
		.officers{
			margin-top: 40px;
			margin-bottom: 50px;
			color: white;

		}
	</style>
  </head>
  <body>
	<div class="wrapper">

			<!-- LOGO SECTION -->
			<div class="left">  
				<img src=<?= base_url('assets/img/DEN-LOGO.png')?>> 
			</div>


			<!-- FORM SECTION -->
			<div class="right">
				<center>
					<h3>About Us</h3>
					<h4>This Organization is about college students who are good in coding </h4>
			  	</center>
				<div class="officers">
					<h2>Officers</h2>
					<div style="padding-top: 10px; margin-left: 50px;">
						<table>
							<tr>
								<th>President</th>
								<th style="padding-left: 60px;">Adviser</th>
							</tr>
							<tr >
								<td>&emsp; Alfreds Futterkiste</td>
								<td style="padding-left: 60px;">&emsp; Prof. May M. Garcia</td>
								
							</tr>
							<tr>
								<th>Vice President</th>
								<td style="padding-left: 60px;">&emsp; Prof. Jan Eilbert L. Lee</td>
							</tr>
							<tr>
								<td>&emsp; Alexandra Loreinne Guzman</td>
							</tr>
							<tr>
								<th>Secretary</th>
							</tr>
							<tr>
								<td>&emsp; Irene Aubrey Floresca</td>
							</tr>
							<tr>
								<th>Vice President for Finance</th>
							</tr>
							<tr>
								<td>&emsp; Marc Rovic Baja</td>
							</tr>
							<tr>
								<th>Vice President</th>
							</tr>
							<tr>
								<td>&emsp; Alexandra Loreinne Guzman</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
	</div>



    <?php $this->load->view('endline');?>  
  </body>
</html>

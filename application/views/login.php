<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Clikit | Login</title>

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
			overflow: hidden;
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
			background: url('../assets/img/bg2.jpg');
			background-repeat: no-repeat;
			background-size: cover;
			border-radius: 0 20px 20px 0;
		}

		/* SIZE OF BOX IN LOGO */
		.wrapper .left{
			width: 35%;
			height: 100%;
			padding: 30px;
			background: url('../assets/img/bg5.jpg');	
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
			margin-bottom: 30px;
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
			padding: 6px;
			font-size: small;
			letter-spacing: 1px;
			word-spacing: 1px;
			text-align: center;
		}

		/* LINK OF LOGIN AND FORGOT PASSWORD */
		.wrapper .right .form h4 a{
			color: #260200;
			margin-top: 0;
			font-weight: bold;
			font-size: 14px;
			text-align: center;
			text-decoration: none;
		}

		/* INPUT BOX */
		.wrapper .right .input{
			width: 100%;
			padding: 10px 15px;
			border: 5px;
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
			background:  #4d0400;
			width: 250px;
			height: 35px;
			transform: translate(0%,110%);
		}

		.wrapper .right .btn:hover{
			background-color: #260200;
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
			<h3>Welcome to C.L.I.K.I.T</h3>
				<div class="form">

					<!-- ERROR MESSAGES FOR INCOMPLETE FORM -->
					<?php
						// CHECK THE URL IF THERE IS "FAILED FUNCTION" FOUND IN URL : 'Yung Function nasa Controllers/Welcome.php
						// HELP RETRIEVE INFORMATION FROM "uri" STRINGS
						if($this->uri->segment(2) == "validation1"){
							// base url - http://localhost/cilogin/
							// redirect url - http://localhost/cilogin/welcome/validation1
							// welcome = segment(1)
							// validation1 - segment(2)
		
							echo '
							<div class="alert alert-danger"> 
								<span>Please fill in all the required fields</span>
							</div>';
						}
					?>

					<!-- ERROR MESSAGES FOR WRONG PASSWORD AND EMAIL -->
					<?php
						// CHECK THE URL IF THERE IS "FAILED FUNCTION" FOUND IN URL : 'Yung Function nasa Controllers/Welcome.php
						// HELP RETRIEVE INFORMATION FROM "uri" STRINGS
						if($this->uri->segment(2) == "validation"){
							// base url - http://localhost/cilogin/
							// redirect url - http://localhost/cilogin/welcome/validation
							// welcome = segment(1)
							// validation - segment(2)
		
							echo '
							<div class="alert alert-danger"> 
								<span>Incorrect password or email.</span>
							</div>';
						}
					?>

					<?php
						// CHECK THE URL IF THERE IS "FAILED FUNCTION" FOUND IN URL : 'Yung Function nasa Controllers/Welcome.php
						// HELP RETRIEVE INFORMATION FROM "uri" STRINGS
						if($this->uri->segment(2) == "accept"){
							// base url - http://localhost/cilogin/
							// redirect url - http://localhost/cilogin/welcome/validation
							// welcome = segment(1)
							// validation - segment(2)
		
							echo '
							<div class="alert alert-success"> 
								<span>Password changed sucessfully.</span>
							</div>';
						}
					?>

					<?php
						// CHECK THE URL IF THERE IS "FAILED FUNCTION" FOUND IN URL : 'Yung Function nasa Controllers/Welcome.php
						// HELP RETRIEVE INFORMATION FROM "uri" STRINGS
						if($this->uri->segment(2) == "notaccept"){
							// base url - http://localhost/cilogin/
							// redirect url - http://localhost/cilogin/welcome/validation
							// welcome = segment(1)
							// validation - segment(2)
		
							echo '
							<div class="alert alert-danger"> 
								<span>Password changed unsucessfully.</span>
							</div>';
						}
					?>

					<!-- MAIN FORM -->
					<form method="post" autocomplete="off" action="<?=base_url('welcome/loginnow')?>">

						<!-- Kung anong input name sa signup, ganun din dapat sa login -->
						
						<div class="row">
							<!-- GET EMAIL -->
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">TUP Email</label>
								<input 
									type="email"  
									placeholder="Enter your tup email" 
									name="email" class="form-control" 
									required
									oninvalid="this.setCustomValidity('Enter TUP Email Here')" 
									oninput="this.setCustomValidity('')"
									id="exampleInputEmail1" 
									aria-describedby="emailHelp"

								>

								<span class="text-danger"><?php echo form_error("email")?></span>
							</div>

							<!-- GET PASSWORD -->
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Password</label>
								<input 
									type="password" 
									name="password"  
									required
									oninvalid="this.setCustomValidity('Enter Password Here')" 
									oninput="this.setCustomValidity('')"
									placeholder="Enter your password"  
									class="form-control" 
									id="exampleInputPassword1"
								>

								<span class="text-danger"><?php echo form_error("password")?></span>
							</div>

							<!-- LOGIN BUTTON -->
							<div class="rounded-0 text-center mb-5">
								<button type="submit" class="btn">Login</button>
							</div>
							
							<!-- LINK TO LOGIN -->
							<h4>Don't have an account? 
								<a class="" href="<?=base_url()?>">Signup</a> <br>
								<div class="pt-2">
									<a class="" href="<?=base_url('welcome/forgot')?>">Forgot Password?</a>	
								</div>
							</h4> 
						</div>		
					</form>
				</div>
			</div>
	</div>

	<?php $this->load->view('endline');?>  
  </body>
</html>

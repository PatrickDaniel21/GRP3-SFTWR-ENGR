<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Clikit | Otp Code</title>

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
			padding: 25px;
			font-size: small;
			letter-spacing: 1px;
			word-spacing: 1px;
			text-align: center;
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
			width: 200px;
			height: 35px;
            letter-spacing:2px;
			transform: translate(100%,200%);
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
			<h3>Verification Code</h3>
				<div class="form">

                    <!-- ALERT MESSAGES FOR SENT EMAIL -->
                    <?php
                        // CHECK THE URL IF THERE IS "FAILED FUNCTION" FOUND IN URL : 'Yung Function nasa Controllers/Welcome.php
                        // HELP RETRIEVE INFORMATION FROM "uri" STRINGS

                        if($this->uri->segment(2) == "otpsent"){
                            // base url - http://localhost/cilogin/
                            // redirect url - http://localhost/cilogin/welcome/otpsent
                            // welcome = segment(1)
                            // otpsent - segment(2)
        
                            echo '
                            <div class="alert alert-success"> 
                                <span>Kindly check the verification code sent to your email.</span>
                            </div>';
                        }
                    ?>

                    <!-- ERROR MESSAGES FOR UNSENT EMAIL -->
                    <?php
                        // CHECK THE URL IF THERE IS "FAILED FUNCTION" FOUND IN URL : 'Yung Function nasa Controllers/Welcome.php
                        // HELP RETRIEVE INFORMATION FROM "uri" STRINGS
                        if($this->uri->segment(2) == "otpnotsent"){
                            // base url - http://localhost/cilogin/
                            // redirect url - http://localhost/cilogin/welcome/otpnotsent
                            // welcome = segment(1)
                            // otpnotsent - segment(2)
        
                            echo '
                            <div class="alert alert-danger"> 
                                <span>Verification email was unsuccessfully sent.</span>
                            </div>';
                        }
                    ?>

                    <!-- ALERT FOR INCOMPLETE FORMS -->
                    <?php
                        // CHECK THE URL IF THERE IS "FAILED FUNCTION" FOUND IN URL : 'Yung Function nasa Controllers/Welcome.php
                        // HELP RETRIEVE INFORMATION FROM "uri" STRINGS

                        if($this->uri->segment(2) == "otperror"){
                            // base url - http://localhost/cilogin/
                            // redirect url - http://localhost/cilogin/welcome/otperror
                            // welcome = segment(1)
                            // otperror - segment(2)
        
                            echo '
                            <div class="alert alert-danger"> 
                                <span>Please fill in all the required fields</span>
                            </div>';
                        }
                    ?>

                    <!-- ALERT FOR WRONG FORMS -->
                    <?php
                        // CHECK THE URL IF THERE IS "FAILED FUNCTION" FOUND IN URL : 'Yung Function nasa Controllers/Welcome.php
                        // HELP RETRIEVE INFORMATION FROM "uri" STRINGS

                        if($this->uri->segment(2) == "fcode"){
                            // base url - http://localhost/cilogin/
                            // redirect url - http://localhost/cilogin/welcome/fcode
                            // welcome = segment(1)
                            // fcode - segment(2)
        
                            echo '
                            <div class="alert alert-danger"> 
                                <span>Invalid verification code.</span>
                            </div>';
                        }
                    ?>

					<!-- MAIN FORM -->
					<form method="post" autocomplete="off" action="<?=base_url('welcome/otpcode')?>">

						<!-- Kung anong input name sa signup, ganun din dapat sa login -->
						
						<div class="row">
							<!-- GET EMAIL -->
							<div class="mb-3 mt-4">
								<label for="exampleInputEmail1" class="form-label">Verification Code</label>
								<input 
									type="password"  
									placeholder="Enter your verification code" 
									name="code" 
									required 
									oninvalid="this.setCustomValidity('Enter Verification Code Here')" 
									oninput="this.setCustomValidity('')"
									class="form-control" 
									id="exampleInputEmail1" aria-describedby="emailHelp">
							</div>

                            

							<!-- LOGIN BUTTON -->
							<div class="rounded-0 text-center mb-5 mt-5 pt-5">
								<button type="submit" class="btn">Enter</button>
							</div>	

						</div>		
					</form>
				</div>
			</div>
	</div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

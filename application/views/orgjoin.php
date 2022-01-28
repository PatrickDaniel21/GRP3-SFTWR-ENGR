<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>C.L.I.K.I.T</title>

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
            margin-top: 15px;
		}

		.wrapper .right .btn:hover{
			background-color: #260200;
		}
        

        select:focus > option:checked { 
            cursor: pointer;
            color: white;
            background: #8E5758 !important;

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
			<h3>Join Organization</h3>
      		<h4>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti, accusantium?</h4>
			  </center>
				<div class="form">
					<!-- MAIN FORM -->

					<?php
                    foreach($data->result() as $row)
                    {
                        
                        if($row->org_id == $this->uri->segment(3))
                        {
                    ?>

                        <!-- Create Form -->
                        <form id="form" method="post" autocomplete="off" action="<?=base_url('orgs/joinorgs/'.$this->uri->segment(3))?>">

                            <!-- Details -->
                            <div class="row">
                                <div class="mt-4">
                                    <label for="name">Full Name</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="name"
                    					placeholder="Santos, John Paul S." 
                    					name="orgmember_fullname" 
                                        required
                                        oninvalid="this.setCustomValidity('Enter Email Here')" 
                                        oninput="this.setCustomValidity('')" 
                                    >
                                </div>
                            

                            <div class="mt-4">
                                <label for="name" id="label-name">
                                    Years & Section
                                </label>

                                <!-- Input Type Text -->
                                <input type="text"
                                    id="name"
                                    placeholder="BSCS-3D" 
                                    name="orgmember_section" 
                                    class="form-control" 
                                    required
                                    oninvalid="this.setCustomValidity('Enter Section Here')" 
                                    oninput="this.setCustomValidity('')"
                                    />
                            </div>

                            <div class="mt-4">
                                <label for="role" id="label-role">
                                    College
                                </label>
                                
                                <!-- Dropdown options -->
                                <select name="orgmember_college" id="role" class="form-control"  required>
                                    <option value="COLLEGE OF INDUSTRIAL TECHNOLOGY">COLLEGE OF INDUSTRIAL TECHNOLOGY</option>
                                    <option value="COLLEGE OF ENGINEERING">COLLEGE OF ENGINEERING</option>
                                    <option value="COLLEGE OF SCIENCE">COLLEGE OF SCIENCE</option>
                                    <option value="COLLEGE OF ARCHITECTURE AND FINE ARTS">COLLEGE OF ARCHITECTURE AND FINE ARTS</option>
                                    <option value="COLLEGE OF INDUSTRIAL EDUCATION">COLLEGE OF INDUSTRIAL EDUCATION</option>
                                    <option value="COLLEGE OF LIBERAL ARTS">COLLEGE OF LIBERAL ARTS</option>
                                </select>
                            </div>

                            <input type="hidden" id="1" name="org_contact" value=<?php echo $row->org_contact?>>
                            <input type="hidden" id="2" name="org_name" value=<?php echo $row->org_name?>>

                            <!-- Multi-line Text Input Control -->
                            <div class="rounded-0 text-center mb-4">
                                <button type="submit" class="btn">Join Organization</button>
                            </div>
                            
                            </div>
                        </form>
                    <?php
                            break;
                        }
                    }
                    ?>
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

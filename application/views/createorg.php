<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
	<title>
		Clikit | Create Organization Form
	</title>

	<style type="text/css">

		/* Styling the Body element i.e. Color,
		Font, Alignment */
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,500;0,600;0,700;1,400&display=swap');
        *{
            margin: 0;
            padding: 0;
            list-style: none;
			font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }
		body {
            background-image: url( <?= base_url() ?>assets/img/bg10.jpg );
        	background-repeat: no-repeat;
			background-size: cover;
		}
        .title-form{
			background-image: url( <?= base_url() ?>assets/img/bg5.jpg );
			background-repeat: no-repeat;
			background-size: cover;
			border-radius: 20px 20px 0 0 ;
			max-width: 60%;
			margin: 50px auto 0 auto;
			padding: 30px 45px;
			box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
			justify-content: center;
        }
		.title-form img{
			margin-top: 10px;
			width: 50%;
		}

		/* Styling the Form (Color, Padding, Shadow) */

		form {
			background: #632626;
			border-radius: 0 0 20px 20px ;
			max-width: 60%;
			margin: 0 auto;
			padding: 40px 45px;
			box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
			color: white;
		}

		#form h2{
			margin-bottom: 25px;
		}

		/* Styling form-control Class */
		.form-control {
			text-align: left;
			margin-bottom: 25px;
		}

		/* Styling form-control Label */
		.form-control label {
			display: block;
			margin-bottom: 10px;
		}

		/* Styling form-control input,
		select, textarea */
		.form-control input,
		.form-control select,
		.form-control textarea {
			border: 1px solid #777;
			border-radius: 2px;
			font-family: inherit;
			padding: 10px;
			display: block;
			width: 95%;
			border-radius: 10px;
		}

		/* Styling form-control Radio
		button and Checkbox */
		.form-control input[type="radio"],
		.form-control input[type="checkbox"] {
			display: inline-block;
			width: auto;
		}

		/* Styling Button */
        .btn{
			color: #fff;
			text-align: center;
			background:  #4d0400;
			height: 40px;
            cursor: pointer;
            border-radius: 10px;
			font-family: inherit;
			font-size: 18px;
			display: block;
			width: 50%;
			margin-top: 50px;
			margin-bottom: 20px;
			border: none;
		}

		.btn:hover{
			background-color: #260200;
		}
	</style>
</head>

<body>
	<div class="title-form">
		<h1 ><img src=<?= base_url('assets/img/DEN-LOGO.png')?>> </h1>
		
	</div>

	<!-- Create Form -->
	<form id="form" method="post" autocomplete="off" action="<?=base_url('orgs/registerNow')?>">
		<h2>Organization Form</h2>
		<!-- Details -->
		<div class="form-control">
			<label for="name" id="label-name">
				Full Name
			</label>

			<!-- Input Type Text -->
			<input type="text"
				id="name"
				placeholder="Enter your full name" 
                name="org_representative" required />
		</div>

        <div class="form-control">
			<label for="name" id="label-name">
				Tup Id
			</label>

			<!-- Input Type Text -->
			<input type="text"
				id="name"
				placeholder="Enter your tup id" 
                name="org_reptupid" required/>
		</div>

        <hr><br>

        <div class="form-control">
			<label for="name" id="label-name">
				Name of Organization
			</label>

			<!-- Input Type Text -->
			<input type="text"
				id="name"
				placeholder="Enter your organization name" 
                name="org_name" required/>
		</div>

        <div class="form-control">
			<label for="presname" id="label-presname">
				Organization President
			</label>

			<!-- Input Type Text -->
			<input type="text"
				id="presname"
				placeholder="Who is your organization president" 
                name="org_president" required/>
		</div>

        <div class="form-control">
			<label for="email" id="label-email">
				Contact Email
			</label>

			<!-- Input Type Text -->
			<input type="email"
				id="email"
				placeholder="Enter the organization contact email" 
                name="org_contact" required/>
		</div>


        <div class="form-control">
            <label for="comment">
                About the Organization
            </label>

            <textarea name="org_about" placeholder="Enter what is your organization all about?" required></textarea>
        </div>

		<!-- Multi-line Text Input Control -->
		<div class="rounded-0 text-center mb-4">
			<button type="submit" class="btn">Create Account</button>
		</div>	
	</form>
</body>

</html>

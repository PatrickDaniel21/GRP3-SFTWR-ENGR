<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
	<title>
		Create Organization Form
	</title>

	<style type="text/css">

		/* Styling the Body element i.e. Color,
		Font, Alignment */
        *{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }
		body {
            background: #4A2324;
			text-align: center;
		}
        .title-form{
            font-size: 3rem;
            padding-top: 50px;
            color: white;
        }

		/* Styling the Form (Color, Padding, Shadow) */

		form {
			background-color: #fff;
			max-width: 50%;
			margin: 50px auto;
			padding: 40px 45px;
			box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
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
			background:  #800000;
			width: 250px;
			height: 35px;
            cursor: pointer;
            border-radius: 2px;
			font-family: inherit;
			font-size: 21px;
			display: block;
			width: 100%;
			margin-top: 50px;
			margin-bottom: 20px;
            border: none;
		}

		.btn:hover{
			background-color: #522020;
		}
	</style>
</head>

<body>
	<h1 class="title-form">Join Organization Form</h1>
    
    <?php
    foreach($data->result() as $row)
    {
        
        if($row->org_id == $this->uri->segment(3))
        {
    ?>

        <!-- Create Form -->
        <form id="form" method="post" autocomplete="off" action="<?=base_url('orgs/joinorgs/'.$this->uri->segment(3))?>">

            <!-- Details -->
            <div class="form-control">
                <label for="name" id="label-name">
                    Full Name
                </label>

                <!-- Input Type Text -->
                <input type="text"
                    id="name"
                    placeholder="Santos, John Paul S." 
                    name="orgmember_fullname" 
                    required
                    oninvalid="this.setCustomValidity('Enter Full Name Here')" 
					oninput="this.setCustomValidity('')" 
                    
                    />
            </div>

            <div class="form-control">
                <label for="name" id="label-name">
                    Years & Section
                </label>

                <!-- Input Type Text -->
                <input type="text"
                    id="name"
                    placeholder="BSCS-3D" 
                    name="orgmember_section" 
                    required
                    oninvalid="this.setCustomValidity('Enter Section Here')" 
					oninput="this.setCustomValidity('')"
                    />
            </div>

            <div class="form-control">
                <label for="role" id="label-role">
                    College
                </label>
                
                <!-- Dropdown options -->
                <select name="orgmember_college" id="role" required>
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
        </form>
    <?php
            break;
        }
    }
    ?>
</body>

</html>

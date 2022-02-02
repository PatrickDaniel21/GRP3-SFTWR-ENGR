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
			<h3>Contact Us</h3>
      		<h4>Feel free to contact us and we will get back to you as soon as we can. </h4>
			  </center>
				<div class="form">
					<!-- MAIN FORM -->

					<?php
					foreach($data->result() as $row)
					{
						
						if($row->org_id == $this->uri->segment(3))
						{
					?>
					
					<form id="form" method="post" autocomplete="off" action="<?=base_url('orgs/sendcontact')?>">

						<!-- Kung anong input name sa signup, ganun din dapat sa login -->
						
						<div class="row">
							<!-- Message -->
							<div class="mt-4">
								<label for="email">Email</label>
          				 		 <input 
									type="text" 
									class="form-control" 
									id="email" 
									name="email"
									placeholder="Enter your email" 
									required
									oninvalid="this.setCustomValidity('Enter Email Here')" 
									oninput="this.setCustomValidity('')" 
								>
							</div>

                            <div class="mt-3">
								<label for="Subject">Subject</label>
      						      <input 
									type="text" 
									class="form-control" 
									id="subject" 
									name="subject"
									placeholder="Enter subject of the email" 
									required
									oninvalid="this.setCustomValidity('Enter Subject Here')" 
									oninput="this.setCustomValidity('')" 
								>
							</div>

							<div class="mb-3 mt-3">
								<label for="Message">Message</label>
           						 <textarea 
									class="form-control" 
									name="message" 
									id="message"
									required
									oninvalid="this.setCustomValidity('Enter Messages Here')" 
									oninput="this.setCustomValidity('')" 
								 >
								 </textarea>
							</div>

							<input type="hidden" id="1" name="org_contact" value=<?php echo $row->org_contact?>>
            				<input type="hidden" id="2" name="org_name" value=<?php echo $row->org_name?>>


							<!-- SEND BUTTON -->
							<div class="rounded-0 text-center mb-5 ">
								<button type="submit" class="btn">Send</button>
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

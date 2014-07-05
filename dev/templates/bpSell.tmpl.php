  <?php
	if(isset($_SESSION['USERID'])) {
		$strLocation = "bpSellLogged.php";
	}
	else {
		$strLocation = HTTP."bpUserSignup.php";
	}
?>


<div id="container">
	<div class="roundedTab" id="selNotLoggedIn">   
		<div class="t">
			<div class="tab"><h3>how selling works!</h3></div>
			<div class="tr"></div>
		</div>
		
		<div class="c">
			<div class="cl">
				
                	<div class="pad">
                	
                    <h1>sign-up</h1>
                    <h6>It’s free and easy to get started.</h6>
                	<p>Simply choose a display name and password – and confirm your email address. It’s that’s simple.</p>
                    <div class="hr"><hr /></div>
                    
                    <h1>upload and set a price</h1>
                    <h6>Now it gets fun! With just a click of a button.</h6>
                	<p>You can sell all of your unwanted digital music for real money! Even more, you can buy digital music from other members for as low as a quarter!</p>
                    <div class="hr"><hr /></div>
                    
                    <h1>
                      listed on bopaboo</h1>
                    <h6>There is NO FEE to list your item for sale.</h6>
                	<p>And once your music is listed – it will be seen all over the world by everyone looking to buy music! You will determine the price and have the ability to edit your listings at anytime.</p>
                    <div class="hr"><hr /></div>
                    
                    <h1>fees</h1>
                    <h6>When your item is sold – We handle everything! Just relax.</h6>
                	<p>We split the revenue and you keep 80% of the sale! We accept all credit cards and handle all of the credit card transactions. We immediately transfer the money for the sale of your item into your bopaBank (eWallet) account and you can withdraw your money through PayPal at anytime!</p>
                    <div class="hr"><hr /></div>
                    
                    <h1>history and feedback</h1>
                	<p>We provide you a complete history of your sales and feedback rating from your buyers!</p>
                    <a href="<?php echo $strLocation?>" class="startSelling"><img src="images/buttonStartSelling.png" alt="start selling" /></a>
                    <p>Still have more questions? <a href="bpHelp.php?id=7">Click here</a> to visit our Frequently Asked Questions (FAQ)</p>
                    
                    </div>

			</div>			
			<div class="b"><span class="br"></span></div>			
		</div>
	</div>
</div>

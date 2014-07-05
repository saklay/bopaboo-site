
<!-- begin footer -->
<div id="footer">
	
  <ul id="box001">
    <li><h3>Get your bopaboo on!</h3></li>
<?php if($_COOKIE['COOKIE_USERNAME']!="" && $_SESSION['USERID']!='') { ?>
		<li><a href="bpBuy.php">let's start buying!</a></li>
		<li><a href="bpSell.php">let's start selling!</a></li>
		<li><a href="bpMyBopa.php?invite=1">let's invite your friends!</a></li>
<?php } else {  ?>
    <li>got unwanted tunes?</li>
    <li>get started now and </li>
    <li>start making some cash!</li>
    <li><br /><a href="bpUserSignup.php" class="footerRegisterNow">Register Now!</a></li>
<?php } ?>
  </ul>
  
  <ul id="box002">
    <li><h4>Business &amp; Media </h4></li>
    <li><a href="#" rel="facebox">Press Releases</a></li>
    <li><a href="#">In the News</a></li>
    <li><a href="#" target="_blank">Advertising Opportunities</a></li>
    <li><a href="#" target="_blank">Partnership Opportunities</a></li>
  </ul>
  
  <ul id="box003">
    <li><h4>Company </h4></li>
    <li><a href="http://blog.bopaboo.com/?page_id=2" rel="facebox" target="_blank">About Us</a></li>
    <li><a href="http://blog.bopaboo.com/?page_id=10" target="_blank">Management</a></li>
    <li><a href="http://blog.bopaboo.com/?cat=6" target="_blank">Blog</a></li>
    <li><a href="http://blog.bopaboo.com/?cat=5" target="_blank"><strong>We're Hiring!</strong></a></li>
    <li><a href="http://blog.bopaboo.com/?page_id=13" target="_blank">Contact Us</a></li>
  </ul>
  
  <ul id="box004">
    <li><h4>Legal Info </h4></li>
    <li><a href="bpPrivacyPolicy.php" rel="facebox">Privacy Policy</a></li>
    <li><a href="bpTermsOfService.php">Terms of Use</a></li>
  </ul>
  
  <ul id="box005">
    <li><h4>Account </h4></li>
<?php if($_COOKIE['COOKIE_USERNAME']!="" && $_SESSION['USERID']!='') { ?>
		<li><a href="bpHelp.php" rel="facebox">FAQ</a></li>
		<li><a href="bpChangeAccount.php">Account</a></li>
		<li><a href="bpAccountActivity.php" target="_blank">bopaBank</a></li>
		<li><a href="bpMyBopaMessageInbox.php" target="_blank">Messages</a></li>
		<li><a href="bpFeedback.php?feedbacklist=provided" target="_blank">Feedback</a></li>
<?php } else {  ?>
    <li><a href="bpHelp.php" rel="facebox">FAQ</a></li>
<?php } ?>
  </ul>
  
  <div id="footerBottom"><span>bopaboo, LLC.</span> &copy; Copyright  2008 All rights reserved.</div>
  
</div>
<!-- end footer -->

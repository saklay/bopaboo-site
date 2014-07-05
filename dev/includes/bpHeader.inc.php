    	<div id="header">
        	<a href="#" id="logo">Bopaboo</a>
            <div id="topnav">
            	<a href="#" target="_self"><img src="images/cart-icon.gif" width="20" height="15" border="0" alt="my cart" />My Cart</a>
                <a href="#" target="_self"> My Account</a>
                <a href="#" target="_self"> Help</a> 
            </div>
            
            <div id="login"> <!--Welcome starts here-->
    <?php if(isset($_COOKIE['COOKIE_USERNAME'])) print  "Welcome! ".$_COOKIE['COOKIE_USERNAME'];?><a href="index.php">Sign-in</a>or<a href="bpUserSignup.php">Register</a></div><!--Welcome Ends here--> 
    
    <!--Welcome Ends here-->
    
 
                <form name="form1" action="" method="post" title="form1" id="searchbox"> 
                   <div id="listings">
                   	 <ul>
                    	<li class="top"><a href="#">all</a></li>
                        <li><a href="#">artists</a></li>
                        <li><a href="#">albums</a></li>
                        <li><a href="#">songs</a></li>
                        <li class="bottom"><a href="#">sellers</a></li>
                    </ul>
                   </div>
                <input name="t_name" type="text" id="t_name"/>
                    <span class="spacing">
                    <input type="image" src="images/go_btn.jpg" id="gobutton" />
                    </span>
                </form> <a href="#" class="advsearch"><img src="images/icon-arrow.png" alt="arrow" />&nbsp;&nbsp;Advanced Search</a>
				<div id="cls"></div>
               
                <ul id="menu">
                    <li id ="buytab"><a href="#" >Home</a></li>
                    <li id="selltab"><a href="#">Buy</a></li>
                    <li id ="mybopatab"><a href="bpMyBopa.php" class="current">Sell</a></li>
                    <li id ="bopaboxtab"><a href="bpBopaBox.php" >myBopa</a></li>
                </ul>
      </div>
      
      
      
      
      
      
    
    <div class="welcomemessage"> <!--Welcome starts here-->
    Welcome! <?php print($_COOKIE['COOKIE_USERNAME']);?><a href="#">Sign-in</a>or<a href="#">Register</a></div><!--Welcome Ends here-->
    	
        <div class="searchbox"> <!--Serchbox starts here-->

   		 	<div id="search">
  		<form  action="/search/" method="get" id="global-search" name="search" autocomplete="off">

            <select name="listss" size="1" id="listartists">
              <option>All</option>
              <option>Artists</option>
              <option>Albums</option>
              <option>Songs</option>
            </select>
          <input type="text" class="search-inp" name="query" id="query" value="" />
        <div class="submit">
          <input type="submit" value="Go" />
        </div>

      </form>
  	</div>
   	  </div><!--Serchbox Ends here-->
  </div> 
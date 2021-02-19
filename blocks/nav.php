


<nav <?php if ($navbarTop) {echo 'id="top"';} ?>>
	<div class="nav">
		<div class="navImg">
			<a class="navImg" href="/index.php"><img src="img/logo.png" alt="MLA logo"  onerror="this.src='../img/logo.png';"/></a>
		</div>
		<ul class="nav">

			<li class="nav"><a class="nav" <?php if ($currentPage === 'Home') {echo 'id="active"';} ?> href="/index.php">Home</a></li>
			<li class="nav"><a class="nav" <?php if ($currentPage === 'Q&A') {echo 'id="active"';} ?> href="/qa/index.php">Q&amp;A</a></li>
			<li class="nav"><a class="nav" <?php if ($currentPage === 'Admin') {echo 'id="active"';} ?> href="/admin/index.php">Admin</a></li>
<!--			<li class="nav rightNav"><a class="nav" <?php if ($currentPage === 'Account') {echo 'id="active"';} ?> href="account/index.php">Account</a></li>-->
			
		</ul>
		<div class="navAccount">
<!--			<a class="nav" <?php if ($currentPage === 'Account') {echo 'id="active"';} ?> href="account/index.php">Account</a>-->
			<a class="navAccount" <?php if ($currentPage === 'Account' || $currentPage === 'Login' || $currentPage === 'Register') {echo 'id="active"';} ?> href="/account/index.php"><span style="font-size: inherit;" class="material-icons">person_outline</span></a>
		</div>

	</div>
</nav>



<!--
    
    <ul class="mobNavHeader">
      <li class="mobNavHeader"><a href="javascript:void(0)" class="mobNavHeader" onclick="mobNavOpen()">&#9776;</a></li>
      <li class="mobNavHeader"><a id="logo" href="/index.html" class="mobNavHeader">Jan Koster</a></li>
    </ul>

    <div onclick="mobNavClose()" id="mobNavDiv" class="mobNav">
    </div>
    <ul id="mobNav" class="mobNav">
      <li class="closeBtn"><a href="javascript:void(0)" class="closeBtn" onclick="mobNavClose()">&times;</a href="javascript:void(0)" class="closebtn" onclick="closeNav()"></li>
      <li class="mobNav"><a id="logo" href="/index.html" class="mobNav">Jan Koster</a></li>
      <li class="mobNav"><a class="mobNav" id="" href="/boeken.html">Boeken</a></li>
      <li class="mobNav"><a class="mobNav" id="" href="/fotos.html">Series</a></li>
      <li class="mobNav"><a class="mobNav" id="active" href="/info.html">Info</a></li>
    </ul>
-->

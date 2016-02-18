<!DOCTYPE html>
<html>
<head>
<title>HTML5 App Demo</title>

<!-- This is the key CDN to pull jQuery from -->
<!-- To operate offline we may want these to load from a local source -->
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>

<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Prevent users from zooming the site. -->
<meta name="viewport" content="user-scalable=no, width=device-width" />


<!-- Load local libraries here -->
<script src='js/lib/vfs-lib.js'></script>
<script src="js/lib/buzz.min.js"></script>
<script src="js/lib/bootstrap.min.js"></script>

<!-- Custom Style -->
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">

<link
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
	rel="stylesheet">

<!-- Local styles -->
<style type='text/css'>
</style>
</head>

<!-- The Structure of your app is here - Box model blocks of area -->
<body>

	<div class="container" id="app">
		<div class="header clearfix">
			<nav class="navbar navbar-default" style="margin-bottom:0">
				<div class="container-fluid">
					<div class="navbar-header">
<!-- 					<button type="button" id="left-handler" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> -->
<!-- 				        <span class="sr-only">Toggle navigation</span> -->
<!-- 				        <span class="icon-bar"></span> -->
<!-- 				        <span class="icon-bar"></span> -->
<!-- 						<span class="icon-bar"></span> -->
<!-- 				     </button> -->
						<a class="navbar-brand">Music Player</a>
<!-- 				   		<div class="share-ios navbar-right">Share</div> -->
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<!-- 						<ul class="nav navbar-nav"> -->
<!-- 					        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
<!-- 				    	    <li><a href="#">Link</a></li> -->
<!-- 				   		</ul> -->
				    </div>
	<!-- 					<form class="navbar-form navbar-right" role="search"> -->
	<!-- 						<div class="form-group"> -->
	<!-- 							<input type="text" class="form-control" placeholder="Search"> -->
	<!-- 						</div> -->
	<!-- 						<button type="submit" class="btn btn-default">Search</button> -->
	<!-- 					</form> -->
				</div>
			</nav>
		</div>
	
		<div class="song-area">
<!-- 			<div class="song-image"></div> -->
			
		 	<div class="song-title"></div>
			<div class="volume">
				<i class="fa fa-volume-off fa-3x" id="off"></i>
				<i class="fa fa-volume-up fa-3x" id="on"></i>
			</div>
		</div>
		
		

		<div class="progress">
			<div class="progress-bar progress-bar-success" role="progressbar"
				aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
				style="width: 0%"></div>
		</div>

		<div class="controlls-area bs-component">
			<div class="controlls" id="previous">
				<i class="fa fa-step-backward fa-2x"></i>
			</div>
			<div class="controlls" id="rewind">
				<i class="fa fa-backward fa-2x"></i>
			</div>
			<div class="controlls" id="togglePlay">
				<i id="playicon" class="fa fa-play fa-3x"></i> <i id="pauseicon"
					class="fa fa-pause fa-3x"></i>
			</div>
			<div class="controlls" id="forward">
				<i class="fa fa-forward fa-2x"></i>
			</div>
			<div class="controlls" id="next">
				<i class="fa fa-step-forward fa-2x"></i>
			</div>
		</div>
		
<!-- 		<div class="panel-group playlist" role="tablist"> -->
<!-- 		    <div class="panel panel-primary"> -->
<!-- 		    	<a class="panel-heading" role="tab" data-toggle="collapse" href="#collapseUserPlaylist" aria-expanded="false" aria-controls="collapseUserPlaylist"> -->
<!-- 					<h5 class="panel-title">My Playlist</h5> -->
<!-- 				</a> -->
<!--       			<div id="collapseUserPlaylist" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseUserPlaylist" aria-expanded="false"> -->
<!--         			<div class="songs-list"> -->
<!-- 	        			<ul class="list-group" id="userPlaylist"> -->
<!-- 						You haven't add songs on your playlist ): --> 
<!-- 	        			</ul> -->
<!-- 					</div>	 -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 		</div> -->
		
		<div class="panel-group playlist" role="tablist">
		    <div class="panel panel-default">
		   		<a class="panel-heading" role="tab" data-toggle="collapse" href="#collapseServerPlaylist" aria-expanded="true" aria-controls="collapseServerPlaylist">
					<h4 class="panel-title">Music</h4>
				</a>
	    		<div id="collapseServerPlaylist" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseServerPlaylist" aria-expanded="true">
	       			<div class="songs-list">
	       				<ul class="list-group" id="serverPlaylist" onclick="click()">
							<!-- List added via Javascript  -->
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


	<footer class="footer">
		<p>© Media Player pg02maria VFS 2014</p>
	</footer>

	<script src="js/App.js"></script>
	<script src="js/NavigationHandler.js"></script>
	
	
	<script language="javascript">

		var handler = new NavigationHandler();
		    
		$(document).ready( function() {
			handler.init();
		});
	
	</script>
</body>
</html>
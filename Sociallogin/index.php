<?php
	session_start();
	
	if(!isset($_SESSION['userID'])){
		header('Location : login.php');
		exit();
	}
?>
<html>
	<head>
		<title>Members Dashboard</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
			<script>
				window.fbAsyncInit = function() {
				FB.init({
					appId            : '2163191903785594',
					autoLogAppEvents : true,
					xfbml            : true,
					version          : 'v4.0'
				});
				};
		
				(function(d, s, id){
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) {return;}
						js = d.createElement(s); js.id = id;
						js.src = "https://connect.facebook.net/en_US/sdk.js";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
					function uploadPhoto(){
						FB.api('/me/photos' , 'post' , {source:'https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-1/p240x240/69622898_887404484966014_1594356014201700352_n.jpg?_nc_cat=102&_nc_oc=AQmVySK7paPQIbuZHEFi9cR4CUj1yTmtOJmDv87AgvXs4t_8r1MAfgtq1FtXWvkT_DA&_nc_ht=scontent.fcmb3-1.fna&oh=dd3861d4862cc51bc53a1b4118499337&oe=5DF0EB4F'},
						function(response){
							if(!response || response.error){
								console.log(response.error);
							}else{
								console.log('Uploaded');
							}
						}
					);
				}
			</script>
			<div class="container" style="margin-top:100px">
			<div class="row justify-content-center">
				<div class="col-md-3" align="center">
					<img src="<?php echo $_SESSION['picture']; ?>">
				</div>
				<div class="col-md-9">
					userID: <?php echo $_SESSION['userID']; ?><br>
					name: <?php echo $_SESSION['name']; ?><br>
					email: <?php echo $_SESSION['email']; ?><br>
					<input type="submit" onclick="uploadPhoto()" value="Upload photos and videos">
				</div>
			</div>
		</div>
	</body>
</html>
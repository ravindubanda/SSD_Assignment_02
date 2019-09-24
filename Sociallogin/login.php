<?php
	session_start();
	
	if(isset($_POST['userID'])){
		$_SESSION['userID'] = $_POST['userID'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['picture'] = $_POST['picture'];
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['accessToken'] = $_POST['accessToken'];
		
		exit('success');
	}
?>
<html>
	<head>
		<title>Social Login</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<div class="container" style="margin-top:100px">
			<div class="row justify-content-center">
				<div class="col-md-6 col-offset-3" align="center">
					<form>
						<input class="form-control" placeholder="Email">
						<input class="form-control" placeholder="password">
						<input type="submit" value="Log in" onclick="uploadPhoto()">
						<input type="button" onclick="login()" value="Log in with facebook">
					</form>
				</div>
			</div>
		</div>
		<script
			src="https://code.jquery.com/jquery-3.4.1.min.js"
			integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			crossorigin="anonymous"></script>
		<script>
		var person = {userID:"" , name:"" , accessToken:"" , picture:"" , email:""};
		
		function login(){
			FB.login(function(response){
				if(response.status == "connected"){
					person.userID = response.authResponse.userID;
					person.accessToken = response.authResponse.accessToken;
					FB.api('/me?fields=id,name,email,birthday,picture.type(large)',function(userData){
						console.log(userData);
						person.name = userData.name;
						person.email = userData.email;
						person.picture = userData.picture.data.url;
						console.log(person.name,person.email,person.picture);
						$.ajax({
							url:"login.php",
							method:"POST",
							data:person,
							dataType:'text',
							success: function(serverResponse){
								if(serverResponse == "success")
									window.location = "index.php"
							}

						});
					})
				}
			}, {scope:'public_profile , email'} )
		}
		
		function uploadPhoto(){
			FB.api('/me/photos' , 'post' , {source:'https://scontent.fcmb3-1.fna.fbcdn.net/v/t1.0-1/p240x240/69622898_887404484966014_1594356014201700352_n.jpg?_nc_cat=102&_nc_oc=AQmVySK7paPQIbuZHEFi9cR4CUj1yTmtOJmDv87AgvXs4t_8r1MAfgtq1FtXWvkT_DA&_nc_ht=scontent.fcmb3-1.fna&oh=dd3861d4862cc51bc53a1b4118499337&oe=5DF0EB4F'},
				function(response){
					if(!response || response.error){
						
					}else{
						
					}
				}
			);
		}
		
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
	</script>
	</body>
</html>
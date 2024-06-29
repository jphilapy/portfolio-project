<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

	<script src="https://accounts.google.com/gsi/client" async></script>
</head>
<body>



	<div id="g_id_onload"
		 data-client_id="google id here"
		 data-context="signin"
		 data-ux_mode="popup"
		 data-callback="myCallBack"
		 data-auto_prompt="false">
	</div>

	<div class="g_id_signin"
		 data-type="standard"
		 data-shape="rectangular"
		 data-theme="outline"
		 data-text="signin_with"
		 data-size="large"
		 data-logo_alignment="left">
	</div>
	<script>
		function myCallBack() {
			alert('hello');
		}
	</script>

</body>
</html>

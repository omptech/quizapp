<!DOCTYPE html>
<html>
<head>
	<title>Email Verification</title>
</head>
<body>
<h1>{{env('APP_NAME', 'QuizApp')}}</h1>
<h3>Email Verification</h3>
<p>You are already there!</p>
<p>Please Copy the code below to verify your account & complete registration</p>
<p>Verification Code : <span style="font-weight: bold;">{{$code}}</span></p>
<p>Thanks for using our Application</p>
<p>Best Regards!</p>
</body>
</html>
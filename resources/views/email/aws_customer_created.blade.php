<!DOCTYPE html>
<html>

<head>
				<title>{{ env('APP_NAME') }}</title>
</head>

<body>
				<p>Dear Sir/Madam,

								Welcome to {{ env('APP_NAME') }}! We're thrilled to have you on board and excited for the journey ahead.
								Thank you for choosing our platform to manage your documents.<br><br>

								Here are a few steps to help you get started with {{ env('APP_NAME') }}: <br><br>

								Login to Your Account: Head over to our website https://digitaldocscloud.com/login and log in to your account
								using the credentials you provided during sign-up. <br><br>

								Explore Your Dashboard: Once logged in, you'll find yourself in your personalized dashboard. Take some time to
								explore the features and functionalities available to you.<br><br>

								Support and Assistance: Should you have any questions, encounter any issues, or simply need assistance, don't
								hesitate to reach out to our support team via email. We're here to help you succeed. <br><br>

								We're committed to providing you with an exceptional experience, and we're confident that {{ env('APP_NAME') }}
								will empower you to manage, retrieve, and store your documents. <br><br>

								Once again, welcome aboard! We look forward to seeing your success with {{ env('APP_NAME') }}. <br><br>

								Here is your password: <b>{{ $password }}</b> <br><br>

								Best Regards, <br><br>

								Support team at {{ env('APP_NAME') }}</p>
</body>

</html>

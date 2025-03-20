<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Hello, {{ $payload->user->name }}!</h1>
    <p>You are getting this mail because you requested for a password reset.</p>
    <p>Your account has been updated successfully.</p>
    <p>Here is your login information:</p>
    <p>Your password is: {{ $payload->password }}</p>
    <p>Make sure to keep it safe and secure.</p>
    <p>With the Parcel Management System, you can easily manage your parcels and track their status.</p>
    <p>Click below to visit the system and start exploring:</p>
    <a href="{{ url('/') }}" style="background-color: #3490dc; padding: 10px 15px; color: white; text-decoration: none; border-radius: 5px;">
        Parcel Management System
    </a>
    <p>If you have any questions, don’t hesitate to reach out!</p>
    <p>— The Team</p>
</body>
</html>
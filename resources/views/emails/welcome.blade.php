<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}!</h1>
    <p>We are really happy to have you on board.</p>
    <p>Your account has been created successfully.</p>
    <p>Here is your login information:</p>
    <p>Your email is: {{ $user->email }}</p>
    <p>Your staff code is: {{ $user->staff_code }}</p>
    <p>Your password is: {{ $password }}</p>
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
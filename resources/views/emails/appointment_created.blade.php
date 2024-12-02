<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
</head>
<body>
    <h1>Appointment Confirmation</h1>
    <p>Dear {{ $appointment['first_name'] }} {{ $appointment['last_name'] }},</p>
    <p>Thank you for scheduling an appointment. Below are the details:</p>
    <ul>
        <li><strong>Address:</strong> {{ $appointment['address'] }}</li>
        <li><strong>Mobile Number:</strong> {{ $appointment['mobile_num'] }}</li>
        <li><strong>Email:</strong> {{ $appointment['email'] }}</li>
        <li><strong>Reason:</strong> {{ $appointment['reasons'] }}</li>
        <li><strong>Date:</strong> {{ $appointment['date'] }}</li>
        <li><strong>Time:</strong> {{ $appointment['time'] }}</li>
    </ul>
    <p>We look forward to serving you.</p>
</body>
</html>

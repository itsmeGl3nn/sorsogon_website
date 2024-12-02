<!DOCTYPE html>
<html>
<head>
    <title>New Complaint Received</title>
</head>
<body>
    <h1>Complaint Details</h1>
    <p><strong>Name:</strong> {{ $complaint['first_name'] }} {{ $complaint['last_name'] }}</p>
    <p><strong>Address:</strong> {{ $complaint['address'] }}</p>
    <p><strong>Complaint:</strong> {{ $complaint['complaint'] }}</p>
    <p><strong>Mobile Number:</strong> {{ $complaint['mobile_num'] }}</p>
    <p><strong>Email:</strong> {{ $complaint['email'] }}</p>
    {{-- <p><strong>Proof Image:</strong> <a href="{{ asset('storage/' . $complaint['proof']) }}">View Proof</a></p> --}}


    <h1>Complaint Received</h1>
    <p>Thank you for your complaint. Our team will review it and get back to you shortly.</p>
</body>
</html>

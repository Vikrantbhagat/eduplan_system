<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body>
    <h2>New Contact Form Submission</h2>
    <p><strong>Full Name:</strong> {{ $contactData['name'] }}</p>
    <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
    <p><strong>Phone:</strong> {{ $contactData['phone'] }}</p>
    <p><strong>Subject:</strong> {{ $contactData['subject'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $contactData['message'] }}</p>
</body>
</html>

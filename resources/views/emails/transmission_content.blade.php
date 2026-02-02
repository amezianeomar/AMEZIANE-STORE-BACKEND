<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Transmission</title>
</head>
<body style="background-color: #0f172a; color: #fff; font-family: sans-serif; padding: 20px;">
    <h2 style="color: #00f3ff;">NOUVELLE TRANSMISSION ENTRANTE</h2>
    <p><strong>Source (Email) :</strong> {{ $data['email'] }}</p>
    <p><strong>Sujet :</strong> {{ $data['subject'] }}</p>
    <hr style="border: 1px solid #bc13fe;">
    <p><strong>Payload (Message) :</strong></p>
    <div style="background-color: #1e293b; padding: 15px; border-left: 4px solid #bc13fe;">
        {{ $data['message'] }}
    </div>
</body>
</html>
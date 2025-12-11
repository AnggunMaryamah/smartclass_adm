<!DOCTYPE html>
<html>

<body style="font-family:Arial,Helvetica,sans-serif;color:#111">
    <h3>Pesan Baru dari Form Kontak SmartClass</h3>

    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    @if (!empty($data['phone']))
        <p><strong>Telepon:</strong> {{ $data['phone'] }}</p>
    @endif
    @if (!empty($data['subject']))
        <p><strong>Subjek:</strong> {{ $data['subject'] }}</p>
    @endif

    <p><strong>Pesan:</strong></p>
    <p style="white-space:pre-line">{{ $data['message'] }}</p>

    <hr>
    <p>— SmartClass</p>
</body>

</html>
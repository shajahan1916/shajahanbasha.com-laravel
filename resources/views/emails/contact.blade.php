<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"><title>{{ $data['intent'] }}</title></head>
<body style="margin:0;padding:24px;background:#f4f5fa;font-family:-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;color:#1c2033">
    <div style="max-width:560px;margin:0 auto;background:#fff;border-radius:14px;padding:28px;border:1px solid #e4e6f0">
        <p style="margin:0 0 4px;font-size:12px;letter-spacing:.16em;text-transform:uppercase;color:#8a91ad">
            New enquiry from your website
        </p>
        <h1 style="margin:0 0 20px;font-size:20px">{{ $data['intent'] }}</h1>

        <table style="width:100%;border-collapse:collapse;font-size:14px">
            <tr>
                <td style="padding:8px 0;color:#8a91ad;width:90px">Name</td>
                <td style="padding:8px 0">{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td style="padding:8px 0;color:#8a91ad">Email</td>
                <td style="padding:8px 0"><a href="mailto:{{ $data['email'] }}" style="color:#e2571b">{{ $data['email'] }}</a></td>
            </tr>
        </table>

        <div style="margin-top:18px;padding:16px;background:#f7f8fc;border-radius:10px;border:1px solid #e8eaf4">
            <p style="margin:0;white-space:pre-wrap;font-size:15px;line-height:1.6">{{ $data['message'] }}</p>
        </div>

        <p style="margin:20px 0 0;font-size:12px;color:#9aa0b8">
            Reply directly to this email to answer {{ $data['name'] }}.
        </p>
    </div>
</body>
</html>

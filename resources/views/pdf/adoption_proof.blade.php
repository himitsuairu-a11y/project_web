<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Surat Adopsi - {{ $adoption->cat->name }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #ea580c; /* brand-600 */
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #ea580c;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 14px;
        }
        .content {
            margin: 0 20px;
        }
        .section-title {
            font-size: 18px;
            color: #0f172a;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th {
            text-align: left;
            width: 35%;
            color: #64748b;
            font-weight: normal;
            padding: 8px 0;
        }
        .info-table td {
            font-weight: bold;
            color: #1e293b;
            padding: 8px 0;
        }
        .pickup-box {
            background-color: #fff7ed;
            border: 1px solid #fed7aa;
            border-left: 4px solid #f97316;
            padding: 15px;
            margin-top: 30px;
        }
        .pickup-box h3 {
            margin-top: 0;
            color: #c2410c;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
        }
        .signature-area {
            margin-top: 50px;
            width: 100%;
        }
        .signature-box {
            float: right;
            width: 250px;
            text-align: center;
        }
        .signature-line {
            border-bottom: 1px solid #333;
            margin-top: 60px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>PAWS & HEARTS</h1>
        <p>Sertifikat Bukti Adopsi Hewan Resmi</p>
    </div>

    <div class="content">
        <p>Surat ini menyatakan bahwa pengajuan adopsi untuk hewan di bawah ini telah disetujui. Surat ini berfungsi sebagai bukti pengambilan yang sah.</p>

        <h2 class="section-title">Data Adopter</h2>
        <table class="info-table">
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $adoption->applicant_name }}</td>
            </tr>
            <tr>
                <th>Alamat Domisili</th>
                <td>{{ $adoption->applicant_address }}</td>
            </tr>
            <tr>
                <th>Tanggal Pengajuan</th>
                <td>{{ $adoption->created_at->format('d F Y') }}</td>
            </tr>
        </table>

        <h2 class="section-title">Data Kucing</h2>
        <table class="info-table">
            <tr>
                <th>Nama Kucing</th>
                <td>{{ $adoption->cat->name }}</td>
            </tr>
            <tr>
                <th>Ras</th>
                <td>{{ $adoption->cat->breed }}</td>
            </tr>
            <tr>
                <th>Umur</th>
                <td>{{ $adoption->cat->age_in_months }} Bulan</td>
            </tr>
            <tr>
                <th>Status Kucing Saat Ini</th>
                <td>Telah Diadopsi</td>
            </tr>
        </table>

        <div class="pickup-box">
            <h3>Jadwal Pengambilan</h3>
            <p>Silakan datang ke shelter kami dengan membawa <strong>KTP Asli</strong> Anda pada:</p>
            <table class="info-table" style="margin-bottom: 0;">
                <tr>
                    <th>Waktu Pengambilan</th>
                    <td style="color: #ea580c; font-size: 16px;">{{ $adoption->pickup_datetime ? \Carbon\Carbon::parse($adoption->pickup_datetime)->format('d F Y, H:i') : 'Belum Ditentukan' }}</td>
                </tr>
            </table>
        </div>

        <div class="signature-area">
            <div class="signature-box">
                <p>Paws & Hearts Admin</p>
                <div class="signature-line"></div>
                <p style="font-size: 12px; margin-top:0;">Tanda Tangan & Cap Shelter</p>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    <div class="footer">
        <p>Sertifikat ini diterbitkan secara otomatis oleh Sistem Paws & Hearts pada {{ now()->format('d M Y H:i') }}.<br>Harap simpan dokumen ini dengan baik.</p>
    </div>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Peminjaman #{{ $loan->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table td { padding: 8px; border-bottom: 1px solid #ddd; }
        table td:first-child { font-weight: bold; width: 180px; }
        .status { display: inline-block; padding: 3px 10px; border-radius: 10px; font-size: 11px; }
        .footer { margin-top: 40px; display: flex; justify-content: space-between; }
        .signature { text-align: center; width: 200px; }
        .signature .line { margin-top: 60px; border-top: 1px solid #333; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Bukti Peminjaman Aset</h2>
        <p>{{ config('app.name') }}</p>
    </div>

    <table>
        <tr>
            <td>No. Peminjaman</td>
            <td>#{{ $loan->id }}</td>
        </tr>
        <tr>
            <td>Nama Peminjam</td>
            <td>{{ $loan->user->name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $loan->user->email }}</td>
        </tr>
        <tr>
            <td>Nama Aset</td>
            <td>{{ $loan->asset->nama_aset }}</td>
        </tr>
        <tr>
            <td>Kode Aset</td>
            <td>{{ $loan->asset->kode_aset }}</td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td>{{ $loan->asset->category->nama_kategori }}</td>
        </tr>
        <tr>
            <td>Tanggal Pinjam</td>
            <td>{{ $loan->tanggal_pinjam }}</td>
        </tr>
        <tr>
            <td>Tanggal Kembali (Rencana)</td>
            <td>{{ $loan->tanggal_kembali_rencana }}</td>
        </tr>
        <tr>
            <td>Tanggal Kembali (Aktual)</td>
            <td>{{ $loan->tanggal_kembali_aktual ?? '-' }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>{{ ucfirst($loan->status) }}</td>
        </tr>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Peminjam</p>
            <div class="line"></div>
            <p>{{ $loan->user->name }}</p>
        </div>
        <div class="signature">
            <p>Mengetahui,</p>
            <div class="line"></div>
            <p>Admin</p>
        </div>
    </div>
</body>
</html>
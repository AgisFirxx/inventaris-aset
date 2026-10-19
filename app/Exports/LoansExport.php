<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoansExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Loan::with(['user', 'asset'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Peminjam',
            'Aset',
            'Tanggal Pinjam',
            'Tanggal Kembali (Rencana)',
            'Tanggal Kembali (Aktual)',
            'Status',
        ];
    }

    public function map($loan): array
    {
        return [
            $loan->user->name,
            $loan->asset->nama_aset,
            $loan->tanggal_pinjam,
            $loan->tanggal_kembali_rencana,
            $loan->tanggal_kembali_aktual ?? '-',
            $loan->status,
        ];
    }
}
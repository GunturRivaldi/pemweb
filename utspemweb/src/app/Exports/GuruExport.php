<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Guru::select('nama', 'nip', 'jenis_kelamin', 'alamat', 'created_at')
            ->get()
            ->map(function ($item) {
                if ($item->created_at) {
                    $item->tanggal_dibuat = $item->created_at->format('d-m-Y');
                    $item->jam_dibuat = $item->created_at->format('H:i:s');
                } else {
                    $item->tanggal_dibuat = '-';
                    $item->jam_dibuat = '-';
                }
                unset($item->created_at);
                return $item;
            });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIP',
            'Jenis Kelamin',
            'Alamat',
            'Tanggal Dibuat',
            'Jam Dibuat',
        ];
    }
}

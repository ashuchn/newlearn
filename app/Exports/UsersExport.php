<?php

namespace App\Exports;

use DB;
use App\Models\User;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, Responsable, ShouldAutoSize, WithStyles
{

    use Exportable;

    /**
     * required
     * name of the exported file
     */
    private $fileName = "users.xlsx";

    /**
     * optional
     * headers
     */
    private $headers = [
        'Content-Type' => 'application/vnd.ms-excel'
    ];

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'role',
            'name',
            'email',
            'mobile',
            'gender',
            'date of birth',
            'joined on',
            'city',
            'state',
        ];
    }

    public function collection()
    {
        $data = DB::select(
            DB::raw(
                'SELECT u.id,u.role_id,u.name as username ,u.email,u.mobile,u.gender,u.date_of_birth,u.created_at,u.city,s.name FROM `users` as u 
                left join states as s on s.id = u.state_id
                where u.role_id != 1'
                )
            );

        $users = collect($data)->map(function($user) {
            $user->gender = $user->gender == 1 ? "Male" : "Female";
            return $user;
        });
        return $users;
    }
}
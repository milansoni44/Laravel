<?php

namespace App\Exports;

use App\Role;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RolesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function headings(): array {
        return [
            "Name","Role","Created At"
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
//        return User::get_users();
        $role_data = Role::all();
        $role_array = [];
        foreach($role_data as $role)
        {
            $role_array[] = array(
                'Name'  => $role->name,
                'Description'   => $role->description,
                'Created At'  => $role->created_at
            );
        }
        return collect($role_array);    // collect method is used to make collection object from array
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:C1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    //Set border Style
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'EB2B02'],
                        ],

                    ],
                    //Set font style
                    'font'=>[
                        'name'=>  'Calibri',
                        'bold'=>true,
                        'size'=>12
                    ],
                    //Set background style
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'dff0d8',
                        ]
                    ],
                ]);
            },
        ];
    }
}

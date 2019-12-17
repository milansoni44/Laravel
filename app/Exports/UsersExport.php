<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    public function headings(): array {
        return [
            "Name","Email","Role","Created At"
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        return User::get_users();
        $customer_data = User::get_users();
        $customer_array = [];
        foreach($customer_data as $customer)
        {
            $customer_array[] = array(
                'Name'  => $customer->name,
                'Email'   => $customer->email,
                'Role'    => $customer->role_name,
                'Created At'  => $customer->created_at
            );
        }
        return collect($customer_array);    // collect method is used to make collection object from array
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:D1'; // All headers
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

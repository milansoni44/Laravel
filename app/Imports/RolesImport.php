<?php

namespace App\Imports;

use App\Role;
use Maatwebsite\Excel\Concerns\FromCollection;

class RolesImport implements FromCollection
{
    public function collection()
    {
        return Role::all();
    }
}

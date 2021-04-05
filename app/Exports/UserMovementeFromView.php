<?php

namespace App\Exports;

use App\Models\UserMovement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserMovementeFromView implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return UserMovement::all();
    }*/

    public function view(): View
    {
        return view('exports.movementationsTable', [
            'movements' => UserMovement::all()
        ]);
    }
}

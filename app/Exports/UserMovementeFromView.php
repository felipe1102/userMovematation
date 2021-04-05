<?php

namespace App\Exports;

use App\Models\UserMovement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserMovementeFromView implements FromView
{
    private $filter;
    public function __construct($filter) {
        $this->filter = $filter;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return UserMovement::all();
    }*/

    public function view(): View
    {
        $data = $this->getMovementFilter($this->filter);

        return view('exports.movementationsTable', [
            'movements' => $data,
            'user'=> Auth::user()
        ]);
    }

    public function getMovementFilter($filter){
        $movement = UserMovement::where("id_user", Auth::user()->id);
        if (is_numeric($filter)){
            $movement = $movement->where( 'created_at', '>', Carbon::now()->subDays(30));
        }
        if (strpos( $filter, "/" )){
            $dataArray = explode("/", $filter);
            $movement = $movement->whereYear('created_at','20'.$dataArray[1]);
            $movement = $movement->whereMonth('created_at',$dataArray[0]);
        }
        return $movement->get();
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserMovement;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric',
            'type' => 'required|in:debit,credit',
        ]);
        if($validator->fails()) {
            return response()->json([
                'message'   => $validator->errors()->first(),
                'errors'    => 'Dados invalidos'
            ], 400);
        }

        DB::beginTransaction();
        try {

            $movement = Auth::user()->movement()->create([
                "value" => $request->value,
                "type" => $request->type,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'Movimento cadastrado com sucesso',
                'data' => $movement
            ], 201);
        }catch (\Exception $error) {
            DB::rollBack();
            return response()->json([
                'message' => $error->getMessage(),
                'errors'    => 'Ocorreu algum problema'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $movement  = UserMovement::find($id);

        if (!$movement){
            return response()->json([
                'message'   => 'Nenhum registro Encontrado',
            ], 404);
        }
        DB::beginTransaction();
        try{
            $movement->update(['reversed' => 1 ]);

            DB::commit();
            return response()->json([
                'message' => 'Movimento estornado com sucesso',
                'data' => $movement
            ], 201);
        }catch (\Exception $error) {
            DB::rollBack();
            return response()->json([
                'message' => $error->getMessage(),
                'errors'    => 'Ocorreu algum problema'
            ], 500);
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movement = Auth::user()->movement()->where('id', $id)->first();
        if (!$movement){
            return response()->json([
                'message'   => 'Nenhum registro Encontrado',
            ], 404);
        }
        DB::beginTransaction();
        try{
            $result = $movement->delete();
            DB::commit();
            return response()->json([
                'message' => 'Movimentação deletada',
            ], 201);
        }catch (\Exception $error) {
            DB::rollBack();
            return response()->json([
                'message' => $error->getMessage(),
                'errors'    => 'Ocorreu algum problema'
            ], 500);
        }
    }
}

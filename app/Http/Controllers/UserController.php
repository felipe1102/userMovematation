<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();

        if ($users->isEmpty()){
            return response()->json([
                'message'   => 'Nenhum registro Encontrado',
            ], 404);
        }

        return response()->json([
            'message' => 'Usuários cadastrados',
            'data' => $users
        ], 200);
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'birthday' => 'required|date',
            'password' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'message'   => $validator->errors()->first(),
                'errors'    => 'Dados invalidos'
            ], 400);
        }

        DB::beginTransaction();
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->birthday = $request->birthday;
            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();
            return response()->json([
                'message' => 'Usuário cadastrado',
                'data' => $user
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
        $user = User::find($id);

        if(!$user) {
            return response()->json([
                'message'   => 'Nenhum registro Encontrado',
            ], 404);
        }

        return response()->json([
            'message' => 'Usuário encontrado',
            'data' => $user
        ], 200);

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
        $user = User::find($id);

        if (!$user){
            return response()->json([
                'message'   => "Usuário não encontrado"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => "unique:users,email,$id,id",
            'birthday' => 'required|date'
        ]);
        if($validator->fails()) {
            return response()->json([
                'message'   => $validator->errors()->all(),
                'errors'    => 'Dados invalidos'
            ], 400);
        }

        DB::beginTransaction();
        try{
            $user->update($request->all());
            DB::commit();
            return response()->json([
                'message' => 'Usuário Editado',
                'data' => $user
            ], 200);
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
        $user = User::find($id);

        if (!$user){
            return response()->json([
                'message'   => "Usuário não encontrado"
            ], 404);
        }

        if (!$user->movement->isEmpty()){
            return response()->json([
                'message'   => "Este usuário não pode ser deletado, pois contem movimentações em seu registro"
            ], 400);
        }

        DB::beginTransaction();
        try{
            $user->delete();
            DB::commit();
            return response()->json([
                'message' => 'Usuário do id '.$id.' deletado',
            ], 200);
        }catch (\Exception $error) {
            DB::rollBack();
            return response()->json([
                'message' => $error->getMessage(),
                'errors'    => 'Ocorreu algum problema'
            ], 500);
        }

    }

    public function changeBalance(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                'message'   => $validator->errors()->first(),
                'errors'    => 'Dados invalidos'
            ], 400);
        }

        $user = User::find($id);
        if (!$user){
            return response()->json([
                'message'   => 'Usuário não encontrado',
            ], 404);
        }

        DB::beginTransaction();
        try {
            $user->update(['opening_balance' => $request->value]);
            DB::commit();
            return response()->json([
                'message' => 'Saldo inserido com sucesso',
                'data' => $user
            ], 201);
        }catch (\Exception $error) {
            DB::rollBack();
            return response()->json([
                'message' => $error->getMessage(),
                'errors'    => 'Ocorreu algum problema'
            ], 500);
        }
    }

    public function report(){
        $debit = UserMovement::where("id_user", Auth::user()->id)->where("type", "debit")->where("reversed", 0)->sum('value');
        $credit = UserMovement::where("id_user", Auth::user()->id)->where("type", "credit")->where("reversed", 0)->sum('value');
        $reversed = UserMovement::where("id_user", Auth::user()->id)->where("reversed", 0)->sum('value');
        $openingBalanceUser = Auth::user()->opening_balance;

        return response()->json([
            'data' => [
                "debit" => $debit,
                "credit" => $credit,
                "reversed" => $reversed,
                "openingBalanceUser" => $openingBalanceUser
            ]
        ], 201);
    }
}

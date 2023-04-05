<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(title="API Kiibo Prueba - Jair Quinto - tokinmym2@gmail.com", version="1.0")
 *
 * @OA\Server(url="http://127.0.0.1:8000")
 */

class UserController extends Controller
{






    public function index()
    {
        $usuarios = User::where('rol', 0)->get();

        return view('admin.Usuarios.index', compact('usuarios'));
    }



    public function registerUsuarios(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {

            Session::flash('mensaje', $validator->errors());
            Session::flash('class', 'danger');
            return back();
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);


        Session::flash('mensaje', 'Registro creado con exito!');
        Session::flash('class', 'success');
        return back();
    }



    public function updateUsuarios(Request $request)
    {
        $id         = request()->id;
        $validator  =   $request->validate(
            [
                'email' => 'required|email|unique:users,email,' . $id,
            ],
            [

                Session::flash('mensaje', 'Hubó un error, por favor, verifica la información.'),
                Session::flash('class', 'danger'),
            ]
        );


        $user               = User::findOrFail($id);
        $user->name         = request()->name;
        $user->email        = request()->email;

        if (request()->password != null) {
            $user->password        = bcrypt($request->password);
        }
        $user->save();

        Session::flash('mensaje', 'Registro Exitoso, Usuario Editado');
        Session::flash('class', 'success');
        return back();
    }

    public function destroyUsuario(Request $request)
    {

        $id   = request()->id;
        User::find($id)->delete();
        Session::flash('mensaje', 'Registro eliminado con exito!');
        Session::flash('class', 'success');
        return back();
    }








}

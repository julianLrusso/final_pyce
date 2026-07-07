<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    /**
     * Muestra un listado de usuarios
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function adminIndex()
    {
        $users = User::get();
        return view('users.admin.index', ['users' => $users]);
    }

    /**
     * Muestra un listado de usuarios
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(int $id)
    {
        $user = User::with(['purchases' => function ($query) {
            $query->where('status', 1);
        }])->findOrFail($id);
        // $user = User::withWhereHas('purchases', function ($query) {
        //     $query->where('status', 1);
        // })->find($id);
        return view('users.index', ['user' => $user]);
    }

    /**
     * Muestra en detalle un usuario
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id);
        $purchases = Purchase::where('user_id', $id)->with('games')->get();
        return view('users.admin.show', ['user' => $user, 'purchases' => $purchases]);
    }

    /**
     * Muestra la página para eliminar el usuario
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        return view('users.admin.delete', ['user' => $user]);
    }

    /**
     * Elimina un usuario de la base de datos
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('feedback.message', 'Se eliminó el usuario <b>' . e($user->name) . '</b> con éxito.');
    }

    public function changePassword(Request $request){

        $request->validate(User::CHANGE_PASSWORD_VALIDATION, User::CHANGE_PASSWORD_MESSEGES);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'old_password' => 'La contraseña actual no es correcta.',
            ]);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        auth()->logout();

        return redirect()->route('auth.showLogin')->with('feedback.message', 'Contraseña cambiada con éxito.');
    }
}

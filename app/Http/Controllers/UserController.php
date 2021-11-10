<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use App\User;
use App\UserDate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();

        foreach ($users as $aux) {
            $aux->edad = \Carbon\Carbon::parse($aux->userDate->birthday_date)->age;
        }

        $role = $this->getRoleUserLogguedIn();

        return view('users.users')
                ->with('role', $role)
                ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = $this->getRoleUserLogguedIn();
        $id = User::latest('id')->first()->id + 1;
        $roles = Role::all()->reverse();

        return view('users.create')
                ->with('id', $id)
                ->with('role', $role)
                ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // reglas de validación
        $rules = [
            'role' => 'required|string|exists:roles,name',
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'min:6', 'regex:/^.*(?=.{6,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'confirmed'],
            'password_confirmation' => 'required|same:password',
            'ci' => 'required|string|max:11',
            'cellphone' => 'integer|nullable',
            'date' => 'required|date',
            'code' => 'required|integer',
        ];

        // mensajes personalizados
        $customMessages = [
            'password.regex' => 'Dato obligatorio, mínimo de 8 caracteres, debe contener al menos un número,
            una letra mayúscula, un carácter especial (!,$,#,%)',
        ];

        // validación
        $validatedData = $request->validate($rules, $customMessages);

        // Validar que sea mayor de edad
        if (\Carbon\Carbon::parse($request->input('date'))->age < 18) {
            return back()->with('danger', 'El usuario a registrar tiene que ser mayor de edad (18 años)');
        }

        // crear el usuario en la tabla users
        $new_user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'email_verified_at' => now(),
            //encriptamos la contraseña
            'password' => bcrypt($request->input('password')),
            'remember_token' => Str::random(10),
        ]);

        // crear el usuario en la tabla user_dates siguiendo la relación
        $new_user->userDate()->create([
            'nro_ci' => $request->input('ci'),
            'birthday_date' => $request->input('date'),
            'city_code' => $request->input('code'),
        ]);

        // validamos que existan los datos que pueden llegar nulos
        if ($request->input('cellphone')) {
            $new_user->userDate->update([
                'cellphone' => $request->input('cellphone'),
            ]);
        }

        // asignar el rol seleccionado
        $new_user->assignRole($request->input('role'));

        //cambiar para cumplir con los requisitos
        $new_user->country()->attach(1);

        return redirect('users')->with('success', 'Datos guardados con éxito');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Validamos que el usuario seleccionado exista
        if (!User::find($id)->exists()) {
            return back()->with('danger', 'El usuario seleccionado no existe');
        }

        // buscamos el usuario
        $user = User::find($id);
        $user->rol = $this->getRoleUser($user->id);

        $role = $this->getRoleUserLogguedIn();
        $roles = Role::all()->reverse();
        
        return view('users.edit')
                ->with('role', $role)
                ->with('roles', $roles)
                ->with('user', $user);
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
        // Validamos que el usuario seleccionado exista
        if (!User::find($id)->exists()) {
            return back()->with('danger', 'El usuario seleccionado no existe');
        }

        // reglas de validación
        $rules = [
            'role' => 'required|string|exists:roles,name',
            'name' => 'required|string|max:100',
            'password' => ['nullable', 'min:6', 'regex:/^.*(?=.{6,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'confirmed'],
            'password_confirmation' => 'nullable|same:password',
            'cellphone' => 'nullable|integer',
            'date' => 'required|date',
            'code' => 'required|integer',
        ];

        // mensajes personalizados
        $customMessages = [
            'password.regex' => 'Dato obligatorio, mínimo de 8 caracteres, debe contener al menos un número,
            una letra mayúscula, un carácter especial (!,$,#,%)',
        ];

        // validación
        $validatedData = $request->validate($rules, $customMessages);

        // Validar que sea mayor de edad
        if (\Carbon\Carbon::parse($request->input('date'))->age < 18) {
            return back()->with('danger', 'El usuario a registrar tiene que ser mayor de edad (18 años)');
        }

        // editamos los datos del usuario en la tabla users
        $user = User::find($id);
        $user->name = $request->input('name');

        // en caso que los campos de contraseña no esten vacíos
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        // editar los datos de usuario en la tabla user_dates siguiendo la relación
        $user->userDate->update([
            'birthday_date' => $request->input('date'),
            'city_code' => $request->input('code'),
        ]);

        // validamos que existan los datos que pueden llegar nulos
        if ($request->input('cellphone')) {
            $user->userDate->update([
                'cellphone' => $request->input('cellphone'),
            ]);
        }

        // asignar el rol seleccionado
        $user->assignRole($request->input('role'));

        return back()->with('success', 'Datos guardados con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Validamos que el usuario seleccionado exista
        $validate = $this->validate(request(), [
            'mid' => 'required|exists:user_dates,id',
        ]);

        // buscamos al usuario
        $delete = User::find($request->input('mid'));

        // revocamos el rol del usuario
        $delete->removeRole($this->getRoleUser($request->input('mid')));

        // eliminamos al usario, por la relación se efectúa en cascada
        $delete->delete();

        return back()->with('success', 'Usuario eliminado con éxito');
    }

    // funciones privada de la clase
    // obtiene el rol del usuario logueado
    private function getRoleUserLogguedIn(){
        $dato = User::find(Auth()->user()->id);

        foreach ($dato->getRoleNames() as $aux) {
            $role = $aux;
        }

        return $role;
    }

    // obtiene el rol de cualquier usuario, dando como dato su ID
    private function getRoleUser($id){
        $dato = User::find($id);
        $role = "";

        foreach ($dato->getRoleNames() as $aux) {
            $role = $aux;
        }

        return $role;
    }
}

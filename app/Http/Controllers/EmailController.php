<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\Email;
use App\User;

class EmailController extends Controller
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
        // obtenemos el rol del usuario logueado
        $role = $this->getRoleUserLogguedIn();

        $emails = [];

        switch ($role) {
            // si es admin hay que enlistar todos los correos y averiguar el nombre del remitente de cada correo
            case 'admin':
                $emails = Email::all();

                foreach ($emails as $aux) {
                    $aux->sender = User::find($aux->user_id)->name;
                }
                break;
            
            // si es user solo mostrará los correos pertenecientes al usuario
            case 'user':
                $emails = Email::where('user_id', Auth()->user()->id)->get();
                break;
        }

        return view('email.index')
                ->with('role', $role)
                ->with('emails', $emails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = $this->getRoleUserLogguedIn();

        return view('email.create')
                ->with('role', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate(request(), [
            'destinatario' => 'required|email',
            'subject' => 'required|string|max:100',
            'body' => 'required|string'
        ]);

        $email = Email::create([
            'user_id' => Auth()->user()->id,
            'addressee' => $request->input('destinatario'),
            'subject' => $request->input('subject'),
            'shipping_date' => now(),
            'status' => "NO ENVIADO",
            'email_body' => $request->input('body'),
        ]);

        //Guardamos el mail en la cola de jobs para que se ejecuten ni bien se introduzco el comando por artisan
        SendEmail::dispatch($email->id, $email->addressee, $email->subject, $email->shipping_date, $email->email_body);
        
        return redirect('emails')->with('success', 'Correo en cola para ser enviado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
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
}

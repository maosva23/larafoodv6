<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\TenantService;
use App\Tenant\Events\TenantCreatedEvent;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3','max:255'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
//            'nif' =>['required','numeric', 'unique:tenants'],
            'nif' =>['required','numeric', 'digits:14', 'unique:tenants'],
            'empresa' =>['required', 'string', 'min:3','max:255', 'unique:tenants,name'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);


        //Verfica na sessao se existe o objecto do tipo plano
        if (!$plan = session('plan')){
            return redirect()->route('site.home');
        }

//        dd($plan);

        //cria um objecto do tipo TenantService encarregado de registar a empresa e usuario apartir do formulario register
        $tenantService = app(TenantService::class);

//        dd($tenantService);

        //Regista na base de dados o tenant e o user e retorna o user
        $user = $tenantService->make($plan, $data);

//        dd($user);

        //Dispara o evento que adiciona um cargo ao uisuario que acaba de se cadastrar no sistema
        event(new TenantCreatedEvent($user));


        return $user;
    }
}

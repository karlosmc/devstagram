<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    //

    public function __construct() {
        $this->middleware('auth');
    }


    public function index(){
        
        return view('perfil.index');
    }

    public function store(Request $request){
        
        $request->request->add(['username'=>Str::slug($request->username)]);

        // dd(auth()->user()->password,Hash::make($request->oldpassword));


        // $this->validate($request,[
        //     'username'=>['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'],
        //     'email'=>['required','unique:users,email,'.auth()->user()->id,'max:60'],
        //     'oldpassword'=>[Rule::when(!empty($request->oldpassword), 'required'),
        //     ],
        //     'newpassword'=>['required_if:oldpassword,'.$request->oldpassword,Rule::when(!empty($request->oldpassword), 'min:6')],
            
        // ],['newpassword.required_if'=>'Debe poner un nuevo password cuando ha llenado oldpassword']);


        // $this->validate($request,[
        //     'username'=>['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'],
        //     'email'=>['required','unique:users,email,'.auth()->user()->id,'max:60'],
        //     'oldpassword'=>[Rule::when(!empty($request->oldpassword), 'required'),
        //          function ($attribute, $value, $fail) {
        //             if (!empty($value) && !Hash::check($value,auth()->user()->password)) {
        //                 $fail('oldpassword no coincide con la contraseña de autenticación.');
        //             }
        //         },
        //     ],
        //     'newpassword'=>['required_if:oldpassword,'.$request->oldpassword,Rule::when(!empty($request->oldpassword), 'min:6')],
            
        // ],['newpassword.required_if'=>'Debe poner un nuevo password cuando ha llenado oldpassword']);

        $this->validate($request,[
            'username'=>['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'],
        ]);


        
        if($request->imagen){
            
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid().".".$imagen->extension();
            
            $manager = new ImageManager(new Driver);
    
            $imagenServidor = $manager->read($imagen);
    
            $imagenServidor->cover(1000,1000);
    
            $imagenPath = public_path('perfiles').'/'.$nombreImagen;
            $imagenServidor->save($imagenPath);
         
            // return response()->json(['imagen'=>$nombreImagen]);

        }

        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen??'';
        $usuario->save();

        return redirect()->route('posts.index',$usuario->username);

    }
}


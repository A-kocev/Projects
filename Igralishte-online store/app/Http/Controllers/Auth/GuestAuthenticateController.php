<?php

namespace App\Http\Controllers\Auth;

use stdClass;
use App\Models\User;
use ImageKit\ImageKit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class GuestAuthenticateController extends Controller
{
    public $imageKit;
    public function __construct()
    {
        $this->imageKit = new ImageKit(
            "public_UbUNfInfezMko1r2ZGjnJ4dpTbM=",
            "private_GBZPx7wsb1+IftWG8G4yhO4an7Q=",
            "https://ik.imagekit.io/y621ggiyc"
        );
    }
    //
    public function login()
    {
        return view('front-end.login');
    }
    public function register()
    {
        return view('front-end.register');
    }
    public function register1(Request $request)
    {
        $user = new stdClass();
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        return view('front-end.register1', compact('user'));
    }
    public function register2(RegisterRequest $request)
    {
        $request->session()->put('register_data', $request->except('token'));
        return view('front-end.register2');
    }
    public function store(Request $request)
    {
        $data = $request->session()->pull('register_data');
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'wants_notifications' => $data['wants_notifications'] ?? 0,
            'password' => Hash::make($data['password']),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'bio' => $request->input('bio'),
        ]);
        if ($_FILES['image_url']['tmp_name']) {
            $fileType = mime_content_type($_FILES['image_url']['tmp_name']);

            $file = $this->imageKit->uploadFile([
                'file' => 'data:' . $fileType . ';base64,' . base64_encode(file_get_contents($_FILES['image_url']['tmp_name'])),
                'fileName' => 'picture',
            ]);
            $user->update([
                'image_url' => $file->result->url,
            ]);
        }
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use ImageKit\ImageKit;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
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
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = User::find(Auth::user()->id);
        $name = explode(' ', $request->input('name'));

        $user->update([
            'first_name' => $name[0],
            'last_name' => $name[1] ?? '',
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number')
        ]);


        if ($_FILES['profile_img']['tmp_name']) {
            $fileType = mime_content_type($_FILES['profile_img']['tmp_name']);

            $file = $this->imageKit->uploadFile([
                'file' => 'data:' . $fileType . ';base64,' . base64_encode(file_get_contents($_FILES['profile_img']['tmp_name'])),
                'fileName' => 'picture',
            ]);
            $user->update([
                'image_url' => $file->result->url,
            ]);
        }
        return Redirect::route('profile.edit')->with('successUpdate', 'Успешно си го ажуриравте профилот');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

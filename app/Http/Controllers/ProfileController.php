<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function editProfile()
    {
        return view('profil.edit');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        try {
            $user = Auth::user();
            $data = $request->all();
            if ($request->hasFile('foto')) {
                $upload_path = 'public/users';
                $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs(
                    $upload_path,
                    $filename
                );
                $data['foto'] = $path;
            }

            $user->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Update Data ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Berhasil Update Data');
    }
}

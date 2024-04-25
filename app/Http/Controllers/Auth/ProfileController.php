<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('auth.profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());
        if ($request->hasFile('photo')) {
            if ($request->user()->photo) {
                Storage::disk('public')->delete($request->user()->photo);
            }
            $photo = $request->file('photo')->storePublicly('users', 'public');
            $request->user()->photo = $photo;
        }
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        try {
            $request->user()->save();
            Alert::success('Success', 'Profile updated successfully');
            return to_route('profile.edit');
        } catch (\Throwable $th) {
            if (isset($photo)) {
                Storage::disk('public')->delete($photo);
            }
            Alert::error('Error', 'Profile failed to update');
            return back();
        }
    }
}

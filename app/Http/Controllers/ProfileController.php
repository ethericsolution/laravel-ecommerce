<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateRequest as ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{


    public function edit(Request $request)
    {

        $user = $request->user();

        $rightSideView = 'profile.edit';

        $pageTitle = 'Account Details';

        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => $pageTitle]
            ],
            'title' => $pageTitle,
        ];

        return view('account.index', compact('rightSideView', 'pageTitle', 'breadcrumbs', 'user'));
    }


    public function update(ProfileUpdateRequest $request)
    {

        $validated = $request->validate([
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore(auth()->user()->id)],
            'phone'         => ['required', 'string', 'max:20'],
        ]);

        $request->user()->fill($validated);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully!!!');
    }


    public function password(Request $request)
    {


        $user = $request->user();

        $rightSideView = 'profile.change-password';

        $pageTitle = 'Change Password';

        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => $pageTitle]
            ],
            'title' => $pageTitle,
        ];

        return view('account.index', compact('rightSideView', 'pageTitle', 'breadcrumbs', 'user'));
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Locales;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
//        $user=$request->user();
        $user=Auth::user();
        return view('/dashboard/profile.edit', [
//            'user' => $request->user(),
            'user'=>$user,
            'countries'=>Countries::getNames(),
//            'locales'=> Locales::getNames(),
            'locales'=>Languages::getNames()
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name'=>['required','string','max:255'],
            'last_name'=>['required','string','max:255'],
            'birthday'=>['nullable','date','before:today'],
            'gender'=>['in:male,female'],
            'country'=>['required','string','size:2']
        ]);

        $user=$request->user();

        $user->profile->fill($request->all())->save();
//        $profile=$user->profile;
//        if($profile->first_name)
//        {
//            $profile->update($request->all());
//        }else
//        {
////            $request->merge([
////                'user_id'=>$user->user_id,
////            ]);
////            Profile::create($request->all());
//
////            $user->profile()->create($request->all());//equal top statement
//        }

        return redirect()->route('profile.edit')->with('success','profile updated');

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

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use File;

class AuthController extends Controller
{
    public function registerPage(){
        return view('pages.register');
    }

    public function registerUser(Request $request){
        // Validation of forms
        $request->validate(
            [
                'firstName'     => 'required',
                'lastName'      => 'required',
                'email'         => 'required|email|unique:users',
                'gender'        => 'required',
                'country'       => 'required|not_in:null',
                'hobby'         => 'required',
                'password'      => 'required|min:8',
                'avatar'        => 'required|mimes:png,jpg|max:1024',
                'terms'         => 'required'
            ],
            [
                'firstName.required'        => 'First Name required',
                'lastName.required'         => 'Last Name required',
                'email.required'            => 'Email Address required',
                'gender.required'           => 'Gender required',
                'country.required'          => 'Country required',
                'country.not_in'            => 'Please select your country',
                'hobby.required'            => 'Please select your hobbies',
                'password.required'         => 'Password required',
                'password.min'              => 'Password must be at least 8 characters',
                'avatar.required'           => 'Profile image required',
                'avatar.mimes'              => 'Image format must be png or jpg',
                'avatar.max'                => 'Image should not be greater than 1MB',
                'terms.required'            => 'Please select terms & conditions'
            ]
        );

        // Cheking terms and conditions checkbox
        if( $request->has('terms') ){

            // Upload profile image to public folder
            $fileName = time() . '_' .$request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('user_images'), $fileName);

            // Insert form data to database table
            $user = User::create([
                'first_name'        => $request->firstName,
                'last_name'         => $request->lastName,
                'email'             => $request->email,
                'gender'            => $request->gender,
                'country'           => $request->country,
                'hobbies'           => implode(',', $request->hobby),
                'password'          => Hash::make($request->password),
                'profile_img'       => $fileName,
            ]);

            // Login user after completing registration form
            auth()->login($user);

            // Redirect to homepage after registration and loging
            return redirect('/');
        }

    }

    public function logoutUser(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function loginPage(){
        return view('pages.login');
    }

    public function loginUser(Request $request){
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ],[
            'email.required'        => 'Email required',
            'password.required'     => 'Password required',
        ]);

        if( Auth::attempt($credentials) ){
            return redirect('/');
        }

        return back()->with('error', 'Email and Password does not match');
    }

    public function userProfile(){

        // Check if user is logged in or not
        $check = Auth::check();
        if( $check ){
            $id = Auth::user()->id;
            $userData = User::find($id);
            return view('pages.profile', ['userData' => $userData]);
        }else{
            return redirect('/');
        }

    }

    public function updateProfile(Request $request){
        // Validation of forms
        $request->validate(
            [
                'firstName'     => 'required',
                'lastName'      => 'required',
                'gender'        => 'required',
                'country'       => 'required|not_in:null',
                'hobby'         => 'required',
                'avatar'        => 'mimes:png,jpg|max:1024',
            ],
            [
                'firstName.required'        => 'First Name required',
                'lastName.required'         => 'Last Name required',
                'gender.required'           => 'Gender required',
                'country.required'          => 'Country required',
                'country.not_in'            => 'Please select your country',
                'hobby.required'            => 'Please select your hobbies',
                'avatar.mimes'              => 'Image format must be png or jpg',
                'avatar.max'                => 'Image should not be greater than 1MB',
            ]
        );

        $fileName = $request->oldImage;
        // Check if image is uploaded or not
        if( $request->hasFile('avatar') ){

            // Removing old image
            $oldImageName = $request->oldImage;
            $image_path = public_path('user_images/'. $oldImageName);
            if( File::exists($image_path) ){
                File::delete($image_path);
            }

            $fileName = time() . '_' . $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('user_images'), $fileName);
        }

        // Fetch user data by id
        $user = User::find($request->userId);

        // update user
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->country = $request->country;
        $user->hobbies = implode(',', $request->hobby);
        $user->profile_img = $fileName;

        $user->save();

        return back()->with('success', 'Profile updated successfully!!');
    }
}

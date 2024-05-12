<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        // Validate the form data
        $request->validate([
            'mobile_number' => 'required|unique:users,mobile_number',
            'password' => 'required|min:6',
            'username' => 'required',
            'location' => 'required',
            'image' => 'required|image|max:2048', // 2MB max size
        ]);

        // Save the image
        $imagePath = $request->file('image')->store('images');

        // Generate verification code (random 6-digit number)
        $verificationCode = mt_rand(100000, 999999);

        // Send verification code via SMS
        $this->sendVerificationCode($request->mobile_number, $verificationCode);

        // Save user details to database
        $user = new User();
        $user->mobile_number = $request->mobile_number;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->location = $request->location;
        $user->image = $imagePath;
        $user->verification_code = $verificationCode;
        $user->save();

        // Redirect to a page to enter verification code
        return redirect()->route('verify');
    }

    private function sendVerificationCode($mobileNumber, $verificationCode)
    {
        $sid = 'AC14ba722d9e02b9e7dc0a975bc5abf2dc';
        $token = 'c499adf1a7ba7ec40cb65cfdb56b1c9a';

        $twilio = new Client($sid, $token);
        $message = $twilio->messages
            ->create(
                $mobileNumber, // to
                array(
                    "from" => "+12513095850",
                    "body" => $verificationCode
                )
            );
        print ($message->sid);
    }
}

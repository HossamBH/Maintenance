<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Customer\CreateRequest;
use App\Http\Requests\Api\Customer\ResetPasswordRequest;
use App\Http\Requests\Api\Customer\CheckPinCodeRequest;
use App\Http\Requests\Api\Customer\NewPasswordRequest;
use App\Http\Requests\Api\Customer\RegisterTokenRequest;
use App\Http\Requests\Api\Customer\LogoutRequest;
use Illuminate\Support\Str;
use App\Mail\ResetPassword;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Area;
use App\Models\City;
use App\Models\Governorate;
use Mail;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                "status" => 0,
                'msg' => 'Unauthorized'
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = Auth::guard('api')->user();

        return response()->json([
            'status' => 1,
            'msg' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    //public function logout(LogoutRequest $request)
    public function logout()
    {
        $customer = Auth::guard('api')->user();

        // $id = Token::where('device_id', $request->device_id)->where('customer_id', $customer->id)->first();
        // if ($id) {
        //     $id->delete();
        // }

        Auth::guard('api')->logout();
        return response()->json([
            'status' => 1,
            'msg' => 'success'
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::guard('api')->refresh());
    }

    /**
     * Check if the token is still active.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkActivation()
    {
        if (auth('api')->check()) {
            return response()->json([
                'status' => 1,
                'msg' => 'success'
            ]);
        }
        return response()->json([
            'status' => 0,
            'msg' => 'Token Expired'
        ], 401);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $customer = Customer::where('email', $request->email)->first();
        if (!$customer) {
            return response()->json([
                "status" => 0,
                'msg' => 'Wrong Email'
            ], 400);
        }

        $reset = new Reset;
        $reset->email = $request->email;
        $reset->token = Str::random(60);
        $reset->save();
        $reset->is_expired = $reset->created_at->addMinutes(30);
        $reset->save();

        if ($reset) {
            $pin_code = rand(111111, 999999);
            $reset_pin_code = $reset->update(['pin_code' => $pin_code]);
            $reset->save();
            $customer_pin_code = $customer->update(['pin_code' => $pin_code]);
            if ($customer_pin_code && $reset_pin_code) {
                Mail::to($customer->email)
                    ->send(new ResetPassword($pin_code));

                return response()->json([
                    'status' => 1,
                    'msg' => 'success',
                    'pin_code' => $pin_code
                ]);
            }
        }
    }
    public function checkPinCode(CheckPinCodeRequest $request)
    {
        $reset = Reset::where('pin_code', $request->pin_code)->first();
        if ($reset) {
            $token = $reset->token;
            if (Carbon::now() > $reset->is_expired) {
                return response()->json([
                    "status" => 0,
                    'msg' => 'Pin Code has expired'
                ], 404);
            }
            return response()->json([
                'status' => 1,
                'msg' => 'success',
                'data' => $token
            ]);
        }
        return response()->json([
            "status" => 0,
            'msg' => 'Wrong Pin Code'
        ], 400);
    }
    public function newPassword(NewPasswordRequest $request)
    {
        $reset = Reset::where('token', $request->token)->first();
        if ($reset) {
            $customer = Customer::where('pin_code', $reset->pin_code)->first();
            $customer->password = Hash::make($request->new_password);
            if ($customer->save()) {
                $reset->delete();
                $customer->pin_code = null;
                $customer->save();
                return response()->json([
                    'status' => 1,
                    'msg' => 'success',
                    'customer' => $customer
                ]);
            }
        }
        return response()->json([
            "status" => 0,
            'msg' => 'Something went wrong'
        ], 400);
    }

    public function registerToken(RegisterTokenRequest $request)
    {
        $customer = Auth::guard('customer-api')->user();

        $getToken = Token::where('customer_id', $customer->id)->where('device_id', $request->device_id)->first();
        if ($getToken) {
            $getToken->token = $request->token;
            $getToken->save();
            return response()->json([
                'status' => 1,
                'msg' => 'updated',
            ]);
        } else {
            $token = new Token;
            $token->token = $request->token;
            $token->platform = $request->platform;
            $token->device_id = $request->device_id;
            $token->customer_id = $customer->id;
            $token->save();

            return response()->json([
                'status' => 1,
                'msg' => 'success',
            ]);
        }
    }
}

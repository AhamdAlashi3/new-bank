<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\customer;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Messages;
use App\Helpers\UserFcmTokenController;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;
use Illuminate\Http\Client\Response;

class UserApiAuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string'
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', $request->get('email'))->first();

            if (Hash::check($request->get('password'), $user->password)) {

                $this->revokePreviousToken($user->id);
                $token = $user->createToken('CS');

                // $fcm=new UserFcmTokenController();
                // $fcm->sendNotification([User::whereNotNull('fcm_token')->get('fcm_token')],'','','');

                $user->setAttribute('token', $token->accessToken);
                return response()->json(['status' => true, 'message' => Messages::getMessage('LOGGED_IN_SUCCESSFULLY'), 'object' => $user,], 200);

            } else {
                return response()->json(['status' => false, 'message' => 'Failed to login, please logout from other devices'], 401);
            }

        } else {
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 400);
        }
    }

    public function loginpgt(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string'
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', $request->get('email'))->first();
            $this->revokePreviousToken($user->id);

            $response = Http::asForm()
                ->post('http://127.0.0.1:8001/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => 'OT1my5v4yO2ZJS3IdGaREM2wIwIJJo1nHuTcRa03',
                    'username' => $request->get('email'),
                    'password' => $request->get('password'),
                    'scope' => '*',
                ]);

            $user->setAttribute('token',$response->json());
            $user->setAttribute('refresh_token', $response->json());

            return response()->json(['status' => true, 'object' => $user], 200);

        } else {
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 400);
        }
    }



    private function revokePreviousToken($userId)
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', $userId)
            ->update([
                'revoked' => true
            ]);
    }

    private function checkActiveTokens($userId)
    {
        return DB::table('oauth_access_tokens')
            ->where('user_id', $userId)
            ->where('revoked', false)
            ->exists();
    }

    public function logout(Request $request)
    {
        $isLoggedOut = $request->user('api')->token()->revoke();
        return response()->json(
            [
                'status' => $isLoggedOut,
                'message' => Messages::getMessage('LOGGED_OUT_SUCCESSFULLY'),
            ],
            $isLoggedOut ? 200 : 400
        );

    }

    public function logoutpgt(Request $request)
    {
        $token = $request->user('api')->token();
        $refreshTokenRevoked = DB::table('oauth_refresh_tokens')->where('access_token_id', $token->id)->update([
            'revoked' => true
        ]);
        if ($refreshTokenRevoked) {
            $isRevoked = $token->revoke();
            return response()->json(
                [
                    'status' => $isRevoked,
                    'message' => $isRevoked ? 'Logged out successfully' : 'Error'
                ],
                $isRevoked ? 200 : 400
            );
        }

    }
}

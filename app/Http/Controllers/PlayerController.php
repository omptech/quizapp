<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Resources\Completed\CompletedResource;
use App\Http\Resources\Player\PlayerCollection;
use App\Http\Resources\Player\PlayerResource;
use App\Http\Resources\Refer\ReferResource;
use App\Http\Resources\Referral\ReferralCollection;
use App\Http\Resources\Referral\ReferralResource;
use App\Http\Resources\Withdrawal\WithdrawalResource;
use App\Mail\SendAccountVerificationCode;
use App\Mail\SendPasswordResetCode;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyAccountByCode;
use App\Player;
use App\Refer;
use App\Setting;
use App\Verification;
use App\Withdrawal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PlayerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verifyBeforeStore(Request $request) {
        $userWithEmail = Player::where('email', '=', $request->email)->first();
        $device = Device::where('device_id', '=', $request->device_id)->first();
            // Errors
            if ($userWithEmail) {
            $result['success'] = 'emailError';
            $result['message_email'] = 'Sorry, A player with this email already exist!';
            echo json_encode($result);
            } else {
                if ($device) {
                $result['success'] = 'deviceError';
                $result['message_device'] = 'Sorry, Only 1 account per device is allowed!';
                echo json_encode($result);
            } else {
                $result['success'] = '1';
                $result['message'] = 'success';

                echo json_encode($result);
            }
            } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $userWithEmail = Player::where('email', '=', $request->email)->first();
        $device = Device::where('device_id', '=', $request->device_id)->first();
            // Errors
            if ($userWithEmail) {
            $result['success'] = 'emailError';
            $result['message_email'] = 'Sorry, A player with this email already exist!';
            echo json_encode($result);
            } else {
                if ($device) {
                $result['success'] = 'deviceError';
                $result['message_device'] = 'Sorry, Only 1 account per device is allowed!';
                echo json_encode($result);
            } else {
                $name = $request->name;
                $email = $request->email;
                $password = $request->password;
                $passwordCrypted = bcrypt($password);
                // Create new Player
                if ($request->image_url) {
                    $imageUrl = $request->image_url;
                } else {
                    $imageUrl = URL::to('assets/img/player.png');
                }
                $player = Player::create([
                    'name'=>$name,
                    'email'=>$email,
                    'password'=>$passwordCrypted,
                    'score'=>0,
                    'referral_code'=>Str::random(6),
                    'image_url'=>URL::to($imageUrl)
                ]);

                $newDevice = Device::create([
                    'chef_id'=>$player->id,
                    'device_id'=>$request->device_id,
                ]);
                $newRef = $player->referral_code . $player->id;
                $player->referral_code = $newRef;
                $player->save();

                $result['success'] = '1';
                $result['message'] = 'success';

                echo json_encode($result);
            }
            } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addReferral(Request $request) {
        $email = $request->email;
        $referral = $request->referral;
        $player = Player::where('email', '=', $email)->first();
        $referredPlayer = Player::where('referral_code', '=', $referral)->first();
                $settings = Setting::find(1);
                if ($referredPlayer) {
                    $player->score = $player->score + $settings->referral_register_points;
                    $player->save();
                        // Add Points to referer
                    $referredPlayer->score = $referredPlayer->score + $settings->referral_register_points;
                    $referredPlayer->save();
                    Refer::create([
                        'player_id'=>$referredPlayer->id,
                        'li_m_refer_email'=>$player->email,
                        'li_m_refer_id'=>$player->id,
                    ]);
                    $result['success'] = '1';
                $result['message'] = 'success';

                echo json_encode($result);
                } else {
                    $result['success'] = '0';
                $result['message'] = 'error';

                echo json_encode($result);
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request) {
    $code = rand(100000, 999999);

    $verification = Verification::create([
        'email'=>$request->email,
        'account_verification_code'=>$code,
    ]);

    $email = $request->email;
        Mail::to($email)->send(new SendAccountVerificationCode($code));
        $result['success'] = '1';
        echo json_encode($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function verifyEmailCode(Request $request) {
        $verification = Verification::where('email', '=', $request->email)->first();
        $code = (int) $request->code;
        if ($code == $verification->account_verification_code) {
            $result['success'] = '1';
            echo json_encode($result);
        } else {
            $result['success'] = '0';
            echo json_encode($result);
        }
    }

    /**
     * Login Player.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Get Data From request
        $email = $request->email;
        $password = $request->password;

        $checkPassword = "";

        // Check if player exists 
        $player = Player::where('email', '=', $request->email)->first();


        if ( $player == null ) {
            $result['success'] = 'emailError';
            $result['email_error'] = 'Sorry! No player with this Email!';
            echo json_encode($result);
        } else {
            // Check Password
            if (Hash::check($password,$player->password)) {
                $checkPassword = "true";
            } 
            else {
                $checkPassword = "false";
            }
            // Password Error
            if ( $player && $checkPassword == "false") {
                $result['success'] = 'passwordError';
                $result['password_error'] = 'Sorry! This password is not valid';
                echo json_encode($result);
            }
            // If No Errors
            if ( $player && $checkPassword == "true") {
                $refer = Refer::where('player_id', '=', $player->id)->first();
                if ($refer) {
                $result['refer'] = 'refer';
                $result['success'] = 'loggedSuccess';
            echo json_encode($result);
                } else {
                $result['refer'] = 'norefer'; 
                $result['success'] = 'loggedSuccess';
            echo json_encode($result);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function verifyUserSituation(Request $request)
    {
        // Get Data From request
        $email = $request->email;

        // Check if player exists 
        $player = Player::where('email', '=', $request->email)->first();


        if ( $player == null ) {
            $result['success'] = 'deleted';
            $result['message_error'] = 'Sorry! Your account is blocked!';
            echo json_encode($result);
        } else {
            $result['success'] = 'loggedSuccess';
            $result['message'] = 'This user Still in Database';
            echo json_encode($result);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function getPlayerData(Request $request)
    {
        $email = $request->email;
        $player = PlayerResource::collection(Player::where('email', '=', $email)->get());
        echo json_encode($player);

    }

    /**
     * Display list of TOP 10 Players By score
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function topPlayers() {

        $players = Player::orderBy('score', 'desc')->take(15)->get();
        return PlayerCollection::collection($players);
    }

    /**
     * Update Player Points
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function updatePlayerPoints(Request $request, Player $player) {
        $actualPoints = (int) $player->score;
        $addedPoints = (int) $request->points;
        $newPoints = $actualPoints + $addedPoints;
        $player->score = $newPoints;
        $player->save();
        $result['success'] = 'playerUpdated';
        $result['message'] = 'points are updated successfully';
        echo json_encode($result);

    }

    /**
     * Display list of Players By score
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allPlayersDesc() {

        $players = Player::orderBy('score', 'desc')->skip(3)->take(47)->get();
        return PlayerCollection::collection($players);
    }

    /**
     * Display list of Players By score
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allPlayersAsc() {

        $players = Player::orderBy('score', 'asc')->get();
        return PlayerCollection::collection($players);
    }

    /**
     * Display list of Players By score
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allPlayersAlpha() {

        $players = Player::orderBy('name', 'asc')->get();
        return PlayerCollection::collection($players);
    }

    /**
     * Display list of Referral History
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getReferralHistory(Player $player) {
        $refers = $player->refers;
        return ReferResource::collection($refers);

    }

    /**
     * Display list of Referral History
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getWithdrawalHistory(Player $player) {
        $withdrawals = $player->withdrawals;
        return WithdrawalResource::collection($withdrawals);

    }

    /**
     * Add New Withdrawal Request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function addNewWithdrawal(Request $request) {
        $player = $request->player_id;
        $points = $request->points;
        $withdrawal = Withdrawal::create([
            'player_id'=>$request->player_id,
            'amount'=>$request->amount,
            'points'=>$request->points,
            'status'=>"Pending",
            'payment_method'=>$request->method,
            'payment_account'=>$request->account,
        ]);
        $givenPlayer = Player::find($player);
        $givenPlayer->score = $givenPlayer->score - $points;
        $givenPlayer->save();
        $result['success'] = '1';
        $result['message'] = 'success';
        echo json_encode($result);
    }

    /**
     * Display Completed Quiz List
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getCompletedQuiz(Player $player) {
        $completeds = $player->completeds;
        return CompletedResource::collection($completeds);

    }

    /**
     * Display list of Players By score
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function firstPlayer() {

        $player = Player::orderBy('score', 'desc')->take(1)->get();
        return PlayerCollection::collection($player);
    }

    /**
     * Display list of Players By score
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function secondAndTirthPlayers() {

        $players = Player::orderBy('score', 'desc')->skip(1)->take(2)->get();
        return PlayerCollection::collection($players);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function sendResetCode(Request $request) {
    $code = rand(100000, 999999);
    $player = Player::where('email', '=', $request->email)->first();
    if ($player) {
    $verification = Verification::where('email', '=', $request->email)->first();
    $email = $request->email;
    if ($verification) {
        $verification->pw_reset_code = $code;
        $verification->save();
        Mail::to($email)->send(new SendPasswordResetCode($code));
        $result['success'] = '1';
        echo json_encode($result);
    } else {
        $verification = Verification::create([
            'email'=>$request->email,
            'pw_reset_code'=>$code,
        ]);
        Mail::to($email)->send(new SendPasswordResetCode($code));
        $result['success'] = '1';
        echo json_encode($result);
    }
    } else {
        $result['success'] = '0';
        echo json_encode($result);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function verifyResetCode(Request $request) {
        $verification = Verification::where('email', '=', $request->email)->first();
        $code = (int) $request->code;
        if ($code == $verification->pw_reset_code) {
            $result['success'] = '1';
            echo json_encode($result);
        } else {
            $result['success'] = '0';
            echo json_encode($result);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request) {
        $user = Player::where('email', '=', $request->email)->first();
        $password = $request->new_password;
        $confirmPassword = $request->confirm_password;
        if ($password == $confirmPassword) {
            $passwordCrypted = bcrypt($password);
            $user->password = $passwordCrypted;
            $user->save();
            $result['success'] = '1';
            echo json_encode($result);
        } else {
            $result['success'] = '0';
            echo json_encode($result);
        }
    }

    /**
     * Change chef profile Image.
     *
     * @param  \App\chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function editAllProfileInfos(Request $request) {
    $chefToChange = Player::where('email', '=', $request->email)->first();
    if ($request->name !== $chefToChange->name) {
        $userNameExistOrNot = Player::where('name', $request->name)->first();
        if ($userNameExistOrNot) {
            $result['success'] = '0';
            echo json_encode($result);
        } else {
    $chefToChange->name = $request->name;
    $chefToChange->save();
    $result['success'] = '1';
    echo json_encode($result);
        }
    } else {
    $chefToChange->name = $request->name;
    $chefToChange->save();
    $result['success'] = '1';
    echo json_encode($result);
    }
    }

    /**
     * Change chef profile Image.
     *
     * @param  \App\chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function changeImage(Request $request) {
    $chef = Player::all()->where('email', $request->email)->first();
    // Get image string posted from Android App
    $base=$request->image;
    $filename = $request->id.Str::random(10);
    $binary=base64_decode($base);
    header('Content-Type: bitmap; charset=utf-8');
    $file = fopen('assets/uploads/avatars/'.$filename, 'wb');
    fwrite($file, $binary);
    fclose($file);
    $chef->image_url = URL::to("assets/uploads/avatars/".$filename);
    $chef->save();
    $result['success'] = '1';
    echo json_encode($result);
    }

}



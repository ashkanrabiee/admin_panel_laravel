<?php

namespace App\Http\Controllers\Auth\Customer;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;
use App\Http\Requests\Auth\Customer\loginReqisterRequest;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
    {
        return view('customer.auth.login-register');
    }

    public function loginRegister(loginReqisterRequest $request)
    {
        $inputs = $request->all();

        // Check if input is email
        if(filter_var($inputs['id'], FILTER_VALIDATE_EMAIL)) {
            $type = 1; // 1 => email
            $user = User::where('email', $inputs['id'])->first();
            if(empty($user)){
                $newUser['email'] = $inputs['id'];
            }
        }

        // Check if input is mobile
        elseif(preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['id'])){
            $type = 0; // 0 => mobile

            // Format mobile number
            $inputs['id'] = ltrim($inputs['id'], '0');
            $inputs['id'] = substr($inputs['id'], 0, 2) === '98' ? substr($inputs['id'], 2) : $inputs['id'];
            $inputs['id'] = str_replace('+98', '', $inputs['id']);

            $user = User::where('mobile', $inputs['id'])->first();
            if(empty($user)){
                $newUser['mobile'] = $inputs['id'];
            }
        } else {
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id' => 'شناسه ورودی شما نه شماره موبایل است نه ایمیل']);
        }

        if(empty($user)){
            $newUser['password'] = '98355154';
            $newUser['activation'] = 1;
            $user = User::create($newUser);
        }

            // Create OTP
            $otpCode = rand(111111, 999999);
            $token = Str::random(60);
            $otpInputs = [
                'token' => $token,
                'user_id' => $user->id,
                'otp_code' => $otpCode,
                'login_id' => $inputs['id'],
                'type' => $type,
            ];

        Otp::create($otpInputs);

        // Send SMS or Email
        if($type == 0) {
            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo(['0' . $user->mobile]);
            $smsService->setText("مجموعه آمازون \n  کد تایید : $otpCode");
            $smsService->setIsFlash(true);

            $messagesService = new MessageService($smsService);
        } elseif($type === 1) {
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعال سازی',
                'body' => "کد فعال سازی شما : $otpCode"
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($inputs['id']);

            $messagesService = new MessageService($emailService);
        }

        $messagesService->send();

        return redirect()->route('auth.customer.login-confirm-form', $token);
    }

    public function loginConfirmForm($token)
    {
        $otp = Otp::where('token', $token)->first();
        if(empty($otp)) {
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id' => 'آدرس وارد شده نامعتبر میباشد']);
        }
        return view('customer.auth.login-confirm', compact('token', 'otp'));
    }

    public function loginConfirm($token, loginReqisterRequest $request)
    {
        $inputs = $request->all();

        $otp = Otp::where('token', $token)
            ->where('used', 0)
            ->where('created_at', '>=', Carbon::now()->subMinute(5)->toDateTimeString())
            ->first();

        if(empty($otp)) {
            return redirect()->route('auth.customer.login-register-form', $token)->withErrors(['id' => 'آدرس وارد شده نامعتبر میباشد']);
        }

        if($otp->otp_code !== $inputs['otp']) {
            return redirect()->route('auth.customer.login-confirm-form', $token)->withErrors(['otp' => 'کد وارد شده صحیح نمیباشد']);
        }

        // Mark OTP as used
        $otp->update(['used' => 1]);
        $user = $otp->user()->first();
        
        // Verify user email or mobile
        if($otp->type == 0 && empty($user->mobile_verified_at)) {
            $user->update(['mobile_verified_at' => Carbon::now()]);
        } elseif($otp->type == 1 && empty($user->email_verified_at)) {
            $user->update(['email_verified_at' => Carbon::now()]);
        }

        Auth::login($user);
        return redirect()->route('customer.home');
    }

    public function loginResendOtp($token)
    {
        // Check if 5 minutes have passed
        $otp = Otp::where('token', $token)->first();
        if (!$otp) {
            return redirect()->route('auth.customer.login-register-form', $token)->withErrors(['id' => 'آدرس وارد شده نامعتبر است']);
        }

        if ($otp->created_at->addMinutes(5)->isFuture()) {
            return redirect()->route('auth.customer.login-confirm-form', $token)->withErrors(['id' => 'لطفاً صبر کنید تا تایمر به پایان برسد']);
        }

        // Generate new OTP
        $otpCode = rand(111111, 999999);
        $newToken = Str::random(60);

        $otpInputs = [
            'token' => $newToken,
            'user_id' => $otp->user_id,
            'otp_code' => $otpCode,
            'login_id' => $otp->login_id,
            'type' => $otp->type,
        ];

        Otp::create($otpInputs);

        // Send SMS or Email
        if($otp->type == 0) {
            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo(['0' . $otp->user->mobile]);
            $smsService->setText("مجموعه آمازون \n  کد تایید : $otpCode");
            $smsService->setIsFlash(true);

            $messagesService = new MessageService($smsService);
        } elseif($otp->type === 1) {
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعال سازی',
                'body' => "کد فعال سازی شما : $otpCode"
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($otp->login_id);

            $messagesService = new MessageService($emailService);
        }

        $messagesService->send();

        return redirect()->route('auth.customer.login-confirm-form', $newToken);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('customer.home');
    }
}

<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Customer\SalesProcess\ProfileCompletionRequest;

class ProfileCompletionController extends Controller
{
    public function profileCompletion()
    {
       $user = Auth::user();

       $cartItems = CartItem::where('user_id', $user->id)->get();
       return view('customer.sales-process.profile-completion', compact('user', 'cartItems'));

    }

    public function update(ProfileCompletionRequest $request)
    {
        $user = Auth::user();
        
        $national_code = convertArabicToEnglish($request->national_code);
        $national_code = convertPersianToEnglish($national_code);
    
        $inputs = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'national_code' => $national_code,
        ];
    
        if (isset($request->mobile) && empty($user->mobile)) {
            $mobile = convertArabicToEnglish($request->mobile);
            $mobile = convertPersianToEnglish($mobile);
    
            if (preg_match('/^(\+98|98|0)9\d{9}$/', $mobile)) {
                // استانداردسازی شماره موبایل
                $mobile = ltrim($mobile, '0');
                $mobile = substr($mobile, 0, 2) == '98' ? substr($mobile, 2) : $mobile;
                $mobile = str_replace('+98', '', $mobile);
    
                // بررسی تکراری نبودن شماره موبایل در دیتابیس
                $existingUser = User::where('mobile', $mobile)->where('id', '!=', $user->id)->first();
                if ($existingUser) {
                    return redirect()->back()->withErrors(['mobile' => 'این شماره موبایل قبلاً ثبت شده است.']);
                }
    
                $inputs['mobile'] = $mobile;
            } else {
                return redirect()->back()->withErrors(['mobile' => 'فرمت شماره موبایل معتبر نیست.']);
            }
        }
    
        if (isset($request->email) && empty($user->email)) {
            $email = convertArabicToEnglish($request->email);
            $email = convertPersianToEnglish($email);
            $inputs['email'] = $email;
        }
    
        $inputs = array_filter($inputs);
    
        if (!empty($inputs)) {
            $user->update($inputs);
        }
    
        return redirect()->route('customer.sales-process.address-and-delivery');
    }
    }
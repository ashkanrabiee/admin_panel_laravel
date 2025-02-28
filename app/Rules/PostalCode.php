<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PostalCode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // تبدیل عدد فارسی به انگلیسی و تبدیل اعداد عربی به انگلیسی
        $value = convertPersianToEnglish($value);
        $value = convertArabicToEnglish($value);

        // الگوی پستی
        $pattern = "/\b(?!(\d)\1{3})[13-9]{4}[1346-9][013-9]{5}\b/";

        // چک کردن با استفاده از preg_match
        if (!preg_match($pattern, $value)) {
            // اگر معتبر نباشد پیام خطا را صادر می‌کند
            $fail(':attribute معتبر نمی‌باشد');
        }
    }
}

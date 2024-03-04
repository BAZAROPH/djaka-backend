<?php
namespace App\Services;

class OTPServices
{
    protected $otpExpiration;

    public function __construct(){
        $this->otpExpiration = now()->addMinute(3);
    }

    public function generate(){
        $code = rand(10000, 99999);
        $expiration = $this->otpExpiration;

        return [
            'code' => $code,
            'expiration' => $expiration
        ];
    }

}

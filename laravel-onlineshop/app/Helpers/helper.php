<?php


use Illuminate\Support\Facades\Http;

function product_image_url($image)
{
    return env('ADMIN_PANEL_URL') . env('PRODUCT_IMAGES_PATH') . $image;
}

function send_otp_sms($cellphone, $otpCode, $template)
{
    return 'Done!';
    $apiKey = env('SMS_PANEL_API_KEY');
    $response = Http::get("https://api.kavenegar.com/v1/{$apiKey}/verify/lookup.json", [
        'receptor' => $cellphone,
        'token'    => $otpCode,
        'template' => $template,
    ]);

    $data = $response->json();
    $messageId  = $data['entries'][0]['messageid'] ?? null;
    $message    = $data['entries'][0]['message'] ?? null;
    $status     = $data['entries'][0]['status'] ?? null;
    $statusText = $data['entries'][0]['statustext'] ?? null;

    return $status;
}

<?php

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Melihovv\Base64ImageDecoder\Base64ImageDecoder;

function getUser($param)
{
    $user = User::where('id', $param)
        ->orWhere('email', $param)
        ->first();

    return $user;
}

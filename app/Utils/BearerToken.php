<?php

namespace App\Utils;

use Lcobucci\JWT\Parser;
use Laravel\Passport\Token;

class BearerToken
{
    public static function fromRequest()
    {
        $header = request()->header('authorization');
        $jwt = trim(preg_replace('/^(?:\s+)?Bearer\s/', '', $header));
        return self::fromJWT($jwt);
    }

    public static function fromJWT($jwt) {
        $token = (new Parser())->parse($jwt);
        return Token::find($token->getClaim('jti'));
    }
}

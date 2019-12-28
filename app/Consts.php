<?php

namespace App;

class Consts
{
    const VERIFY_CODE_LENGTH = 6;
    const VERIFY_CODE_STRING = '0123456789';
    const TRUE = 1;
    const FALSE = 0;

    const CHAR_COMMA = ',';

    const USER_ACTIVE = 'active';
    const USER_INACTIVE = 'inactive';

    const DEFAULT_LOCALE = 'en';

    const DEFAULT_PER_PAGE = 10;

    const AUTH_ROUTE_RESET_PASSWORD = '/reset-password?token=';
    const AUTH_ROUTE_CONFIRM_EMAIL = '/login?code=';
    const AUTH_ROUTE_VERIFY_EMAIL = '/verify-account/';

    const MAX_MONTH = 12;
    const MIN_YEAR = 19;

    const MASTERDATA_TABLES = [
        'platforms',
        'bounty_types',
        'reasons',
        'languages'
    ];

    const SOCKET_CHANNEL_USER = 'App.User.';

    const QUEUE_SOCKET = 'socket';
    const CONNECTION_SOCKET = 'sync';


    const ROLE_SUPER_ADMIN  = 'Super Admin';
    const ROLE_ADMIN        = 'Admin';

    const CHAR_PASSWORD_HIDDEN = '$2y$10$AZwQOZgRySHQRcjTKrxOqenIBOEk.dEAhEbjuhMPx/r.KYdBsMj9S';//'Password'

    const MAIL_PROCESSING = 'processing'; // mail processing
    const MAIL_FAIL = 'fail'; // send mail status is fail
    const MAIL_SUCCESS = 'success'; //send mail status is success
}

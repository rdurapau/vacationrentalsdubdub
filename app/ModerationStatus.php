<?php

namespace App;

class ModerationStatus
{

    const PENDING = 0;
    const APPROVED = 1;
    const REJECTED = 2;

    public static function getFriendly($num)
    {
        switch($num) {
            case self::PENDING: 
                return 'pending';
                break;
            case self::APPROVED:
                return 'approved';
                break;
            case self::REJECTED:
                return 'rejected';
                break;
        }
    }

}

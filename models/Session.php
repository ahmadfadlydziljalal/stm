<?php

namespace app\models;

use app\models\base\Session as BaseSession;
use app\models\User;

/**
 * This is the model class for collection "session".
 */
class Session extends BaseSession
{
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

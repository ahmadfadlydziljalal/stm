<?php

namespace tests\unit\models;

use app\models\User;
use Codeception\Test\Unit;

class UserTest extends Unit
{
    public function testFindUserById()
    {
        verify($user = User::findIdentity(1))->notEmpty();
        verify($user->username)->equals('Raya');
        verify(User::findIdentity(999))->empty();

    }

//    public function testFindUserByAccessToken()
//    {
//        verify($user = User::findIdentityByAccessToken('VcwkVbdWmExyRps4F-bBycHFQ36VB1JG'))->notEmpty();
//        verify($user->username)->equals('Raya');
//
//        verify(User::findIdentityByAccessToken('non-existing'))->empty();
//    }
//
//    public function testFindUserByUsername()
//    {
//        verify($user = User::findByUsername('Raya'))->notEmpty();
//        verify(User::findByUsername('not-admin'))->empty();
//    }
//
//    /**
//     * @depends testFindUserByUsername
//     */
//    public function testValidateUser()
//    {
//        $user = User::findByUsername('Raya');
//        verify($user->validateAuthKey('VcwkVbdWmExyRps4F-bBycHFQ36VB1JG'))->notEmpty();
//        verify($user->validateAuthKey('test102key'))->empty();
//
//        verify($user->validatePassword('Barika09*'))->notEmpty();
//        verify($user->validatePassword('123456'))->empty();
//    }

}
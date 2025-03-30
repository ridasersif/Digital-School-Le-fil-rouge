<?php
namespace App\Interfaces\Profile;

interface ProfileInterface
{
    public function updateProfile($user, $data);

    public function updateEmail($user, $email);

    public function updatePassword($user, $newPassword);
    public function updateAvatar($user, $avatar);
}
    

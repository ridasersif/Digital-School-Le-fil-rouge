<?php
namespace App\Repositories\Profile;

use App\Interfaces\Profile\ProfileInterface;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileRepository implements ProfileInterface
{
    public function updateProfile($user, $data)
    {
        $profile = $user->profile;

        if (!$profile) {
            $profile = new Profile([
                'user_id' => $user->id,
            ]);
        }

        // Mise à jour des informations du profil avec les données réelles de la variable $data
        $profile->update([
            'phone' => isset($data['phone']) ? $data['phone'] : null,
            'birthdate' => isset($data['birthdate']) ? $data['birthdate'] : null,
            'occupation' => isset($data['occupation']) ? $data['occupation'] : null,
            'address' => isset($data['address']) ? $data['address'] : null,
            'website' => isset($data['website']) ? $data['website'] : null,
            'facebook_profile' => isset($data['facebook_profile']) ? $data['facebook_profile'] : null,
        ]);

        // Mise à jour des informations de l'utilisateur
        $user->update([
            'name' => isset($data['name']) ? $data['name'] : $user->name,
        ]);

        return $profile;
    }

    public function updateEmail($user, $email)
    {
        $user->email = $email;
        $user->save();

        return $user;
    }

    public function updatePassword($user, $newPassword)
    {
        $user->password = bcrypt($newPassword);
        $user->save();

        return $user;
    }

    public function updateAvatar($user, $avatar)
    {
        $profile = $user->profile;

        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $user->id;
        }
        if ($profile->avatar && Storage::exists('public/' . $profile->avatar)) {
            Storage::delete('public/' . $profile->avatar);
        }
        $path = $avatar->store('avatars', 'public');
        $profile->avatar = $path;
        $profile->save();
    }
}

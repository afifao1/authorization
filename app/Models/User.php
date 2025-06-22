<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function createUser($name, $email, $password)
    {
        $hashedPassword = Hash::make($password);

        $userId = DB::table('users')->insertGetId([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return self::getUserById($userId);
    }

    public static function getUserByEmail($email)
    {
        $userData = DB::table('users')->where('email', $email)->first();

        if ($userData) {
            $user = new self();
            $user->id = $userData->id;
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->password = $userData->password;
            $user->created_at = $userData->created_at;
            $user->updated_at = $userData->updated_at;
            return $user;
        }

        return null;
    }

    public static function getUserById($id)
    {
        $userData = DB::table('users')->where('id', $id)->first();

        if ($userData) {
            $user = new self();
            $user->id = $userData->id;
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->password = $userData->password;
            $user->created_at = $userData->created_at;
            $user->updated_at = $userData->updated_at;
            return $user;
        }

        return null;
    }

    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public static function emailExists($email)
    {
        return DB::table('users')->where('email', $email)->exists();
    }
}

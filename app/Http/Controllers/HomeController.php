<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        if (!$this->isAuthenticated()) {
            return redirect('/login');
        }

        $user = $this->getCurrentUser();

        return view('home', compact('user'));
    }

    public function profile()
    {
        if (!$this->isAuthenticated()) {
            return redirect('/login');
        }

        $user = $this->getCurrentUser();

        return view('profile', compact('user'));
    }

    private function isAuthenticated()
    {
        if (Session::has('user_id')) {
            return true;
        }

        $rememberedUserId = Cookie::get('remember_user');
        if ($rememberedUserId) {
            $user = User::getUserById($rememberedUserId);
            if ($user) {
                Session::put('user_id', $user->id);
                Session::put('user_name', $user->name);
                Session::put('user_email', $user->email);
                return true;
            }
        }

        return false;
    }

    private function getCurrentUser()
    {
        if (Session::has('user_id')) {
            return User::getUserById(Session::get('user_id'));
        }
        return null;
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if ($this->isAuthenticated()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::getUserByEmail($request->email);

        if ($user && $user->checkPassword($request->password)) {
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            Session::put('user_email', $user->email);

            if ($request->has('remember')) {
                Cookie::queue('remember_user', $user->id, 43200);
            }

            return redirect('/')->with('success', 'Вы успешно вошли в систему!');
        }

        return back()->withErrors(['email' => 'Неверные учетные данные'])->withInput();
    }

    public function showRegister()
    {
        if ($this->isAuthenticated()) {
            return redirect('/');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (User::emailExists($request->email)) {
            return back()->withErrors(['email' => 'Пользователь с таким email уже существует'])->withInput();
        }

        $user = User::createUser($request->name, $request->email, $request->password);

        if ($user) {
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            Session::put('user_email', $user->email);

            return redirect('/')->with('success', 'Регистрация прошла успешно! Добро пожаловать!');
        }

        return back()->withErrors(['error' => 'Ошибка при регистрации'])->withInput();
    }

    public function logout()
    {
        Session::flush();

        Cookie::queue(Cookie::forget('remember_user'));

        return redirect('/login')->with('success', 'Вы успешно вышли из системы');
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

    public static function getCurrentUser()
    {
        if (Session::has('user_id')) {
            return User::getUserById(Session::get('user_id'));
        }
        return null;
    }
}

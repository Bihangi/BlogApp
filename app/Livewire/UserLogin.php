<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserLogin extends Component
{

    public $email, $password;

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Make HTTP request to beackend API
        $response = Http::post('/api/login', [
            'email' => $this->email,
            'password' => $this->password,
            'user_type' => 'user',
        ]);

        if ($response->successful()){
            //Handle successful login
            session(['suer_token' => $response->json()['token']]);
            session() -> flash('message', 'User Login successful');
            return redirect()->route('user.dashboard');
        } else{
            //Handle failed login
            session()->flash('error', 'Invalid login credentials');
        }
    }   
    public function render()
    {
        return view('livewire.user-login')
            ->layout('layouts.app');
    }
}

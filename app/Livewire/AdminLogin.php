<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AdminLogin extends Component
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
            'user_type' => 'admin',
        ]);

        if ($response->successful()){
            //Handle successful login
            session(['user_token' => $response->json()['token']]);
            session() -> flash('message', 'Admin Login successful');
            return redirect()->route('admin.dashboard');
        } else{
            //Handle failed login
            session()->flash('error', 'Invalid login credentials');
        }
    }  

    public function render()
    {
        return view('livewire.admin-login')
            ->layout('layouts.app');
    }
}

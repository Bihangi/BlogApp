<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AdminDashboard extends Component
{

    public $users;

    public function mount()
    {
        //Fetch users from backend API
        $response = Http::withToken(session('api_token'))->get(config('app.api_url').'/api/users');
        $this->users = $response->ok() ? $response->json() : [];
    }
    
    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}

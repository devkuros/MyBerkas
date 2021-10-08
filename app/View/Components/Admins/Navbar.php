<?php

namespace App\View\Components\Admins;

use Illuminate\View\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $users = Auth::user();
        $roles = Role::get();
        return view('components.admins.navbar', compact('users', 'roles'));
    }
}

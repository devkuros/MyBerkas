<?php

namespace App\View\Components\Admins;

use Illuminate\View\Component;
use Spatie\Permission\Models\Role;

class TopBar extends Component
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
        $roles = Role::get();
        return view('components.admins.top-bar', compact('roles'));
    }
}

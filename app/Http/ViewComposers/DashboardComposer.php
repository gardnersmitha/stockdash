<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Users\Repository as UserRepository;
use App\Instance;

class DashboardComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $instances;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Instance $instance)
    {
        // Dependencies automatically resolved by service container...
        $this->instances = $instance->all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('instances', $this->instances);
    }
}
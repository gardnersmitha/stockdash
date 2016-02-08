<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Users\Repository as UserRepository;
use App\Instance;
use App\Symbol;

class DashboardComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $instances,$first;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Instance $instance,Symbol $symbol)
    {
        // Dependencies automatically resolved by service container...
        $this->instances = $instance->whereNull('action')->with('symbol')->orderBy('created_at', 'desc')->get();

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(['instances' => $this->instances]);
    }
}
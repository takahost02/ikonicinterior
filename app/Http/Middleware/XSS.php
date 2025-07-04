<?php

namespace App\Http\Middleware;

use App\Models\Utility;
use Closure;

class XSS
{
    use \RachidLaasri\LaravelInstaller\Helpers\MigrationsHelper;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::check())
        {
            \App::setLocale(\Auth::user()->lang);

            if(\Auth::user()->type == 'company')
            {
                $migrations             = $this->getMigrations();
                $Modulemigrations = glob(base_path() . '/Modules/LandingPage/Database' . DIRECTORY_SEPARATOR . 'Migrations' . DIRECTORY_SEPARATOR . '*.php');
                $dbMigrations           = $this->getExecutedMigrations();
                $numberOfUpdatesPending = (count($migrations) + count($Modulemigrations)) - count($dbMigrations);
                
                if($numberOfUpdatesPending > 0)
                {

                    Utility::addNewData();

                    return redirect()->route('LaravelUpdater::welcome');
                }
            }
        }

        $input = $request->all();
        // array_walk_recursive(
        //     $input, function (&$input){
        //     $input = strip_tags($input);
        // }
        // );
        $request->merge($input);

        return $next($request);
    }
}

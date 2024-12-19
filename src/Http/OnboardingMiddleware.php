<?php

namespace Guava\Onboarding\Http;

use Closure;
use Filament\Facades\Filament;
use Guava\Onboarding\Filament\Scenario;
use Guava\Onboarding\OnboardingPlugin;
use Illuminate\Http\Request;

class OnboardingMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        /** @var OnboardingPlugin $plugin */
        $plugin = filament('guava-onboarding');

        if ($journey = collect($plugin->getJourneys())
            ->where(fn ($journey) => $journey::requiresCompletion())
            ->where(fn ($journey) => ! $journey::completed())
            ->first()) {

            $panel = Filament::getCurrentPanel();
            $routeName = $panel->generateRouteName($journey::getRelativeRouteName());
            //            dd($journey::getRelativeRouteName());
            if ($request->routeIs($routeName . '*')) {
                return $next($request);
            }

            //            $step = $scenario->getSteps()->first();

            //            $url = $journey::getUrl();
            $params = [];
            if ($tenant = Filament::getTenant()) {
                $params['tenant'] = $tenant;
            }
            $url = $panel->route($journey::getRelativeRouteName(), $params);

            return redirect($url);
        }

        /** @var Scenario $scenario */
        if ($scenario = $plugin->getCachedScenarios()
            ->whereRequiresCompletion()
            ->whereNotCompleted()
            ->first()) {
            if ($request->routeIs($scenario->getRoute() . '*')) {
                return $next($request);
            }

            $step = $scenario->getSteps()->first();

            $url = $step::getUrl([
                'scenario' => $scenario,
            ]);

            return redirect($url);
        }

        return $next($request);
    }
}

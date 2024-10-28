<?php

namespace Guava\Onboarding\Http;

use Closure;
use Guava\Onboarding\Filament\Scenario;
use Guava\Onboarding\OnboardingPlugin;
use Illuminate\Http\Request;

class OnboardingMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        /** @var OnboardingPlugin $plugin */
        $plugin = filament('guava-onboarding');

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

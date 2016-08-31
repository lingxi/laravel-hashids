<?php

use Closure;
use Exception;

class DecodePublicIdMiddleware
{
    protected $routeParametersShouldDecode = [];

    protected $requestParametersShouldDecode = [];

    public function handle($request, Closure $next)
    {
        $this->init();

        if (config('hashids.middleware.open')) {
            try {
                $this->decodeRouteParameters();

                $this->decodeRequestParameters();
            } catch (Exception $e) {
                abort(404);
            }
        }

        return $next($request);
    }

    protected function init()
    {
        $this->routeParametersShouldDecode = config('hashids.middleware.route_parameters');
        $this->requestParametersShouldDecode = config('hashids.middleware.request_parameters');

        if (method_exists($this, 'prepareConfig')) {
            $this->prepareConfig();
        }
    }

    protected function decodeRouteParameters()
    {
        if ($route = $request->route()) {
            $parameters = $route->parameters();

            foreach ($this->routeParametersShouldDecode as $key) {
                if (isset($parameters[$key])) {
                    $route->setParameter($param, trueid($parameters[$key]));
                }
            }
        }
    }

    public function decodeRequestParameters()
    {
        if ($parameters = $request->all()) {
            foreach ($this->requestParametersShouldDecode as $key) {
                if (isset($parameters[$key])) {
                    $request->merge([$param => trueid($parameters[$key])]);
                }
            }
        }
    }
}

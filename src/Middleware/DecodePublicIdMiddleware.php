<?php

namespace Lingxi\Hashids\Middleware;

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
                $this->decodeRouteParameters($request);

                $this->decodeRequestParameters($request);
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

    protected function decodeRouteParameters($request)
    {
        if ($route = $request->route()) {
            $parameters = $route->parameters();

            foreach ($this->routeParametersShouldDecode as $key) {
                if (isset($parameters[$key])) {
                    $route->setParameter($key, trueId($parameters[$key]));
                }
            }
        }
    }

    public function decodeRequestParameters($request)
    {
        if ($parameters = $request->all()) {
            foreach ($this->requestParametersShouldDecode as $key) {
                if (isset($parameters[$key])) {
                    $request->merge([$key => trueId($parameters[$key])]);
                }
            }
        }
    }
}

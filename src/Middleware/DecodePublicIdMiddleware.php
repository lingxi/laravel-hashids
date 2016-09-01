<?php

namespace Lingxi\Hashids\Middleware;

use Closure;

class DecodePublicIdMiddleware
{
    protected $routeParametersShouldDecode = [];

    protected $requestParametersShouldDecode = [];

    public function handle($request, Closure $next)
    {
        if ($this->canDecode()) {
            $this->init()
                 ->decodeRouteParameters($request)
                 ->decodeRequestParameters($request);
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

        return $this;
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

        return $this;
    }

    protected function decodeRequestParameters($request)
    {
        if ($parameters = $request->all()) {
            foreach ($this->requestParametersShouldDecode as $key) {
                if (isset($parameters[$key])) {
                    $request->merge([$key => trueId($parameters[$key])]);
                }
            }
        }

        return $this;
    }

    protected function canDecode()
    {
        return config('hashids.middleware.open');
    }
}

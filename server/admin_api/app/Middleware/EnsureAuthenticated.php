<?php

namespace Middleware;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class EnsureAuthenticated {

  public function __invoke(Request $request, Response $response, callable $next)
  {
    return $next($request, $response);
  }
  
}

?>
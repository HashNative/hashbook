<?php

namespace Illuminate\Contracts\Routing;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use SplFileInfo;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface ResponseFactory
{
    /**
     * Return a new response from the application.
     *
     * @param  string  $content
     * @param  int  $status
     * @param  array  $headers
     * @return Response
     */
    public function make($content = '', $status = 200, array $headers = []);

    /**
     * Return a new view response from the application.
     *
     * @param  string  $view
     * @param  array  $data
     * @param  int  $status
     * @param  array  $headers
     * @return Response
     */
    public function view($view, $data = [], $status = 200, array $headers = []);

    /**
     * Return a new JSON response from the application.
     *
     * @param  string|array  $data
     * @param  int  $status
     * @param  array  $headers
     * @param  int  $options
     * @return JsonResponse
     */
    public function json($data = [], $status = 200, array $headers = [], $options = 0);

    /**
     * Return a new JSONP response from the application.
     *
     * @param  string  $callback
     * @param  string|array  $data
     * @param  int  $status
     * @param  array  $headers
     * @param  int  $options
     * @return JsonResponse
     */
    public function jsonp($callback, $data = [], $status = 200, array $headers = [], $options = 0);

    /**
     * Return a new streamed response from the application.
     *
     * @param  Closure  $callback
     * @param  int  $status
     * @param  array  $headers
     * @return StreamedResponse
     */
    public function stream($callback, $status = 200, array $headers = []);

    /**
     * Create a new file download response.
     *
     * @param  SplFileInfo|string  $file
     * @param  string  $name
     * @param  array  $headers
     * @param  string|null  $disposition
     * @return BinaryFileResponse
     */
    public function download($file, $name = null, array $headers = [], $disposition = 'attachment');

    /**
     * Create a new redirect response to the given path.
     *
     * @param  string  $path
     * @param  int  $status
     * @param  array  $headers
     * @param  bool|null  $secure
     * @return RedirectResponse
     */
    public function redirectTo($path, $status = 302, $headers = [], $secure = null);

    /**
     * Create a new redirect response to a named route.
     *
     * @param  string  $route
     * @param  array  $parameters
     * @param  int  $status
     * @param  array  $headers
     * @return RedirectResponse
     */
    public function redirectToRoute($route, $parameters = [], $status = 302, $headers = []);

    /**
     * Create a new redirect response to a controller action.
     *
     * @param  string  $action
     * @param  array  $parameters
     * @param  int  $status
     * @param  array  $headers
     * @return RedirectResponse
     */
    public function redirectToAction($action, $parameters = [], $status = 302, $headers = []);

    /**
     * Create a new redirect response, while putting the current URL in the session.
     *
     * @param  string  $path
     * @param  int  $status
     * @param  array  $headers
     * @param  bool|null  $secure
     * @return RedirectResponse
     */
    public function redirectGuest($path, $status = 302, $headers = [], $secure = null);

    /**
     * Create a new redirect response to the previously intended location.
     *
     * @param  string  $default
     * @param  int  $status
     * @param  array  $headers
     * @param  bool|null  $secure
     * @return RedirectResponse
     */
    public function redirectToIntended($default = '/', $status = 302, $headers = [], $secure = null);
}

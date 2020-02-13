<?php

namespace Dingo\Api\Http\Response\Format;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class Format
{
    /**
     * Illuminate request instance.
     *
     * @var Request
     */
    protected $request;

    /**
     * Illuminate response instance.
     *
     * @var Response
     */
    protected $response;

    /**
     * Set the request instance.
     *
     * @param Request $request
     *
     * @return Format
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Set the response instance.
     *
     * @param Response $response
     *
     * @return Format
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Format an Eloquent model.
     *
     * @param Model $model
     *
     * @return string
     */
    abstract public function formatEloquentModel($model);

    /**
     * Format an Eloquent collection.
     *
     * @param Collection $collection
     *
     * @return string
     */
    abstract public function formatEloquentCollection($collection);

    /**
     * Format an array or instance implementing Arrayable.
     *
     * @param array|Arrayable $content
     *
     * @return string
     */
    abstract public function formatArray($content);

    /**
     * Get the response content type.
     *
     * @return string
     */
    abstract public function getContentType();
}

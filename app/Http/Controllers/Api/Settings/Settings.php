<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Setting\Setting as Request;
use App\Models\Setting\Setting;
use App\Transformers\Setting\Setting as Transformer;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;

class Settings extends ApiController
{
    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $settings = Setting::all();

        return $this->response->collection($settings, new Transformer());
    }

    /**
     * Display the specified resource.
     *
     * @param  int|string  $id
     * @return Response
     */
    public function show($id)
    {
        // Check if we're querying by id or key
        if (is_numeric($id)) {
            $setting = Setting::find($id);
        } else {
            $setting = Setting::where('key', $id)->first();
        }

        return $this->response->item($setting, new Transformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $setting = Setting::create($request->all());

        return $this->response->created(url('api/settings/'.$setting->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $setting
     * @param  $request
     * @return Response
     */
    public function update(Setting $setting, Request $request)
    {
        $setting->update($request->all());

        return $this->response->item($setting->fresh(), new Transformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Setting  $setting
     * @return Response
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return $this->response->noContent();
    }
}

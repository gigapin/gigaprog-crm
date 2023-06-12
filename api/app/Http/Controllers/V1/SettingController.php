<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\SettingRequest;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class SettingController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(Setting $setting): JsonResource
    {
        $this->authorize('viewAny', $setting);
        return SettingResource::collection(Setting::all());
    }

    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(SettingRequest $request, Setting $setting): SettingResource
    {
        $this->authorize('create', $setting);
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        return new SettingResource(Setting::create($data));
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Setting $setting): SettingResource|JsonResponse
    {
        $this->authorize('view', $setting);
        return new SettingResource($setting);
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(SettingRequest $request, Setting $setting): SettingResource
    {
        $this->authorize('update', $setting);
        $setting->update($request->validated());
        return new SettingResource($setting);
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     * @return JsonResponse
     */
    public function destroy(Setting $setting): JsonResponse
    {
        $this->authorize('delete', $setting);
        $setting->delete();
        return $this->message('Setting deleted successfully');
    }
}

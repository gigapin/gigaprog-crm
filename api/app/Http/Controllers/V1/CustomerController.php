<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\SettingRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerShowResource;
use App\Models\Customer;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResource
     * @throws AuthorizationException
     */
    public function index(): JsonResource
    {
        $this->authorize('viewAny', User::class);

        return CustomerResource::collection(Customer::withTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     * @param CustomerRequest $request
     * @param SettingRequest $settingRequest
     * @return CustomerResource
     * @throws AuthorizationException
     */
    public function store(
        CustomerRequest $request,
        SettingRequest $settingRequest
    ): CustomerResource
    {
        $this->authorize('create', User::class);
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $setting_data = $settingRequest->validated();

        if (count($setting_data) > 0) {
            $setting_data['user_id'] = Auth::user()->id;
            $setting = Setting::create($setting_data);
            $data['setting_id'] = $setting->id;
        }

        return new CustomerResource(Customer::create($data));
    }

    /**
     * Display the specified resource.
     * @param Customer $customer
     * @return CustomerShowResource
     * @throws AuthorizationException
     */
    public function show(Customer $customer): CustomerShowResource
    {
        $this->authorize('view', $customer);
        return new CustomerShowResource($customer);
    }

    /**
     * Update the specified resource in storage.
     * @param CustomerRequest $request
     * @param SettingRequest $settingRequest
     * @param Customer $customer
     * @return CustomerResource
     * @throws AuthorizationException
     */
    public function update(
        CustomerRequest $request,
        SettingRequest $settingRequest,
        Customer $customer
    ): CustomerResource
    {
        $this->authorize('update', $customer);
        $customer->update($request->validated());
        $setting = Setting::findOrFail($customer->setting_id);
        $setting->update($settingRequest->validated());
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     * @param Customer $customer
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Customer $customer): JsonResponse
    {
        $this->authorize('delete', User::class);
        $setting = Setting::findOrFail($customer->setting_id);
        $setting->delete();
        $customer->delete();
        return response()->json([
            'message' => 'Resource deleted successfully'
        ]);
    }

    /**
     * Display resource soft deleted.
     * @param int $id
     * @param Customer $customer
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function indexTrashed(int $id, Customer $customer): JsonResponse
    {
        $this->authorize('view', $customer);
        $get_customer = Customer::onlyTrashed()->where('id', $id)->first();
        return response()->json([
            'customer' => $get_customer,
            'setting' => Setting::onlyTrashed()->where('id', $get_customer->setting_id)->first()
        ]);
    }

    /**
     * Delete permanently a specific resource.
     * @param int $id
     * @param Customer $customer
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function forceDestroy(int $id, Customer $customer): JsonResponse
    {
        $this->authorize('forceDelete', $customer);
        $get_customer = Customer::onlyTrashed()->find($id);
        return response()->json([
            'data' => $get_customer->forceDelete(),
            'setting' => Setting::onlyTrashed()->find($get_customer->setting_id)->forceDelete(),
            'message' => 'Resource permanently deleted'
        ]);
    }

    /**
     * Restore a resource soft deleted.
     * @param Customer $customer
     * @param int $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore(int $id, Customer $customer): JsonResponse
    {
        $this->authorize('restore', $customer);
        $get_customer = Customer::onlyTrashed()->find($id);
        return response()->json([
            'data' => $get_customer->restore(),
            'setting' => Setting::onlyTrashed()->find($get_customer->setting_id)->restore(),
            'message' => 'Resource restored successfully'
        ]);
    }
}

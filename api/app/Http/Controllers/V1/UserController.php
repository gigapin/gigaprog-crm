<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): JsonResource
    {
        $this->authorize('viewAny', User::class);
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     * @return UserResource
     * @throws AuthorizationException
     */
    public function store(UserRequest $request, User $user): UserResource
    {
        $this->authorize('create', $user);
        $request->validated($request->all());
        $data = User::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        RoleUser::create([
            'user_id' => $data->id,
            'role_id' => $request->role_id
        ]);

        return new UserResource($data);
    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return UserResource
     * @throws AuthorizationException
     */
    public function show(User $user): UserResource
    {
        $this->authorize('view', $user);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @param User $user
     * @param UserRequest $request
     * @return UserResource
     * @throws AuthorizationException
     */
    public function update(User $user, UserRequest $request): UserResource
    {
        $this->authorize('update', $user);
        $user->update($request->validated());
        $role_user = new RoleUser();
        $role_user->update([
            'role_id' => $request->role_id,
            'user_id' => $user->id
        ]);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return ResponseFactory|Response
     * @throws AuthorizationException
     */
    public function destroy(User $user): ResponseFactory|Response
    {
        $this->authorize('delete', $user);
        $user->delete();
        return response(null, 204);
    }
}

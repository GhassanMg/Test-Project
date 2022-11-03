<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Role\AddRoleRequest;
use App\Models\Role;
use Exception;

class RoleController extends Controller
{
    public function add_new_role(AddRoleRequest $request)
    {
        try {
            Role::create([
                'name' => $request->name,
            ]);

            return $this->sendResponse('Role Added Successfully', []);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}

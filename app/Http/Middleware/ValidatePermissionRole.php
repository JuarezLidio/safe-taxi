<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ValidatePermissionRole
{
    // Some global variables are initialized.
    private $permission, $idParent = 1;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the name of the route in a variable.
        $routeName = $request->route()->getName();

        // Divide the route name in a variable.
        $routeParts = explode('.', $routeName);

        // Obtain all the permissions and save it in a variable.
        $permissionCollection = Permission::all();

        // Get the user with his role.
        $userRole = Role::where('id', Auth::user()->id_role)->first();

        // Predefine the redirect variable that contains the modal view in case of authentication failures.
        $modalData = Inertia::render('Auth/AccessDenied');

        // Condition that the user contains a role and is valid within our collection of roles.
        if($userRole !== null)
        {
            // The route is evaluated part by part where the user wants to be redirected.
            foreach ($routeParts as $index => $part)
            {
                // PART 1
                // The values of the route are evaluated.
                // This part of the route must match the alias of the permission collection that has a parent_id to the previous route evaluated.
                $this->permission = $permissionCollection->where('alias', $part)->where('id_parent', $this->idParent)->first();

                // PART 2
                // If the permission is not found or does not exist.
                if (!$this->permission)
                {
                    // The user is redirected to an access denied modal page with error code 403.
                    return $modalData->toResponse($request)->setStatusCode(403);
                }
                // In case the permit exists.
                else
                {
                    // Initialize a try to handle existing errors.
                    try
                    {
                        // A search is performed through the user's role to find the permission in the roles-permissions table.
                        $userRolePermission = $userRole->permissions()->where('permission_id', $this->permission->id)->first()->pivot;
                    }
                    // Catch the error when the permission is not found in the pivot table.
                    catch (\Exception $e)
                    {
                        // The user is redirected to an access denied modal page with error code 403.
                        return $modalData->toResponse($request)->setStatusCode(403);
                    }
                    // PART 3
                    // If the user exists with the role and permission.
                    if($userRolePermission)
                    {
                        // We store the permission id as the new parent id.
                        $this->idParent = $this->permission->id;
                    }
                    // In case the user with the role and permission does not exist.
                    else
                    {
                        // The user is redirected to an access denied modal page with error code 403.
                        return $modalData->toResponse($request)->setStatusCode(403);
                    }
                }
            }
        }
        // If the user does not have a role.
        else
        {
            // The user is redirected to an access denied modal page with error code 403.
            return $modalData->toResponse($request)->setStatusCode(403);
        }

        return $next($request);
    }
}

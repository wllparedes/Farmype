<?php

namespace App\Services;

use App\Models\{User};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class UserService
{
    public function update(Request $request, User $user)
    {
        $data = normalizeInputStatus($request->all());

        $data['password'] = $data['password'] == NULL ? $user->password : Hash::make($data['password']);

        if ($user->update($data)){
            return true;
        }

        throw new Exception(config('parameters.exception_message'));

    }
}

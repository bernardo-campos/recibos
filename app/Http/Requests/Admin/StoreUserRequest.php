<?php

namespace App\Http\Requests\Admin;

use App\Constants\RoleType;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole(RoleType::ADMIN);
    }

    public function prepareForValidation()
    {
        if (!$this->route('user') || $this->set_default_password) {
            $this->merge([
                'password' => bcrypt($this->dni),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user = $this->route('user');

        return [
            'name' => 'required|string|max:120',
            'roles' => 'array',
            'roles.*' => 'exists:' . Role::class . ',id',
            'email' => 'required|email|unique:users,email,'.$this->route('user')?->id ?? 0,
            'dni' => 'required|numeric|unique:users,dni,'.$user?->id ?? 0,
        ];
    }
}

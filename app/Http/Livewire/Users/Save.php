<?php

namespace App\Http\Livewire\Users;

use Bastinald\LaravelBootstrapComponents\Traits\WithModel;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Save extends Component
{
    use WithModel;

    public $user;

    public function mount(User $user = null)
    {
        $this->user = $user;

        $this->setModel($user);
    }

    public function render()
    {
        return view('users.save');
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
            'password' => [!$this->user->exists ? 'required' : 'nullable', 'confirmed'],
        ];
    }

    public function save()
    {
        $this->validateModel();

        $this->user->fill($this->model()->except('password_confirmation')->toArray())->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'User saved!']);
        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}

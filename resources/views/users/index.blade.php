@section('title', __('Users'))

<div class="container my-3">
    <h1>
        @yield('title')
    </h1>

    <div class="row justify-content-between">
        <div class="col-lg-auto mb-3">
            <x-bs::input icon="search" :placeholder="__('Search')" type="search" model="search" debounce="500"/>
        </div>
        <div class="col-lg-auto d-flex gap-2 mb-3">
            <x-bs::button icon="plus" :title="__('Create')" click="$emit('showModal', 'users.save')"/>

            <x-bs::dropdown icon="sort" :label="__($sort)" :title="__('Sort')">
                @foreach($sorts as $sort)
                    <x-bs::dropdown-item :label="__($sort)" click="$set('sort', '{{ $sort }}')"/>
                @endforeach
            </x-bs::dropdown>

            <x-bs::dropdown icon="filter" :label="__($filter)" :title="__('Filter')">
                @foreach($filters as $filter)
                    <x-bs::dropdown-item :label="__($filter)" click="$set('filter', '{{ $filter }}')"/>
                @endforeach
            </x-bs::dropdown>
        </div>
    </div>

    <div class="list-group mb-3">
        @forelse($users as $user)
            <div class="list-group-item list-group-item-action">
                <div class="row align-items-center">
                    <div class="col-lg mb-3 mb-lg-0">
                        <x-bs::link :label="$user->name"
                            click="$emit('showModal', 'users.read', {{ $user->id }})"/>

                        <p class="small text-muted mb-0">@displayDate($user->created_at)</p>
                    </div>
                    <div class="col-lg-auto d-flex gap-2">
                        <x-bs::dropdown-start icon="bolt">
                            <x-bs::dropdown-item :label="__('Read')" click="$emit('showModal', 'users.read', {{ $user->id }})"/>
                            <x-bs::dropdown-item :label="__('Update')"  click="$emit('showModal', 'users.save', {{ $user->id }})"/>
                            <x-bs::dropdown-item :label="__('Password')" click="$emit('showModal', 'users.password', {{ $user->id }})"/>
                            <x-bs::dropdown-item :label="__('Delete')"  click="delete({{ $user->id }})" confirm/>
                        </x-bs::dropdown-start>

                    </div>
                </div>
            </div>
        @empty
            <div class="list-group-item">
                {{ __('No results to display.') }}
            </div>
        @endforelse
    </div>

    <x-bs::pagination :links="$users"/>
</div>

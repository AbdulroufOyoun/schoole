<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div>
        @if (session()->has('message'))
        <div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert" aria-hidden="true">×</button> {{ session('message') }}</div>
        @endif
    </div>
    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <div class="card-body">
            <h4 class="mb-4 font-weight-bold">@lang('user.editor') @lang('user.account')</h4>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label mb-0 mt-2">@lang('user.fist_name')</label>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.fist_name')"
                                       wire:model="name">
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                <span class="text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label mb-0 mt-2">@lang('user.last_name')</label>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.last_name')"
                                       wire:model="last_name">
                                @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
                                <span class="text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label mb-0 mt-2">@lang('user.phone')</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="@lang('user.phone')" wire:model="phone">
                        @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label mb-0 mt-2">@lang('user.email')</label>
                    </div>
                    <div class="col-md-9">
                        <input type="email" class="form-control" placeholder="@lang('user.email')" wire:model="email">
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">@lang('user.gender')</label>
                    </div>
                    <div class="col-md-9">
                        <div class="custom-controls-stacked d-md-flex">
                            <label class="custom-control custom-radio mr-4">
                                <input type="radio" class="custom-control-input" name="example-radios4" value="1"
                                       wire:model="gender">
                                <span class="custom-control-label">@lang('user.male')</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="example-radios4" value="2"
                                       wire:model="gender">
                                <span class="custom-control-label">@lang('user.female')</span>
                            </label>
                        </div>
                        @error('gender') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <h4 class="mb-5 mt-7 font-weight-bold">@lang('user.account_login')</h4>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label mb-0 mt-2">@lang('user.username')</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="@lang('user.username')" wire:model="UserName">
                        @error('UserName') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label mb-0 mt-2">@lang('user.password')</label>
                    </div>
                    <div class="col-md-9">
                        <input type="password" class="form-control" placeholder="@lang('user.password')" wire:model="password">
                        @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <input type="hidden" value="5" name="role_id">
                </div>
            </div>
            <div class="form-group" wire:ignore>
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label mb-0 mt-2">@lang('user.account_permission')</label>
                    </div>
                    <div class="col-md-9">
                        <select class="form-control custom-select mySelect2 select-width" data-pharaonic="select2"
                            data-component-id="{{ $this->id }}" wire:model="roles_selected"
                            data-placeholder="@lang('button.select')" multiple>
                            <option></option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" wire:key={{ $role->id }}>
                                {{$role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-left">
            <button type="submit" class="btn btn-primary">@lang('button.save')</button>
        </div>
    </form>

    {{-- The Master doesn't talk, he acts. --}}

</div>

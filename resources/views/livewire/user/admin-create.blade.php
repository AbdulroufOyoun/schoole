<div>
    {{-- Stop trying to control. --}}
    <div>
        @if (session()->has('message'))
        <div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert"
                aria-hidden="true">×</button> {{ session('message') }}</div>
        @endif
    </div>

    <form wire:submit.prevent="submit" enctype="multipart/form-data">

        <div class="card-body">

            <h4 class="mb-4 font-weight-bold">@lang('user.admin') @lang('user.account')</h4>
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
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-label mb-0 mt-2">@lang('user.upload_photo')</div>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group file-browser">
                            <input type="text" class="form-control border-right-0 browse-file" placeholder="@lang('user.choose')"
                                readonly="">
                            <label class="input-group-append mb-0">
                                <span class="btn ripple btn-primary">
                                    @lang('user.browse') <input type="file" class="file-browserinput" style="display: none;"
                                        wire:model="image">
                                </span>
                            </label>
                        </div>
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
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
                        @error('UserName') <span class="text-danger">{{ $message }}</span> @enderror
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
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
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
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <input type="hidden" value="4" name="role_id">

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
                        @error('roles_selected') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-left">
            <button type="submit" class="btn btn-primary">@lang('button.save')</button>
        </div>
    </form>

    {{-- The best athlete wants his opponent at his best. --}}
</div>

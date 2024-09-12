<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                <button class="close" data-dismiss="alert"
                        aria-hidden="true">×
                </button> {{ session('message') }}</div>
        @endif
    </div>


    <!-- Row -->
    <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
        <div class="tab-content">
            {{-- ----------- start user section ---------- --}}

            <div class="tab-pane active" id="tab5">
                <form wire:submit.prevent="submit" enctype="multipart/form-data">

                    <div class="card-body">
                        <h4 class="mb-4 font-weight-bold">@lang('user.student') @lang('user.account')</h4>
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
                                    <label class="form-label mb-0 mt-2">@lang('user.father_name')</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.father_name')"
                                                   wire:model="father_name">
                                            @error('father_name') <span class="text-danger">{{ $message }}</span>@enderror
                                            <span class="text-muted"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.mother_name')</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control mb-md-0 mb-5" placeholder="@lang('user.mother_name')"
                                                   wire:model="mother_name">
                                            @error('mother_name') <span class="text-danger">{{ $message }}</span>@enderror
                                            <span class="text-muted"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.parent_username')</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control custom-select mySelect2" data-pharaonic="select2"
                                            data-component-id="{{ $this->id }}" wire:model="parent"
                                            data-placeholder="@lang('button.select')">
                                        <option></option>
                                        @foreach ($parents as $parentt)
                                            <option value="{{ $parentt->id }}" wire:key="{{ $parentt->id }}">{{
                                            $parentt->UserName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="margin-left: 26%">
                                    @error('parent') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.classroom') </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control custom-select mySelect2" data-pharaonic="select2"
                                            data-component-id="{{ $this->id }}" wire:model="classroom"
                                            data-placeholder="@lang('button.select')">
                                        <option></option>
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}" wire:key="{{ $classroom->id }}">
                                                {{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="margin-left: 26%">
                                    @error('classroom') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.section') </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control custom-select mySelect2" data-pharaonic="select2"
                                            data-component-id="{{ $this->id }}" wire:model="section"
                                            data-placeholder="@lang('button.select')">
                                        <option label="Select"></option>
                                        @if ($sections)
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">
                                                    {{ $section->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div style="margin-left: 26%">
                                    @error('section') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.phone')</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="@lang('user.phone')"
                                           wire:model="phone">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
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
                                    <label class="form-label mb-0 mt-2">@lang('user.date_of_birth')</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" class="form-control fc-datepicker" wire:model="date_of_birth">
                                    @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
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
                                            <input type="radio" class="custom-control-input" wire:model="gender"
                                                   value="1">
                                            <span class="custom-control-label">@lang('user.male')</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" wire:model="gender"
                                                   value="2">
                                            <span class="custom-control-label">@lang('user.female')</span>
                                        </label>
                                    </div>
                                    @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.languages')</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="@lang('user.languages')"
                                           wire:model="languages">
                                    @error('languages') <span class="text-danger">{{ $message }}</span> @enderror
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
                                        <input type="text" class="form-control border-right-0 browse-file"
                                               placeholder="@lang('user.choose')" readonly="" wire:model="image_name">
                                        <label class="input-group-append mb-0">
                                            <span class="btn ripple btn-primary">
                                                @lang('user.browse') <input type="file" class="file-browserinput"
                                                              style="display: none;" wire:model="image">
                                            </span>
                                        </label>
                                    </div>
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                    <input type="text" class="form-control" placeholder="@lang('user.username')"
                                           wire:model="UserName">
                                    @error('UserName') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.password')</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" placeholder="@lang('user.password')"
                                           wire:model="password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <input type="hidden" wire:model="role_id" value="1">
                                @error('role_id') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>
                        </div>
                        <div class="form-group" wire:ignore>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">@lang('user.account_permission') </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control custom-select mySelect2" data-pharaonic="select2"
                                            data-component-id="{{ $this->id }}" wire:model="roles_selected"
                                            data-placeholder="@lang('button.select')" multiple>
                                        <option label="Select"></option>
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

            </div>


            {{-- ----------- end user section ---------- --}}
            {{-- ----------- start teacher section ---------- --}}
            <div class="tab-pane" id="tab6">

                @livewire('user.teacher-create')

            </div>

            {{-- ----------- end teacher section ---------- --}}
            {{-- ----------- start editor section ---------- --}}

            <div class="tab-pane" id="tab7">
                @livewire('user.editor-create')
            </div>
            {{-- ----------- end editor section ---------- --}}
            {{-- ----------- start guardian section ---------- --}}

            <div class="tab-pane" id="tab8">
                @livewire('user.parent-create')
            </div>
            {{-- ----------- end parent section ---------- --}}
            {{-- ----------- start academic section ---------- --}}

            <div class="tab-pane" id="tab88">
                @livewire('user.accountant-create')
            </div>
            {{-- ----------- end academic section ---------- --}}
            {{-- ----------- start academic section ---------- --}}

            <div class="tab-pane" id="tab9">
                @livewire('user.academic-create')
            </div>
            {{-- ----------- end academic section ---------- --}}



{{--             ----------- start admin section ---------- --}}

{{--            <div class="tab-pane" id="tab99">--}}
{{--                @livewire('user.admin-create')--}}
{{--            </div>--}}
{{--             ----------- end admin section ---------- --}}


        </div>
    </div>
    <!-- End Row-->


    <div wire:loading>
        @if ($scrollToTop)
            <script>
                window.scrollTo(0, 0); // Scroll to the top of the page
                {{ $scrollToTop = false }} // Reset the scrollToTop property
                $('.mySelect2').val(null).trigger('change');
            </script>
        @endif
    </div>
    @push('js')
        <script>
            $(document).ready(function () {

                $('.mySelect2').select2();

                window.livewire.on('data-change-event', () => {
                    $('.mySelect2').select2();

                });


            });

        </script>
    @endpush

    {{--------------- end live wire component --}}
</div>

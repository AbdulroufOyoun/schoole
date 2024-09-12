@extends('layouts.admin_panel.main')
@section('header')
    @lang('payment.parents_payments')
@endsection

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button class="close" data-dismiss="alert"
                        aria-hidden="true">×
                </button> {{ session('success') }}</div>
        @endif
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table id="details-datatable"
                       class="table table-striped card-table table-vcenter text-nowrap mb-0 table-style">
                    <thead>
                    <tr>
                        <th>*</th>
                        <th>@lang('payment.parent')</th>
                        <th>@lang('payment.number_of_sons')</th>
                        <th>@lang('payment.total_fees')</th>
                        <th>@lang('payment.total_payments')</th>
                        <th>@lang('payment.next_batch')</th>
                        <th>@lang('payment.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach ($parents as $parent)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $parent['parent_name'] }}</td>
                            <td>{{ $parent['number_of_sons'] }}</td>
                            <td>{{ $parent['total_fees'] }}</td>
                            <td>{{ $parent['total_payments'] }}</td>
                            <td>{{ $parent['next_batch'] }}</td>
                            <td>
                                <div>
                                    <a class="btn btn-primary" href="{{route('payment.get-parent-payments-details',$parent['parent_id'])}}">
                                        @lang('button.details')</a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- bd -->
        </div><!-- bd -->
    </div><!-- bd -->


@endsection

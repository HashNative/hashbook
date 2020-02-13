@extends('layouts.admin')

@section('title', trans_choice('general.payments', 2))

@section('new_button')
@permission('create-expenses-payments')
<span class="new-button"><a href="{{ url('expenses/payments/create') }}" class="btn btn-danger btn-sm"><span class="fa fa-plus"></span> &nbsp;{{ trans('general.add_new') }}</a></span>
<span><a href="{{ url('common/import/expenses/payments') }}" class="btn btn-default btn-sm"><span class="fa fa-download"></span> &nbsp;{{ trans('import.import') }}</a></span>
@endpermission
<span><a href="{{ route('payments.export', request()->input()) }}" class="btn btn-default btn-sm"><span class="fa fa-upload"></span> &nbsp;{{ trans('general.export') }}</a></span>
@endsection

@section('content')
<!-- Default box -->
<div class="box box-success">
    <div class="box-header with-border">
        {!! Form::open(['url' => 'expenses/payments', 'role' => 'form', 'method' => 'GET']) !!}
        <div id="items" class="pull-left box-filter">
            <span class="title-filter hidden-xs">{{ trans('general.search') }}:</span>
            {!! Form::text('search', request('search'), ['class' => 'form-control input-filter input-sm', 'placeholder' => trans('general.search_placeholder')]) !!}
            {!! Form::dateRange('date', trans('general.date'), 'calendar', []) !!}
            {!! Form::select('vendors[]', $vendors, request('vendors'), ['id' => 'filter-vendors', 'class' => 'form-control input-filter input-lg', 'multiple' => 'multiple']) !!}
            {!! Form::select('categories[]', $categories, request('categories'), ['id' => 'filter-categories', 'class' => 'form-control input-filter input-lg', 'multiple' => 'multiple']) !!}
            {!! Form::select('accounts[]', $accounts, request('accounts'), ['id' => 'filter-accounts', 'class' => 'form-control input-filter input-lg', 'multiple' => 'multiple']) !!}
            {!! Form::button('<span class="fa fa-filter"></span> &nbsp;' . trans('general.filter'), ['type' => 'submit', 'class' => 'btn btn-sm btn-default btn-filter']) !!}
        </div>
        <div class="pull-right">
            <span class="title-filter hidden-xs">{{ trans('general.show') }}:</span>
            {!! Form::select('limit', $limits, request('limit', setting('general.list_limit', '25')), ['class' => 'form-control input-filter input-sm', 'onchange' => 'this.form.submit()']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="box-body">
        <div class="table table-responsive">
            <table class="table table-striped table-hover" id="tbl-payments">
                <thead>
                    <tr>
                        <th class="col-md-2">@sortablelink('paid_at', trans('general.date'))</th>
                        <th class="col-md-2 text-right amount-space">@sortablelink('amount', trans('general.amount'))</th>
                        <th class="col-md-3 hidden-xs">@sortablelink('vendor.name', trans_choice('general.vendors', 1))</th>
                        <th class="col-md-2 hidden-xs">@sortablelink('category.name', trans_choice('general.categories', 1))</th>
                        <th class="col-md-2 hidden-xs">@sortablelink('account.name', trans_choice('general.accounts', 1))</th>
                        <th class="col-md-1 text-center">{{ trans('general.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($payments as $item)
                    @php $is_transfer = ($item->category && ($item->category->id == $transfer_cat_id)); @endphp
                    <tr>
                        @if ($item->reconciled)
                        <td>{{ Date::parse($item->paid_at)->format($date_format) }}</td>
                        @else
                        <td><a href="{{ url('expenses/payments/' . $item->id . '/edit') }}">{{ Date::parse($item->paid_at)->format($date_format) }}</a></td>
                        @endif
                        <td class="text-right amount-space">@money($item->amount, $item->currency_code, true)</td>
                        <td class="hidden-xs">{{ !empty($item->vendor->name) ? $item->vendor->name : trans('general.na') }}</td>
                        <td class="hidden-xs">{{ $item->category ? $item->category->name : trans('general.na') }}</td>
                        <td class="hidden-xs">{{ $item->account ? $item->account->name : trans('general.na') }}</td>
                        <td class="text-center">
                            @if (!$is_transfer)
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-toggle-position="left" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if (!$item->reconciled)
                                    <li><a href="{{ url('expenses/payments/' . $item->id . '/edit') }}">{{ trans('general.edit') }}</a></li>
                                    <li class="divider"></li>
                                    @endif
                                    @permission('create-expenses-payments')
                                    <li><a href="{{ url('expenses/payments/' . $item->id . '/duplicate') }}">{{ trans('general.duplicate') }}</a></li>
                                    @endpermission
                                    @permission('delete-expenses-payments')
                                    @if (!$item->reconciled)
                                    <li class="divider"></li>
                                    <li>{!! Form::deleteLink($item, 'expenses/payments') !!}</li>
                                    @endif
                                    @endpermission
                                </ul>
                            </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        @include('partials.admin.pagination', ['items' => $payments, 'type' => 'payments'])
    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->
@endsection

@push('js')
<script src="{{ asset('vendor/almasaeed2010/adminlte/plugins/daterangepicker/moment.js') }}"></script>
<script src="{{ asset('vendor/almasaeed2010/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('vendor/almasaeed2010/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
@if (language()->getShortCode() != 'en')
<script src="{{ asset('vendor/almasaeed2010/adminlte/plugins/datepicker/locales/bootstrap-datepicker.' . language()->getShortCode() . '.js') }}"></script>
@endif
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/almasaeed2010/adminlte/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/almasaeed2010/adminlte/plugins/datepicker/datepicker3.css') }}">
@endpush

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#filter-categories").select2({
            placeholder: "{{ trans('general.form.select.field', ['field' => trans_choice('general.categories', 1)]) }}"
        });

        $("#filter-vendors").select2({
            placeholder: "{{ trans('general.form.select.field', ['field' => trans_choice('general.vendors', 1)]) }}"
        });

        $("#filter-accounts").select2({
            placeholder: "{{ trans('general.form.select.field', ['field' => trans_choice('general.accounts', 1)]) }}"
        });
    });
</script>
@endpush

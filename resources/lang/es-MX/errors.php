@extends('layouts.admin')

@section('title', trans_choice('Oops! Something went wrong.', git 2))

@section('content')


                <tbody>
                @foreach($transactions as $item)
                    <tr>
                        <td>{{ Date::parse($item->paid_at)->format($date_format) }}</td>
                        <td>{{ $item->account_name }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ $item->description }}</td>
                        <td class="text-right amount-space">@money($item->amount, $item->currency_code, true)</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
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
        $("#filter-accounts").select2({
            placeholder: "{{ trans('general.form.select.field', ['field' => trans_choice('general.accounts', 1)]) }}"
        });

        $("#filter-categories").select2({
            placeholder: "{{ trans('general.form.select.field', ['field' => trans_choice('general.categories', 1)]) }}"
        });
    });
</script>
@endpush



<?php

return [

    'forbidden_access' => 'Forbidden Access',
    'error_page'       => 'Error Page',
    'page_not_found'   => 'Page Not Found',

    'body'   => [
        'forbidden_access' => 'Oops! Forbidden Access.',
        'error_page' => 'Oops! Something went wrong.',
        'page_not_found' => 'Oops! Page not found.',
    ],

    'messages'   => [
        'forbidden_access' => 'You can not access this page.
        Meanwhile, you may <a href=":link">return to dashboard</a>.',
        'error_page' => 'We will work on fixing that right away.
        Meanwhile, you may <a href=":link">return to dashboard</a>.',
        'page_not_found' => 'We could not find the page you were looking for.
        Meanwhile, you may <a href=":link">return to dashboard</a>.',
    ],

];

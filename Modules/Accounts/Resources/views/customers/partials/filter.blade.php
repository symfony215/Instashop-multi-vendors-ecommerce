{{ BsForm::resource('accounts::customers')->get(url()->current()) }}
@component('dashboard::layouts.components.box')
    @slot('title', trans('accounts::customers.actions.filter'))

    <div class="row">
        <div class="col-md-3">
            {{ BsForm::text('name')->value(request('name')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('email')->value(request('email')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('phone')->value(request('phone')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('accounts::customers.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('accounts::customers.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}

<button
    type="button"
   id="filter-popover"
   class="btn btn-outline-dark btn-sm">
    <i class="fas fa fa-fw fa-filter"></i>
</button>

<div id="popover-content" class="d-none">
    {{ BsForm::resource('coupons::coupons')->get(url()->current()) }}
        {{ BsForm::text('name')->value(request('name')) }}
        {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('coupons::coupons.perPage')) }}

        <button type='submit' class='btn btn-primary btn-sm'>
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('coupons::coupons.actions.filter')
        </button>

    {{ BsForm::close() }}
</div>

@push('scripts')
    <script>
        $('#filter-popover').popover({
            html: true,
            container: 'body',
            content: function () {
                return $("#popover-content").html();
            },
            placement: 'bottom',
            sanitize: false,
        });
    </script>
@endpush

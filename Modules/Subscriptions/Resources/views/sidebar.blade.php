@component('dashboard::layouts.components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \Modules\Subscriptions\Entities\Subscription::class])
    @slot('url', 'subscriptions')
    @slot('name', trans('subscriptions::subscriptions.plural'))
    @slot('isActive', request()->routeIs('subscriptions*'))
    @slot('icon', 'fas fa-tags')
    @slot('tree', [
        [
            'name' => trans('subscriptions::subscriptions.actions.list'),
            'url' => route('dashboard.subscriptions.index'),
            'can' => ['ability' => 'viewAny', 'model' => \Modules\Subscriptions\Entities\Subscription::class],
            'isActive' => request()->routeIs('*subscriptions.index*'),
        ],
        [
            'name' => trans('subscriptions::subscriptions.actions.create'),
            'url' => route('dashboard.subscriptions.create'),
            'can' => ['ability' => 'create', 'model' =>  \Modules\Subscriptions\Entities\Subscription::class],
            'isActive' => request()->routeIs('*subscriptions.create'),
        ]
    ])
@endcomponent

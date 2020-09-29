<?php

Breadcrumbs::for('dashboard.offers.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('offers::offers.plural'), route('dashboard.offers.index'));
});

Breadcrumbs::for('dashboard.offers.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.offers.index');
    $breadcrumb->push(trans('offers::offers.actions.create'), route('dashboard.offers.create'));
});

Breadcrumbs::for('dashboard.offers.show', function ($breadcrumb, $offer) {
    $breadcrumb->parent('dashboard.offers.index');
    $breadcrumb->push($offer->name, route('dashboard.offers.show', $offer));
});

Breadcrumbs::for('dashboard.offers.edit', function ($breadcrumb, $offer) {
    $breadcrumb->parent('dashboard.offers.show', $offer);
    $breadcrumb->push(trans('offers::offers.actions.edit'), route('dashboard.offers.edit', $offer));
});

<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

//region Users

Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for("users.create", function ($trail) {
    $trail->parent('users.index');
    $trail->push('New User', route("users.create"));
});

Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push($user->name, route('users.show', $user->id));
});

Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users.show', $user);
    $trail->push(trans('buttons.edit'), route('users.edit', $user->id));
});

//endregion

//region Contract Types

Breadcrumbs::for('contractTypes.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Contract Types', route('contractTypes.index'));
});

Breadcrumbs::for("contractTypes.create", function ($trail) {
    $trail->parent('contractTypes.index');
    $trail->push('New Contract Type', route("contractTypes.create"));
});

Breadcrumbs::for('contractTypes.show', function ($trail, $contractType) {
    $trail->parent('contractTypes.index');
    $trail->push($contractType->code . ' - ' . $contractType->name, route('contractTypes.show', $contractType->id));
});

Breadcrumbs::for('contractTypes.edit', function ($trail, $contractType) {
    $trail->parent('contractTypes.show', $contractType);
    $trail->push(trans('buttons.edit'), route('contractTypes.edit', $contractType->id));
});

//endregion

//region Contracts

Breadcrumbs::for('contracts.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Contracts', route('contracts.index'));
});

Breadcrumbs::for("contracts.create", function ($trail) {
    $trail->parent('contracts.index');
    $trail->push('New Contract', route("contracts.create"));
});

Breadcrumbs::for('contracts.show', function ($trail, $contract) {
    $trail->parent('contracts.index');
    $trail->push($contract->user->name, route('contracts.show', $contract->id));
});

Breadcrumbs::for('contracts.edit', function ($trail, $contract) {
    $trail->parent('contracts.show', $contract);
    $trail->push(trans('buttons.edit'), route('contracts.edit', $contract->id));
});

//endregion

//region Contracts

Breadcrumbs::for('categories.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Categories', route('categories.index'));
});

Breadcrumbs::for("categories.create", function ($trail) {
    $trail->parent('categories.index');
    $trail->push('New Category', route("categories.create"));
});

Breadcrumbs::for('categories.show', function ($trail, $category) {
    $trail->parent('categories.index');
    $trail->push($category->name, route('categories.show', $category->id));
});

Breadcrumbs::for('categories.edit', function ($trail, $category) {
    $trail->parent('categories.show', $category);
    $trail->push(trans('buttons.edit'), route('categories.edit', $category->id));
});

//endregion

//region Clients

Breadcrumbs::for('clients.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Clients', route('clients.index'));
});

Breadcrumbs::for("clients.create", function ($trail) {
    $trail->parent('clients.index');
    $trail->push('New Client', route("clients.create"));
});

Breadcrumbs::for('clients.show', function ($trail, $client) {
    $trail->parent('clients.index');
    $trail->push($client->name, route('clients.show', $client->id));
});

Breadcrumbs::for('clients.edit', function ($trail, $client) {
    $trail->parent('clients.show', $client);
    $trail->push(trans('buttons.edit'), route('clients.edit', $client->id));
});

//endregion

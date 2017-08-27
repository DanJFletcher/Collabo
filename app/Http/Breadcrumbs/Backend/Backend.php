<?php

Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('admin.dashboard'));
});
Breadcrumbs::register('admin.donations', function ($breadcrumbs) {
    $breadcrumbs->push('Donations', route('admin.donations'));
});
Breadcrumbs::register('teams.index', function ($breadcrumbs) {
    $breadcrumbs->push('Teams', route('admin.teams.index'));
});
Breadcrumbs::register('admin.messages.index', function ($breadcrumbs) {
    $breadcrumbs->push('Messenger', route('admin.messages.index'));
});
Breadcrumbs::register('admin.members.index', function ($breadcrumbs) {
    $breadcrumbs->push('Members', route('admin.members.index'));
});
Breadcrumbs::register('admin.events.index', function ($breadcrumbs) {
    $breadcrumbs->push('Events', route('admin.events.index'));
});


require __DIR__.'/Search.php';
require __DIR__.'/Access.php';
require __DIR__.'/LogViewer.php';

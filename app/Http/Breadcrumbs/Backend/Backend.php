<?php

Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('admin.dashboard'));
});
Breadcrumbs::register('admin.donations', function ($breadcrumbs) {
    $breadcrumbs->push('Donations', route('admin.donations'));
});
Breadcrumbs::register('teams.index', function ($breadcrumbs) {
    $breadcrumbs->push('Teams', route('teams.index'));
});
Breadcrumbs::register('messenger.index', function ($breadcrumbs) {
    $breadcrumbs->push('Messenger', route('messenger.index'));
});


require __DIR__.'/Search.php';
require __DIR__.'/Access.php';
require __DIR__.'/LogViewer.php';

<?php

use App\Services\ManagerLanguageService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

$mls = new ManagerLanguageService('lang_breadcrumbs');
// Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
//     $trail->push('Dashboard', route('home.index'));
// });

// Breadcrumbs::for('subcategories', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('SubCategories', route('sub_categories.index'));
// });

/*------------- Admin Dashboard (Admin Home) -------------*/
// Home
Breadcrumbs::for('admin.dashboard', function ($trail) use ($mls) {
    $trail->push($mls->messageLanguage('only_name', 'dashboard', 2), route('admin.dashboard'));
});

Breadcrumbs::for("admin.profile", function ($trail) use ($mls) {
    $trail->parent("admin.dashboard");
    $trail->push($mls->messageLanguage('only_name', 'profile', 2), route("admin.profile"));
});
Breadcrumbs::for("admin.change-password", function ($trail) use ($mls) {
    $trail->parent("admin.dashboard");
    $trail->push($mls->messageLanguage('only_name', 'change_password', 2), route("admin.change_password"));
});

// general Settings
Breadcrumbs::for('admin.settings.edit_general', function ($trail) {
    $trail->parent("admin.dashboard");
    $trail->push('Settings - General', route("admin.settings.edit_general"));
});

Breadcrumbs::macro('resource', function ($name, $title, $list = false) {
    // Home > $title
    Breadcrumbs::for("admin.$name.index", function ($trail) use ($name, $title) {
        $trail->parent("admin.dashboard");
        $trail->push($title, route("admin.$name.index"));
    });
    // Home > $title > Add New
    Breadcrumbs::for("admin.$name.create", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Add New $title", route("admin.$name.create"));
    });
    // Home > $title > Edit
    Breadcrumbs::for("admin.$name.edit", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push("Edit $title", url("admin/$name/{id}/edit"));
    });
    // Home > $title > Details
    Breadcrumbs::for("admin.$name.show", function ($trail) use ($name, $title) {
        $trail->parent("admin.$name.index");
        $trail->push(" Details", url("admin/$name/{id}"));
    });
    if ($list == true) {
        Breadcrumbs::for("admin.$name.list", function ($trail) use ($name, $title) {
            $trail->parent("admin.dashboard");
            $trail->push($title, route("admin.$name.list"));
        });
    }
});

// Sub breadcrumbs Resource
Breadcrumbs::macro('subresource', function ($main, $main_title, $sub = '', $sub_title = '', $request = '', $param_key = '', $tab = '') {
    // Home > $main_title
    Breadcrumbs::for("admin.$main.index", function ($trail) use ($main, $main_title) {
        $trail->parent("admin.dashboard");
        $trail->push($main_title, route("admin.$main.index"));
    });

    // Home > $main_title > Add New
    Breadcrumbs::for("admin.$main.create", function ($trail) use ($main) {
        $trail->parent("admin.$main.index");
        $trail->push("Add New", route("admin.$main.create"));
    });

    // Home > $main_title > Edit
    Breadcrumbs::for("admin.$main.edit", function ($trail) use ($main, $request) {
        $trail->parent("admin.$main.index");
        $trail->push("Edit", url("admin/$main/" . request()->{$request} . "/edit"));
    });

    // Home > $main_title > Details
    Breadcrumbs::for("admin.$main.show", function ($trail) use ($main) {
        $trail->parent("admin.$main.index");
        $trail->push("Details", url("admin/$main/{id}"));
    });

    // if(!empty($sub)){
    // Home > $main_title > blogs
    Breadcrumbs::for("admin.$sub.index", function ($trail) use ($main, $sub, $sub_title, $request, $param_key) {
        $trail->parent("admin.$main.index");
        if ($sub == 'banners') {
            $trail->push($sub_title, route("admin.$main.show", ['tab' => $sub, $param_key => isset(request()->$request->id) ? request()->$request->id : 0]));
        } else {
            $trail->push($sub_title, route("admin.$sub.index") . "?$request=" . request()->{$request});
        }
    });

    // Home > $main_title > $sub > Add New
    Breadcrumbs::for("admin.$sub.create", function ($trail) use ($sub) {
        $trail->parent("admin.$sub.index");
        $trail->push("Add New", route("admin.$sub.create"));
    });

    // Home > $main_title > $sub > Profile
    Breadcrumbs::for("admin.$sub.edit", function ($trail) use ($sub) {
        $trail->parent("admin.$sub.index");
        $trail->push("Edit", url("admin/$sub/{id}/edit"));
    });

    // Home > $main_title > $sub > Details
    Breadcrumbs::for("admin.$sub.show", function ($trail) use ($sub) {
        $trail->parent("admin.$sub.index");
        $trail->push("Details", url("admin/$sub/{id}"));
    });
    // }

});

/*------------- Admin Users ------------------------*/
Breadcrumbs::resource('users', $mls->messageLanguage('only_name', 'user', 2));
/*------------- Admin Roles ------------------------*/
Breadcrumbs::resource('roles', $mls->messageLanguage('only_name', 'role', 2));
/*------------- Admin Permissions ------------------------*/
Breadcrumbs::resource('permissions', $mls->messageLanguage('only_name', 'permission', 2));

/*------------- Admin Customers ------------------------*/
Breadcrumbs::resource('customers', $mls->messageLanguage('only_name', 'customer', 2));

/*------------- Admin Categories ------------------------*/
Breadcrumbs::resource('categories', $mls->messageLanguage('only_name', 'category', 2));
/*------------- Admin Products ------------------------*/
Breadcrumbs::resource('products', $mls->messageLanguage('only_name', 'product', 2));
/*------------- Admin page Content  ------------------------*/
Breadcrumbs::resource('page-contents', $mls->messageLanguage('only_name', 'page_content', 2));
/*------------- Admin Faq  ------------------------*/
Breadcrumbs::resource('faqs', $mls->messageLanguage('only_name', 'faq', 2));
/*------------- Admin Push Notification  ------------------------*/
Breadcrumbs::resource('pushNotifications', $mls->messageLanguage('only_name', 'push_notification', 2));
/*------------- Admin ContactUs  ------------------------*/
Breadcrumbs::resource('contact-us', $mls->messageLanguage('only_name', 'contact_us', 2));
/*------------- Admin type  ------------------------*/
Breadcrumbs::resource('types', $mls->messageLanguage('only_name', 'type', 2));

<?php

namespace App\Http\Middleware;

use Closure;

class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        \Menu::make('MainMenu', function($menu) {

            $prefix = \Config::get('horizontcms.backend_prefix');


            $menu->add("<span class='glyphicon glyphicon-th-large' aria-hidden='true'></span> ".trans('navbar.dashboard'), $prefix."/dashboard");

            $menu->add(trans('navbar.news'), '#')->id('news');
            $menu->find('news')->add("<i class='fa fa-newspaper-o'></i> ".trans('navbar.posted_news'), $prefix."/blogpost");
            $menu->find('news')->add("<i class='fa fa-pencil'></i> ".trans('navbar.create_post'), $prefix."/blogpost/create");
            $menu->find('news')->add("<i class='fa fa-list-ul'></i> ".trans('navbar.categories'), $prefix.'/categories');


            $menu->add(trans('navbar.users'), '#')->id('users');
            $menu->find('users')->add("<i class='fa fa-users'></i> ".trans('navbar.user_list'), $prefix.'/users');
            $menu->find('users')->add("<i class='fa fa-user-plus'></i> ".trans('navbar.user_add'), $prefix.'/users/create');
            $menu->find('users')->add("<i class='fa fa-gavel'></i> ".trans('navbar.user_groups'), $prefix.'/usergroups');



            $menu->add(trans('navbar.pages'), '#')->id('pages');
            $menu->find('pages')->add("<i class='fa fa-files-o'></i> ".trans('navbar.page_list'), $prefix.'/page');
            $menu->find('pages')->add("<i class='fa fa-pencil-square-o'></i> ".trans('navbar.page_add'), $prefix.'/page/create');
            
            $menu->add(trans('navbar.media'), '#')->id('media');
            $menu->find('media')->add("<i class='fa fa-picture-o'></i> ".trans('navbar.header_images'), $prefix.'/headerimage');
            $menu->find('media')->add("<i class='fa fa-folder-open-o'></i> ".trans('navbar.filemanager'), $prefix.'/filemanager');
            $menu->find('media')->add("<i class='fa fa-camera-retro'></i> ".trans('navbar.gallery'), $prefix.'/gallery');
            
            
            $menu->add(trans('navbar.themes_apps'), '#')->id('themes_apps');
            $menu->find('themes_apps')->add("<i class='fa fa-desktop'></i> ".trans('navbar.theme'), $prefix.'/theme');
            $menu->find('themes_apps')->add("<i class='fa fa-cubes'></i> ".trans('navbar.plugin'), $prefix.'/plugin');
            $menu->find('themes_apps')->add("<i class='fa fa-code'></i> ".trans('navbar.develop'), $prefix.'/develop');

        });


       /* \Menu::make('RightMenu', function($menu) {

            $menu->add(trans('navbar.dashboard'), 'item-1-url');
            $menu->add(trans('navbar.news'), 'item-2-url');
            $menu->add(trans('navbar.users'), 'item-3-url');

        });*/



        return $next($request);
    }
}
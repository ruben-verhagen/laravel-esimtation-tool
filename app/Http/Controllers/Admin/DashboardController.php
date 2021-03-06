<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Article;
use App\ArticleCategory;
use App\User;
use App\Photo;
use App\PhotoAlbum;
use App\Space;
use App\Item;

class DashboardController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

	public function index()
	{
        $title = "Dashboard";

        $news = Article::count();
        $newscategory = ArticleCategory::count();
        $users = User::count();
        $photo = Photo::count();
        $photoalbum = PhotoAlbum::count();

        $spaces = Space::count();
        $items = Item::count();
        return view('admin.dashboard.index',  compact('title','news','newscategory','photo','photoalbum', 'spaces', 'items', 'users'));
	}
}

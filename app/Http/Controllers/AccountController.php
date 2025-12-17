<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(): View
    {
        $rightSideView = 'account.dashboard';

        $pageTitle = 'Your Account';

        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => $pageTitle]],
            'title' => $pageTitle,
        ];

        return view('account.index', compact('rightSideView', 'pageTitle', 'breadcrumbs'));
    }

    public function wishlist(): View
    {

        $rightSideView = 'account.wishlist';

        $pageTitle = 'Your Wishlist';

        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => $pageTitle]],
            'title' => $pageTitle,
        ];

        return view('account.index', compact('rightSideView', 'pageTitle', 'breadcrumbs'));
    }

    public function addToWishlist($product_id): RedirectResponse
    {
        auth()->user()->wishlists()->attach($product_id);

        return redirect()->back()
            ->with('success', 'Product Added to Wishlist!!!');
    }

    public function removeFromWishlist($product_id): RedirectResponse
    {
        auth()->user()->wishlists()->detach($product_id);

        return redirect()->back()
            ->with('success', 'Product removed from Wishlist!!!');
    }
}

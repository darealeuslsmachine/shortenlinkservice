<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ShortLink;

class ShortLinkController extends Controller
{
    /**
     * Get all short links for web interface
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view('shortenLinks', [
            'shortLinks' => ShortLink::latest()->get()
        ]);
    }

    /**
     * Creat short link from web interface
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $request->validate([
            'link' => 'required|url'
        ]);

        ShortLink::create([
            'link' => $request->link,
            'code' => Str::random(6)
        ]);

        return redirect()
            ->route('generate.shorten.link')
            ->with('success', 'Короткая ссылка успешно создана');
    }

    /**
     * Shorten link work
     *
     * @param $code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function shortenLink($code) {
        $link = ShortLink::where('code', $code)->first();
        $link->count++;
        $link->save();

        return redirect($link->link);
    }
}

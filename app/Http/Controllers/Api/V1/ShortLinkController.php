<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    /**
     * Get all short links
     *
     * @return array
     */
    public function index() {

        $links = ShortLink::latest()->get();
        return [
            "status" => 1,
            "data" => $links
        ];
    }

    /**
     * Create short link
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'link' => 'required'
        ]);

        $code = Str::random(6);

        if (ShortLink::create([
            'link' => $request->link,
            'code' => $code
        ])) {
            return response([
                'link' => $request->link,
                'short_link' => url('/') . '/' . $code
            ], 201);
        } else {
            return response(['message' => 'Error'], 404);
        }

    }

    /**
     * Update short link
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id) {
        $shortLink = ShortLink::find($id);
        $shortLink->update($request->all);

        return $shortLink;
    }

    /**
     * Delete short link
     *
     * @param $id
     * @return int
     */
    public function destroy($id) {
        return ShortLink::destroy($id);
    }

    /**
     * Search short link
     *
     * @param $name
     * @return mixed
     */
    public function search($name) {
        return ShortLink::where('code', 'like', '%'.$name.'%')->get();
    }

    /**
     * Get short link from id
     *
     * @param $id
     * @return mixed
     */
    public function show($id) {
        return $id;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    /**
     * Store and hash a new url
     * 
     * @param Request $request
     * @param $urlValue
     * @return Response
     * 
     */

    public function store(Request $request)
    {
        // validating rules for the input fields
        $rules = [
            'urltext' => 'required|url'
        ];
        $validation = Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            return redirect('/')->withInput()->withErrors($validation);
        }
        // We check if link already exist in database
        $link = Link::where('url', '=', $request->input('urltext'))->first();
        if($link)
        {
            return redirect('/')->withInput()->with('link', $link->hash);
        }else{
            // First, we create a new hash
            do{
                $newHash = Str::random(6);
            }while(Link::where('hash', '=', $newHash)->count() > 0 );
        }

        // We create a new record in database
        Link::create(array(
            'url'   => $request->input('urltext'),
            'hash'  => $newHash
        ));

        // We return the new hash url to our view
        return redirect('/')->withInput()->with('link', $newHash);

    }

    /**
     * decode the hash url and redirect to actual url
     * @param $hash
     * 
     */

     public function decodeHash($hash){
        $link = Link::where('hash', '=', $hash)->first();

        if($link){
            return redirect($link->url);
        }else{
            return redirect('/')->with('message', 'Invalid Link');
        }
     }

}
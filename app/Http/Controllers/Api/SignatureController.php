<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Signature;
use App\Http\Resources\SignatureResource;

class SignatureController extends Controller
{
    public function index()
    {
    	$signature = Signature::latest()->ignoreFlagged()->paginate(20);
    	return SignatureResource::collection($signature);
    }

    public function show(Signature $signature)
    {
    	return new SignatureResource($signature);
    }

    public function store(Request $request)
    {
    	$signature = $this->validate($request, [
    		'name' => 'required|min:3|max:50',
    		'email'	=> 'required|email',
    		'body'	=> 'required|min:3'
    	]);

    	$signature = Signature::create($signature);
    	return new SignatureResource($signature);
    }
}

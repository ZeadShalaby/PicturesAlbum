<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * todo check users found or not (login).
     */
    public function login(Request $request)
    {
        //! validation
        $rules = $this->rulesComment();
        $validator = $this->validate($request,$rules);
        if($validator !== true){return $validator;}

    }

    /**
     * todo creating a new users resource.
     */
    public function regist()
    {
        //! validation
        $rules = $this->rulesComment();
        $validator = $this->validate($request,$rules);
        if($validator !== true){return $validator;}

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

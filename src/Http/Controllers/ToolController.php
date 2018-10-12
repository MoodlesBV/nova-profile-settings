<?php

namespace Runline\ProfileTool\Http\Controllers;

use Illuminate\Routing\Controller;

class ToolController extends Controller
{
    public function index()
    {
        return response()->json([
            [
                "component" => "text-field",
                "prefixComponent" => true,
                "indexName" => "Name",
                "name" => "Name",
                "attribute" => "name",
                "value" => auth()->user()->name,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ],
            [
                "component" => "text-field",
                "prefixComponent" => true,
                "indexName" => "E-mail address",
                "name" => "E-mail address",
                "attribute" => "email",
                "value" => auth()->user()->email,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ],
            [
                "component" => "password-field",
                "prefixComponent" => true,
                "indexName" => "Password",
                "name" => "Password",
                "attribute" => "password",
                "value" => null,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ],
            [
                "component" => "password-field",
                "prefixComponent" => true,
                "indexName" => "Password Confirmation",
                "name" => "Password Confirmation",
                "attribute" => "password_confirmation",
                "value" => null,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ]
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $data = $request->all();

        dd($user, $data);

        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|confirmed'
        ]);

        $user->update($data);

        return response()->json(__("Your profile has been saved!"));
    }
}

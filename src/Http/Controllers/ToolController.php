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
    public function store()
    {
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|confirmed'
        ]);

        $changed_fields = array();

        if (request()->filled('name')) {
            auth()->user()->update([
                'name' => request('name')
            ]);

            array_push($changed_fields, 'Name');
        }

        if (request()->filled('email')) {
            auth()->user()->update([
                'email' => request('email')
            ]);

            array_push($changed_fields, 'E-mail address');
        }

        if (request()->filled('password')) {
            auth()->user()->update([
                'password' => bcrypt(request('password'))
            ]);

            array_push($changed_fields, 'Password');
        }

        //return response()->json(__("Your " . implode(", ", $changed_fields)) . " have been updated!");
    }
}

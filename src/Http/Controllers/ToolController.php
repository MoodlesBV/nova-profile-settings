<?php

namespace Moodles\ProfileTool\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ToolController extends Controller
{
    public function index()
    {

        if (__("nova-profile-settings#name") != 'nova-profile-settings#name' && __("nova-profile-settings#name") != false) {
            $name_locale = __("vendor.nova.nova-profile-settings#name");
        } else { // No translation specified: fallback to EN
            $name_locale = "Name";
        }

        if (__("nova-profile-settings#email") != 'nova-profile-settings#email' && __("nova-profile-settings#email") != false) {
            $email_locale = __("nova-profile-settings#email");
        } else { // No translation specified: fallback to EN
            $email_locale = "E-Mailaddress";
        }

        if (__("nova-profile-settings#password") != 'nova-profile-settings#password' && __("nova-profile-settings#password") != false) {
            $password_locale = __("nova-profile-settings#password");
        } else { // No translation specified: fallback to EN
            $password_locale = "Password";
        }

        if (__("nova-profile-settings#password_confirmation") != 'nova-profile-settings#password_confirmation' && __("nova-profile-settings#password_confirmation") != false) {
            $password_confirmation_locale = __("nova-profile-settings#password_confirmation");
        } else { // No translation specified: fallback to EN
            $password_confirmation_locale = "Password confirmation";
        }

        return response()->json([
            [
                "component" => "text-field",
                "prefixComponent" => true,
                "indexName" => $name_locale,
                "name" => $name_locale,
                "attribute" => "name",
                "value" => auth()->user()->name,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ],
            [
                "component" => "text-field",
                "prefixComponent" => true,
                "indexName" => $email_locale,
                "name" => $email_locale,
                "attribute" => "email",
                "value" => auth()->user()->email,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ],
            [
                "component" => "password-field",
                "prefixComponent" => true,
                "indexName" => $password_locale,
                "name" => $password_locale,
                "attribute" => "password",
                "value" => null,
                "panel" => null,
                "sortable" => false,
                "textAlign" => "left"
            ],
            [
                "component" => "password-field",
                "prefixComponent" => true,
                "indexName" => $password_confirmation_locale,
                "name" => $password_confirmation_locale,
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

        $data = $request->only(['name', 'email', 'password']);

        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|confirmed'
        ]);

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        if (__("nova-profile-settings#success_message") != 'nova-profile-settings#success_message' && __("nova-profile-settings#success_message") != false) {
            $success_message_locale = __("nova-profile-settings#success_message");
        } else { // No translation specified: fallback to EN
            $success_message_locale = "Profile has been updated!";
        }

        return response()->json($success_message_locale);
    }
}

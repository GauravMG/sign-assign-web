<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function index(): string
    {
        return $this->users();
    }

    public function users(): string
    {
        $data = [
            'title' => 'Users',
            'page_heading' => 'Users'
        ];

        return view('users', $data);
    }

    public function addUser(): string
    {
        $data = [
            'title' => 'Add User',
            'page_heading' => 'Add User'
        ];

        return view('add-user', $data);
    }

    public function userDetails($userId): string
    {
        $data = [
            'title' => 'User Details',
            'page_heading' => 'User Details',
            'data' => [
                'userId' => $userId
            ]
        ];

        return view('user-details', $data);
    }

    public function userWithdrawRequests(): string
    {
        $data = [
            'title' => 'User Withdraw Requests',
            'page_heading' => 'User Withdraw Requests'
        ];

        return view('user-withdraw-requests', $data);
    }

    public function appSettings(): string
    {
        $data = [
            'title' => 'App Settings',
            'page_heading' => 'App Settings'
        ];

        return view('app-settings', $data);
    }
}

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
}

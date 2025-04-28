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

    public function updateUser($userId): string
    {
        $data = [
            'title' => 'Update User',
            'page_heading' => 'Update User',
            'data' => [
                'userId' => $userId
            ]
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

    public function productCategories(): string
    {
        $data = [
            'title' => 'Product Categories',
            'page_heading' => 'Product Categories'
        ];

        return view('product-categories', $data);
    }

    public function addProductCategory(): string
    {
        $data = [
            'title' => 'Add Product Category',
            'page_heading' => 'Add Product Category'
        ];

        return view('add-product-category', $data);
    }

    public function updateProductCategory($productCategoryId): string
    {
        $data = [
            'title' => 'Update Product Category',
            'page_heading' => 'Update Product Category',
            'data' => [
                'productCategoryId' => $productCategoryId
            ]
        ];

        return view('add-product-category', $data);
    }

    public function products(): string
    {
        $data = [
            'title' => 'Products',
            'page_heading' => 'Products'
        ];

        return view('products', $data);
    }

    public function addProduct(): string
    {
        $data = [
            'title' => 'Add Product',
            'page_heading' => 'Add Product'
        ];

        return view('add-product', $data);
    }

    public function updateProduct($productId): string
    {
        $data = [
            'title' => 'Update Product',
            'page_heading' => 'Update Product',
            'data' => [
                'productId' => $productId
            ]
        ];

        return view('add-product', $data);
    }
}

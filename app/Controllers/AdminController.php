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

    public function viewUser($userId): string
    {
        $data = [
            'title' => 'User Details',
            'page_heading' => 'User Details',
            'data' => [
                'userId' => $userId
            ]
        ];

        return view('view-user', $data);
    }

    public function supportTickets(): string
    {
        $data = [
            'title' => 'Support Tickets',
            'page_heading' => 'Support Tickets'
        ];

        return view('support-tickets', $data);
    }

    public function viewSupportTicket($supportTicketId): string
    {
        $data = [
            'title' => 'Support Ticket Details',
            'page_heading' => 'Support Ticket Details',
            'data' => [
                'supportTicketId' => $supportTicketId
            ]
        ];

        return view('view-support-ticket', $data);
    }

    public function banners(): string
    {
        $data = [
            'title' => 'Banners',
            'page_heading' => 'Banners'
        ];

        return view('banners', $data);
    }

    public function addBanner(): string
    {
        $data = [
            'title' => 'Add Banner',
            'page_heading' => 'Add Banner'
        ];

        return view('add-banner', $data);
    }

    public function attributes(): string
    {
        $data = [
            'title' => 'Attributes',
            'page_heading' => 'Attributes'
        ];

        return view('attributes', $data);
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

    public function viewProductCategory($productCategoryId): string
    {
        $data = [
            'title' => 'Product Category Details',
            'page_heading' => 'Product Category Details',
            'data' => [
                'productCategoryId' => $productCategoryId
            ]
        ];

        return view('view-product-category', $data);
    }

    public function addProductSubCategory($productCategoryId): string
    {
        $data = [
            'title' => 'Add Product Sub-category',
            'page_heading' => 'Add Product Sub-category',
            'data' => [
                'productCategoryId' => $productCategoryId
            ]
        ];

        return view('add-product-subcategory', $data);
    }

    public function updateProductSubCategory($productSubCategoryId): string
    {
        $data = [
            'title' => 'Update Product Sub-category',
            'page_heading' => 'Update Product Sub-category',
            'data' => [
                'productSubCategoryId' => $productSubCategoryId
            ]
        ];

        return view('add-product-subcategory', $data);
    }

    public function viewProductSubCategory($productSubCategoryId): string
    {
        $data = [
            'title' => 'Product Sub-category Details',
            'page_heading' => 'Product Sub-category Details',
            'data' => [
                'productSubCategoryId' => $productSubCategoryId
            ]
        ];

        return view('view-product-subcategory', $data);
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

    public function viewProduct($productId): string
    {
        $data = [
            'title' => 'Product Details',
            'page_heading' => 'Product Details',
            'data' => [
                'productId' => $productId
            ]
        ];

        return view('view-product', $data);
    }

    public function viewVariant($variantId): string
    {
        $data = [
            'title' => 'Variant Details',
            'page_heading' => 'Variant Details',
            'data' => [
                'variantId' => $variantId
            ]
        ];

        return view('view-variant', $data);
    }

    public function addVariantMedia($variantId): string
    {
        $data = [
            'title' => 'Add Variant Image',
            'page_heading' => 'Add Variant Image',
            'data' => [
                'variantId' => $variantId
            ]
        ];

        return view('add-variant-media', $data);
    }

    public function invoices(): string
    {
        $data = [
            'title' => 'Invoices',
            'page_heading' => 'Invoices'
        ];

        return view('invoices', $data);
    }

    public function invoicePrint(): string
    {
        $data = [
            'title' => 'Print Invoice',
            'page_heading' => 'Print Invoice'
        ];

        return view('print-invoice', $data);
    }
}

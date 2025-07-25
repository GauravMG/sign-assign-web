<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function index(): string
    {
        return $this->orders();
    }

    public function staff(): string
    {
        $data = [
            'title' => 'My Staff',
            'page_heading' => 'My Staff'
        ];

        return view('staff', $data);
    }

    public function addStaff(): string
    {
        $data = [
            'title' => 'Add Staff',
            'page_heading' => 'Add Staff',
            'back_url' => '/admin/staff'
        ];

        return view('add-staff', $data);
    }

    public function updateStaff($userId): string
    {
        $data = [
            'title' => 'Update Staff',
            'page_heading' => 'Update Staff',
            'back_url' => '/admin/staff',
            'data' => [
                'userId' => $userId
            ]
        ];

        return view('add-staff', $data);
    }

    public function viewStaff($userId): string
    {
        $data = [
            'title' => 'Staff Details',
            'page_heading' => 'Staff Details',
            'back_url' => '/admin/staff',
            'data' => [
                'userId' => $userId
            ]
        ];

        return view('view-staff', $data);
    }

    public function coupons(): string
    {
        $data = [
            'title' => 'Coupons',
            'page_heading' => 'Coupons'
        ];

        return view('coupons', $data);
    }

    public function rushCharges(): string
    {
        $data = [
            'title' => 'Rush Charges',
            'page_heading' => 'Rush Charges'
        ];

        return view('rush-charge', $data);
    }

    public function customers(): string
    {
        $data = [
            'title' => 'Customers',
            'page_heading' => 'Customers'
        ];

        return view('users', $data);
    }

    public function addCustomer(): string
    {
        $data = [
            'title' => 'Add Customer',
            'page_heading' => 'Add Customer',
            'back_url' => '/admin/customers'
        ];

        return view('add-user', $data);
    }

    public function updateCustomer($userId): string
    {
        $data = [
            'title' => 'Update Customer',
            'page_heading' => 'Update Customer',
            'back_url' => '/admin/customers',
            'data' => [
                'userId' => $userId
            ]
        ];

        return view('add-user', $data);
    }

    public function viewCustomer($userId): string
    {
        $data = [
            'title' => 'Customer Details',
            'page_heading' => 'Customer Details',
            'back_url' => '/admin/customers',
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
            'back_url' => '/admin/support-tickets',
            'data' => [
                'supportTicketId' => $supportTicketId
            ]
        ];

        return view('view-support-ticket', $data);
    }

    public function banners(): string
    {
        $data = [
            'title' => 'Landing Page Banners',
            'page_heading' => 'Landing Page Banners'
        ];

        return view('banners', $data);
    }

    public function addBanner(): string
    {
        $data = [
            'title' => 'Add Landing Page Banner',
            'page_heading' => 'Add Landing Page Banner',
            'back_url' => '/admin/banners'
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
            'page_heading' => 'Add Product Category',
            'back_url' => '/admin/product-categories'
        ];

        return view('add-product-category', $data);
    }

    public function updateProductCategory($productCategoryId): string
    {
        $data = [
            'title' => 'Update Product Category',
            'page_heading' => 'Update Product Category',
            'back_url' => '/admin/product-categories',
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
            'back_url' => '/admin/product-categories',
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
            'back_url' => '/admin/product-categories/view/' . $productCategoryId,
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
            'back_url' => previous_url(),
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
            'back_url' => previous_url(),
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
            'page_heading' => 'Add Product',
            'back_url' => '/admin/products'
        ];

        return view('add-product', $data);
    }

    public function updateProduct($productId): string
    {
        $data = [
            'title' => 'Update Product',
            'page_heading' => 'Update Product',
            'back_url' => '/admin/products',
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
            'back_url' => '/admin/products',
            'data' => [
                'productId' => $productId
            ]
        ];

        return view('view-product', $data);
    }

    public function manageProductMedia($productId): string
    {
        $data = [
            'title' => 'Product Media',
            'page_heading' => 'Product Media',
            'back_url' => '/admin/products',
            'data' => [
                'productId' => $productId
            ]
        ];

        return view('manage-product-media', $data);
    }

    public function manageProductAttribute($productId): string
    {
        $data = [
            'title' => 'Product Atribute',
            'page_heading' => 'Product Atribute',
            'back_url' => '/admin/products',
            'data' => [
                'productId' => $productId
            ]
        ];

        return view('manage-product-attribute', $data);
    }

    public function manageProductFAQ($productId): string
    {
        $data = [
            'title' => 'Product FAQ',
            'page_heading' => 'Product FAQ',
            'back_url' => '/admin/products',
            'data' => [
                'productId' => $productId
            ]
        ];

        return view('manage-product-faq', $data);
    }

    public function manageProductDiscount($productId): string
    {
        $data = [
            'title' => 'Product Discount',
            'page_heading' => 'Product Discount',
            'back_url' => '/admin/products',
            'data' => [
                'productId' => $productId
            ]
        ];

        return view('manage-product-discount', $data);
    }

    // public function viewVariant($variantId): string
    // {
    //     $data = [
    //         'title' => 'Variant Details',
    //         'page_heading' => 'Variant Details',
    //         'data' => [
    //             'variantId' => $variantId
    //         ]
    //     ];

    //     return view('view-variant', $data);
    // }

    // public function addVariantMedia($variantId): string
    // {
    //     $data = [
    //         'title' => 'Add Variant Image',
    //         'page_heading' => 'Add Variant Image',
    //         'data' => [
    //             'variantId' => $variantId
    //         ]
    //     ];

    //     return view('add-variant-media', $data);
    // }

    public function orders(): string
    {
        $data = [
            'title' => 'Orders',
            'page_heading' => 'Orders'
        ];

        return view('orders', $data);
    }

    public function viewOrder($orderId): string
    {
        $data = [
            'title' => 'Order Details',
            'page_heading' => 'Order Details',
            'back_url' => '/admin/orders',
            'data' => [
                'orderId' => $orderId
            ]
        ];

        return view('view-order', $data);
    }

    public function viewInvoice($invoiceId): string
    {
        $data = [
            'title' => 'Invoices',
            'page_heading' => 'Invoices',
            'back_url' => previous_url(),
            'data' => [
                'invoiceId' => $invoiceId
            ]
        ];

        return view('view-invoice', $data);
    }

    public function invoicePrint(): string
    {
        $data = [
            'title' => 'Print Invoice',
            'page_heading' => 'Print Invoice'
        ];

        return view('print-invoice', $data);
    }

    public function blogs(): string
    {
        $data = [
            'title' => 'Blogs',
            'page_heading' => 'Blogs'
        ];

        return view('blogs', $data);
    }

    public function addBlog(): string
    {
        $data = [
            'title' => 'Add Blog',
            'page_heading' => 'Add Blog',
            'back_url' => '/admin/blogs'
        ];

        return view('add-blog', $data);
    }

    public function updateBlog($blogId): string
    {
        $data = [
            'title' => 'Update Blog',
            'page_heading' => 'Update Blog',
            'back_url' => '/admin/blogs',
            'data' => [
                'blogId' => $blogId
            ]
        ];

        return view('add-blog', $data);
    }

    public function viewBlog($blogId): string
    {
        $data = [
            'title' => 'Blog Details',
            'page_heading' => 'Blog Details',
            'back_url' => '/admin/blogs',
            'data' => [
                'blogId' => $blogId
            ]
        ];

        return view('view-blog', $data);
    }

    public function templates(): string
    {
        $data = [
            'title' => 'Templates',
            'page_heading' => 'Templates'
        ];

        return view('templates', $data);
    }
}

<?php

namespace App\Controllers;

class WebController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Sign Assign',
            'page_heading' => 'Sign Assign'
        ];

        return view('web/home', $data);
    }

    function getNameFromLink($input)
    {
        // Replace hyphens with spaces
        $input = str_replace('-', ' ', $input);

        // Capitalize the first letter of each word
        $input = ucwords($input);

        return $input;
    }

    function getNameAndIdFromLink($input)
    {
        // Split the string by dashes
        $parts = explode('-', $input);

        // Get the last part as the ID
        $id = array_pop($parts);

        // Rejoin the remaining parts as the title
        $title = implode('-', $parts);

        return [
            'id' => $id,
            'title' => $title
        ];
    }

    public function privacyPolicy(): string
    {
        $data = [
            'title' => "Privacy Policy",
            'page_heading' => "Privacy Policy"
        ];

        return view('web/privacy-policy', $data);
    }

    public function termsOfUse(): string
    {
        $data = [
            'title' => "Terms of Use",
            'page_heading' => "Terms of Use"
        ];

        return view('web/terms-of-use', $data);
    }

    public function aboutUs(): string
    {
        $data = [
            'title' => "About Us",
            'page_heading' => "About Us"
        ];

        return view('web/about-us', $data);
    }

    public function contactUs(): string
    {
        $data = [
            'title' => "Contact Us",
            'page_heading' => "Contact Us"
        ];

        return view('web/contact-us', $data);
    }

    public function services(): string
    {
        $data = [
            'title' => "Services",
            'page_heading' => "Services"
        ];

        return view('web/services', $data);
    }

    public function search(): string
    {
        $data = [
            'title' => "Search",
            'page_heading' => "Search"
        ];

        return view('web/search', $data);
    }

    public function productCategory($categoryName): string
    {
        $categoryNameFormatted = $this->getNameFromLink($categoryName);
        $productCategoryId = $this->request->getGet('catid');

        $data = [
            'title' => $categoryNameFormatted,
            'page_heading' => $categoryNameFormatted,
            'data' => [
                'categoryName' => $categoryNameFormatted,
                'productCategoryId' => $productCategoryId
            ]
        ];

        return view('web/product-category', $data);
    }

    public function productSubCategory($subCategoryName): string
    {
        $subCategoryNameFormatted = $this->getNameFromLink($subCategoryName);
        $productSubCategoryId = $this->request->getGet('subcatid');

        $data = [
            'title' => $subCategoryNameFormatted,
            'page_heading' => $subCategoryNameFormatted,
            'data' => [
                'subCategoryName' => $subCategoryNameFormatted,
                'productSubCategoryId' => $productSubCategoryId
            ]
        ];

        return view('web/product-subcategory', $data);
    }

    public function productDetail($productName): string
    {
        $productNameFormatted = $this->getNameFromLink($productName);
        $productId = $this->request->getGet('pid');

        $data = [
            'title' => $productNameFormatted,
            'page_heading' => $productNameFormatted,
            'data' => [
                'productName' => $productNameFormatted,
                'productId' => $productId
            ]
        ];

        return view('web/product', $data);
    }

    public function checkout(): string
    {
        $data = [
            'title' => "Checkout",
            'page_heading' => "Checkout"
        ];

        return view('web/checkout', $data);
    }

    public function blogs(): string
    {
        $data = [
            'title' => "Blogs",
            'page_heading' => "Blogs"
        ];

        return view('web/blogs', $data);
    }

    public function blogDetail($blogName): string
    {
        $blogName = $this->getNameFromLink($blogName);
        $blogId = $this->request->getGet('lcid');

        $data = [
            'title' => $blogName,
            'page_heading' => $blogName,
            'data' => [
                'title' => $blogName,
                'blogId' => $blogId
            ]
        ];

        return view('web/blog-detail', $data);
    }
}

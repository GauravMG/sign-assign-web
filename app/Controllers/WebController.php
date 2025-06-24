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

        $data = [
            'title' => $categoryNameFormatted,
            'page_heading' => $categoryNameFormatted,
            'data' => [
                'categoryName' => $categoryNameFormatted
            ]
        ];

        return view('web/product-category', $data);
    }

    public function productSubCategory($subCategoryName): string
    {
        $subCategoryNameFormatted = $this->getNameFromLink($subCategoryName);

        $data = [
            'title' => $subCategoryNameFormatted,
            'page_heading' => $subCategoryNameFormatted,
            'data' => [
                'subCategoryName' => $subCategoryNameFormatted
            ]
        ];

        return view('web/product-subcategory', $data);
    }

    public function productDetail($productName): string
    {
        $productNameFormatted = $this->getNameFromLink($productName);

        $data = [
            'title' => $productNameFormatted,
            'page_heading' => $productNameFormatted,
            'data' => [
                'productName' => $productNameFormatted
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

    public function blogDetail($blogNameWithId): string
    {
        $blogURLSplit = $this->getNameAndIdFromLink($blogNameWithId);

        $data = [
            'title' => $blogURLSplit['title'],
            'page_heading' => $blogURLSplit['title'],
            'data' => [
                'blogId' => $blogURLSplit['id'],
                'title' => $blogURLSplit['title']
            ]
        ];

        return view('web/blog-detail', $data);
    }
}

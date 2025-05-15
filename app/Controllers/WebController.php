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

    function getNameFromLink($input) {
        // Replace hyphens with spaces
        $input = str_replace('-', ' ', $input);
        
        // Capitalize the first letter of each word
        $input = ucwords($input);
        
        return $input;
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
}

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

    public function serviceDetail($serviceName): string
    {
        $serviceName = $this->getNameFromLink($serviceName);

        $serviceMaster = [
            "Turnkey Project Management" => [
                "fullTitle" => "Turnkey Project Management For Your Signage Needs",
                "description" => "It is important to have a persuasive sign that sends the right message to your customers. However, it is possible to get overwhelmed when thinking about getting new ing for your business. You might wonder whether you require a permit for your new signage, will the process disrupt your operations, how you make the sign stand out, and the materials to use for the sign.

This is where Sign Assign steps in to provide a complete and comprehensive sign service for your business. We provide turnkey project management services to individuals and businesses looking for high-quality signage. We will handle every aspect of your signage process, which involves understanding your vision, researching materials, getting permits, designing, producing, and finally installing your new sign.

Our experts will sit down with you, understand your unique needs and requirements, determine a realistic project deadline and kickstart the signage process. We will gather relevant materials that are best suited for your needs and look for any permitting information required for the successful project execution.

After collecting all the facts and relevant information, we proceed toward the design phase. We’ll create unique designs that’ll amaze you! We’ll send some design samples your way for approval.

Once approved, we’ll proceed toward the production phase, where your vision will be converted into reality. Once we have the sign ready, we’ll come to your place and expertly install the sign. Installing a sign has never been this easy! Let Sign Assign take care of all your signage needs. We won’t disappoint you!"
            ],
            "Sign Services And Installation" => [
                "fullTitle" => "Expert Sign Installation Services",
                "description" => "Getting a new sign is an important part of your business’s overall marketing strategy. After all, it is the thing that will highlight your company and attract visitors and onlookers. However, getting a sign and installing one are two different things. Proper installation ensures that you get the most out of your quality sign. At Sign Assign, our experts provide our customers with comprehensive sign production and installation services.

We will take care of every aspect of your sign installation to make sure it looks right and everything works properly. We will not stop until we ensure your complete satisfaction. Our team will ensure that your custom signs, banners, and digital platys are hung safely and securely.

We have the latest tools and technologies to quickly get your digital sign and running. We will go the extra mile to ensure that your sign adheres to local building codes and requirements. If needed, we will obtain permits on your behalf so that you can focus on other pressing areas of your business.

Sign Assign can handle all your fabrication and sign installation needs. Our experts will work with you to create a design that stands out from the rest. After we’ve received your approval on the design and have an estimated date for the completion of fabrication, we’ll get in touch with you to schedule installation.

Our experts will come to your place with all the required tools and ensure the safe installation of the sign. We will take care of all inspection requirements promptly. You can rely on us for our expertise and experience in sign installation."
            ],
            "Permitting" => [
                "fullTitle" => "Get Your Permit Needs Sorted",
                "description" => "Getting a new sign is a tough process where you’d need the help of an expert sign services provider such as Sign Assign to assist you in the process. Getting a sign permit is a significant hassle in installing your shiny new sign. Cities, counties, and municipalities have codes and ordinances governing areas such as sign design, installation, fabrication, and more.

Your building owner or property manager might also have rules you’d need to adhere to. Handling all such complex legwork can be a hassle. This is where we come into play. At Sign Assign, we have significant expertise in handling sign permits and installation. We will ensure you get the right permits for your signs and that the design meets the rules and standards of all governing bodies.

Now, requirements vary from city to city; here are some general paperwork and items needed to obtain a permit:

Your business licenses
Your tenancy agreement if leasing out a building
An agreement with a licensed sign contractor who’ll apply for a permit
Documents outlining the size of the sign and locations where it will be installed
Documents mentioning the method of installation and other necessary methods of construction.

Once we receive your permits, we will kickstart the production and installation process. We will ensure that you get your sign in no time. Sign Assign is committed to providing quality and affordable services that meet your unique needs and requirements. With us, you’re in safe hands!"
            ],
            "Code Review And Compliance" => [
                "fullTitle" => "Comprehensive Code Review and Compliance Services",
                "description" => "Getting a sign involves a lot of processes. You need to comply with the relevant rules and regulations for your signs. You need to adhere to various building codes, and it can be hard to remember everything. This is where you need expert code review and compliance services to ensure that you’re not breaking the law!

This is where Sign Assign can assist you. Process. Cities, counties, and municipalities have codes and ordinances that govern areas such as sign design, installation, fabrication, and more. Our experts will take care of everything and ensure that your bright, new, shiny sign complies with all the relevant standards.

We have comprehensive knowledge of building codes and sign requirements. Whether you want to evaluate your existing sign or get a new one that complies with the relevant code, we are here to help you! Get in touch with our experts today!"
            ],
            "Sign Engineering" => [
                "fullTitle" => "Expert Sign Engineering Services",
                "description" => "Ensuring the longevity and safety of your brand-new sign should be of utmost importance. This is where you need quality sign engineering services to help create a flawless product that accurately reflects the identity of your business.

Sign Assign can provide you with expert sign engineering services that fulfill all city codes and landlord requirements. We will analyze all building codes and relevant area standards to get you the best sign possible.

We have comprehensive knowledge of different signage engineering requirements and use the best industry-standard practices in our engineering process. We will guide you on the different aspects of structural engineering and technical construction that may be required for your signage.

Our sign engineering team is in constant contact with the design, sales, and manufacturing team to ensure we apply the best practices in the design and final drawing stage of the signing process.

Our design team will incorporate the best engineering, material, and construction methods in the design drawings to create a product that meets your unique needs and requirements.

We can also work with your existing sign or create one from scratch. We are prompt in providing our collective design ideas so that we can turn your vision into a reality. Our seamless integration between the design and fabrication process ensures you get the best product possible.

We are here to cater to all your signage needs. Regardless of the industry, you operate in, we will create a product you’ll fall in love with! Get in touch with us today!"
            ],
            "Sign Repairs" => [
                "fullTitle" => "Premium Sign Services & Repairs",
                "description" => "Even the most durable and well-made signs show wear and tear when used extensively over the years. Sometimes a good pressure wash or cleaning can make your old sign look brand new! Occasional sign services and repair are important to ensure the longevity and integrity of your signage

The type of service or repair required depends on the signage installed on your premises. Electrical and lighted signs need frequent servicing and repair to function optimally.

If your sign is damaged, malfunctioned, or needs a thorough clean, Sign Assign has you covered! We offer premium sign services and repairs that will make your old, rusty sign look new in no time. We can sort out EMC, illumination, and neon issues for all your electrical signs. No matter what type of sign you have, we will make sure to give it a nice clean that makes it look shiny new!

We also offer to retrofit and refurbish signs that have seen their better days. Our refurbishment service will ensure that your sign looks new for years to come. Our team has considerable experience and the necessary skills to repair any electrical and structural sign problem to ensure the longevity and integrity of your sign.

We pride ourselves on providing our customers with prompt, efficient, and reliable services and repairs. Our unwavering commitment to quality and exceptional services has enabled us to become one of the best sign services and repairs companies in Texas. You can contact us today for all your sign repair and servicing needs!"
            ]
        ];

        $data = [
            'title' => $serviceName,
            'page_heading' => $serviceName,
            'data' => [
                'serviceData' => $serviceMaster[$serviceName]
            ]
        ];

        return view('web/service-detail', $data);
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

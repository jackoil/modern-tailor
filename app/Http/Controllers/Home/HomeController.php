<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Facades\App;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Setting;
use App\Models\ContactUs;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Auth;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

class HomeController extends Controller
{
    public function index()
    {
        if (session()->has("lang")) {
            App::setLocale(session()->get("lang"));
        }

        SEOTools::setTitle('Home');
        SEOTools::setDescription('This is my page description');
        SEOTools::setCanonical('https://codecasts.com.br/lesson');

        SEOTools::opengraph()->setDescription('modern-tailor');
        SEOTools::opengraph()->setUrl(route('home.index'));
        SEOTools::opengraph()->addProperty('type', 'articles');

        SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        $sliders = Banner::where('type', 'slider')->where('is_active', 1)->orderBy('priority')->get();
        $indexTopBanners = Banner::where('type', 'index-top')->where('is_active', 1)->orderBy('priority')->get();
        $indexBottomBanners = Banner::where('type', 'index-bottom')->where('is_active', 1)->orderBy('priority')->get();

        $products = Product::where('is_active', 1)->get()->take(5);

        // $product = Product::find(3);

        // dd($product->sale_check);
        return view('home.index', compact('sliders', 'indexTopBanners', 'indexBottomBanners', 'products'));
    }

    public function aboutUs()
    {
        $bottomBanners = Banner::where('type', 'index-bottom')->where('is_active', 1)->orderBy('priority')->get();
        return view('home.about-us', compact('bottomBanners'));
    }

    function contactUs()
    {
        $setting = Setting::findOrFail(1);
        return view('home.contact-us', compact('setting'));
    }

    function contactUsForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4|max:50',
            'email' => 'required|email',
            'subject' => 'required|string|min:4|max:100',
            'text' => 'required|string|min:4|max:3000',
            'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('contact_us')]
        ]);

        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'text' => $request->text,
        ]);

        alert()->success('پیام شما با موفقیت ثبت شد', 'با تشکر');
        return redirect()->back();
    }

    function blogHome()
    {

        SEOTools::setTitle('blog');
        SEOTools::setDescription('This is my page description');
        SEOTools::setCanonical('https://codecasts.com.br/lesson');

        SEOTools::opengraph()->setDescription('modern-tailor');
        SEOTools::opengraph()->setUrl(route('home.blog.index'));
        SEOTools::opengraph()->addProperty('type', 'articles');

        SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        $category = "blog";
        // $products = DB::table('products')
        // ->join('categories','products.category_id','=','categories.id')
        // ->where('categories.name' ,  '=='  ,'blog'  )
        // ->where('products.is_active', 1)->orderBy('products.created_at')
        // ->select('products.*' );

        $category = Category::where('name','blog');

        $products = $category->first()->products()->paginate(5);

        $banners = Banner::where('type', '=' , "blog")->where('is_active', '=',1)->orderBy('priority');
        $bannerImage ="";
        if( $banners->first())
            $bannerImage = env('BANNER_IMAGES_UPLOAD_PATH') . $banners->first()->image ;

        return view('home.blog.blog-home', compact(['products' ,'banners','bannerImage']));
    }


      /**
     * Display the specified blog.
     *
     * @param  int  $id
     * @return \Illuminate\Http\View
     */
    function blogDetail(String $slug)
    {
        $product = Product::where(  'slug', $slug)->firstOrFail();
        SEOTools::setTitle($product->title);
        SEOTools::setDescription($product->description);
        SEOTools::setCanonical( $product->url );

        SEOTools::opengraph()->setDescription('modern-tailor');
        SEOTools::opengraph()->setUrl(route('home.blog.index'));
        SEOTools::opengraph()->addProperty('type', 'blog');


        //   dd($product->images);
        return view('home.blog.blog-detail', compact( 'product' ));
    }

    function addComment(String $slug ,Request $req){
        $product = Product::where(  'slug', $slug)->firstOrFail();
        $comment = Comment::create([
                  'product_id' => $product->id,
                  'text' => $req->text,
                  'user_id' => Auth::user()->id,
                  'approved' => 1
        ]);
          $comment->save() ;

        return view('home.blog.blog-detail', compact( 'product' ));
    }

}

<?php

use App\Models\User;
use App\Notifications\OTPSms;
use Ghasedak\GhasedaksmsApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Home\AddressController;
use App\Http\Controllers\Home\CompareController;
use App\Http\Controllers\Home\PaymentController;
use App\Http\Controllers\Home\SitemapController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Home\WishlistController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Home\UserProfileController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Home\UsersProfileController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Home\CommentController as HomeCommentController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\CategoryController as HomeCategoryController;
use Ghasedak\DataTransferObjects\Request\SingleMessageDTO;
use Ghasedak\Exceptions\GhasedakSMSException;
use Ghasedak\GhasedakApi;
use Illuminate\Support\Facades\App;
use Ipe\Sdk\Facades\SmsIr;
//use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/admin-panel/dashboard', [AdminController::class , 'index'])->name('dashboard');
Route::get('/admin-panel/login', [AdminController::class , 'login'])->name('dashboard.login');

Route::prefix('admin-panel/management')->name('admin.')->group(function () {

    Route::resource('brands', BrandController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('products', ProductController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);

    Route::get('/comments/{comment}/change-approve', [CommentController::class, 'changeApprove'])->name('comments.change-approve');

    Route::get('/categories/{category}/change-active', [CategoryController::class, 'changeActive'])->name('categories.change-active');




    // Get Category Attributes
    Route::get('/category-attributes/{category}', [CategoryController::class, 'getCategoryAttributes']);

    // Edit Product Image
    Route::get('/products/{product}/images-edit', [ProductImageController::class, 'edit'])->name('products.images.edit');
    Route::delete('/products/{product}/images-destroy', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
    Route::put('/products/{product}/images-set-primary', [ProductImageController::class, 'setPrimary'])->name('products.images.set_primary');
    Route::post('/products/{product}/images-add', [ProductImageController::class, 'add'])->name('products.images.add');

    // Edit Product Category
    Route::get('/products/{product}/category-edit', [ProductController::class, 'editCategory'])->name('products.category.edit');
    Route::put('/products/{product}/category-update', [ProductController::class, 'updateCategory'])->name('products.category.update');
});


Route::get('/site/{locale}', function (string $locale) {

    if (  in_array($locale, ['en', 'fa', 'fr'])) {
        App::setLocale($locale);
        session()->put('lang', $locale);
    }

    return redirect()->back();


    // ...
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/categories/{category:slug}', [HomeCategoryController::class, 'show'])->name('home.categories.show');
Route::get('/products/{product:slug}', [HomeProductController::class, 'show'])->name('home.products.show');
Route::post('/comments/{product}', [HomeCommentController::class, 'store'])->name('home.comments.store');

Route::get('/add-to-wishlist/{product}', [WishlistController::class, 'add'])->name('home.wishlist.add');
Route::get('/remove-from-wishlist/{product}', [WishlistController::class, 'remove'])->name('home.wishlist.remove');

Route::get('/compare', [CompareController::class, 'index'])->name('home.compare.index');
Route::get('/add-to-compare/{product}', [CompareController::class, 'add'])->name('home.compare.add');
Route::get('/remove-from-compare/{product}', [CompareController::class, 'remove'])->name('home.compare.remove');

Route::get('/cart', [CartController::class, 'index'])->name('home.cart.index');
Route::post('/add-to-cart', [CartController::class, 'add'])->name('home.cart.add');
Route::get('/remove-from-cart/{rowId}', [CartController::class, 'remove'])->name('home.cart.remove');
Route::put('/cart', [CartController::class, 'update'])->name('home.cart.update');
Route::get('/clear-cart', [CartController::class, 'clear'])->name('home.cart.clear');
Route::post('/check-coupon', [CartController::class, 'checkCoupon'])->name('home.coupons.check');
Route::get('/checkout', [CartController::class, 'checkout'])->name('home.orders.checkout');

Route::post('/payment', [PaymentController::class, 'payment'])->name('home.payment');
Route::get('/payment-verify/{gatewayName}', [PaymentController::class, 'paymentVerify'])->name('home.payment_verify');

//Route::any('/login', [AuthController::class, 'login'])->name('login');


Route::prefix('profile')->name('home.')->middleware('auth')->group(function () {
    Route::get('/', [UserProfileController::class, 'index'])->name('users_profile.index');

    Route::post('/edit', [UserProfileController::class, 'edit'])->name('users_profile.edit');


    Route::get('/comments', [HomeCommentController::class, 'usersProfileIndex'])->name('comments.users_profile.index');

    Route::get('/wishlist', [WishlistController::class, 'usersProfileIndex'])->name('wishlist.users_profile.index');

    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');

    Route::get('/orders', [CartController::class, 'usersProfileIndex'])->name('orders.users_profile.index');
});

Route::get('/get-province-cities-list', [AddressController::class, 'getProvinceCitiesList']);

Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('home.about-us');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('home.contact-us');
Route::post('/contact-us-form', [HomeController::class, 'contactUsForm'])->name('home.contact-us.form');


Route::get('/blog', [HomeController::class, 'bLogHome'])->name('home.blog.index');
Route::get('/blog/{slug}', [HomeController::class, 'bLogDetail'])->name('home.blog.view');
Route::post('/blog/{slug}/comments/add', [HomeController::class, 'addComment'])->name('home.blog.addcomment');


Route::get('/sitemap', [SitemapController::class, 'index'])->name('home.sitemap.index');
Route::get('/sitemap-products', [SitemapController::class, 'sitemapProducts'])->name('home.sitemap.products');
Route::get('/sitemap-tags', [SitemapController::class, 'sitemapTags'])->name('home.sitemap.tags');




Route::get('/login/{provider}' , [AuthController::class,'redirectToProvider']  )->name('provider.login');
Route::get('/login/{provider}/callback' , [AuthController::class,'handleProviderCallback']  )->name('provider.handlek');

//otp

  Route::any('/loginSms' , [AuthController::class,'loginSms']  )->name('loginSms');
  Route::post('/check-otp' , [AuthController::class , 'checkOtp']);
  Route::post('/resend-otp' , [AuthController::class , 'resendOtp']);



Route::get('/test', function (Request $request ) {


    // $mobile = "09361722175"; // شماره موبایل گیرنده
    // $templateId = 123456 ; // شناسه الگو
    // $parameters = [
    //     [
    //         "name" => "Code",
    //         "value" => "12345"
    //     ]
    // ];

    //  $response = SmsIr::verifySend($mobile, $templateId, $parameters);
    //   dd($response);
    $receptor = '09361722175';
    $message =  "code = 12345";
   // $response = GhasedakFacade::SendSimple($receptor, $message, $lineNumber = null, $sendDate = null, $checkId = null);
    // $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
     // dd($api->sendSimple($receptor, $message));




        //   $ghasedaksms = new GhasedaksmsApi(env('GHASEDAK_API_KEY'));
        //   $sendDate = new DateTimeImmutable('now');
        //   $lineNumber = '30005088';

        //   try {
        //       $response = $ghasedaksms->sendSingle(new SingleMessageDTO(
        //             $sendDate,
        //             $lineNumber,
        //             $receptor,
        //             $message
        //       ));
        //      //// dd($response);
        //   } catch ( GhasedakSMSException  $e) {
        //        dd($e->getMessage());
        //   }
         $user = User::find(1);
         $user->notify(new  OTPSms(1234));

      //



});

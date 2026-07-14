<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\GalleryPickerController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MyTourController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ChatSessionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\InstagramController;
use App\Models\Tour;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    $featuredTours = Tour::where('is_featured', true)->take(5)->get();
    return view('pages.about', compact('featuredTours'));
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('admin/packages')->name('admin.packages.')->group(function () {
        Route::get('/', [PackageController::class, 'index'])->name('index');
        Route::get('/create', [PackageController::class, 'create'])->name('create');
        Route::post('/', [PackageController::class, 'store'])->name('store');
        Route::get('/{tour}/edit', [PackageController::class, 'edit'])->name('edit');
        Route::put('/{tour}', [PackageController::class, 'update'])->name('update');
        Route::delete('/{tour}', [PackageController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('admin/destinations')->name('admin.destinations.')->group(function () {
        Route::get('/', [AdminDestinationController::class, 'index'])->name('index');
        Route::get('/create', [AdminDestinationController::class, 'create'])->name('create');
        Route::post('/', [AdminDestinationController::class, 'store'])->name('store');
        Route::get('/{destination}/edit', [AdminDestinationController::class, 'edit'])->name('edit');
        Route::put('/{destination}', [AdminDestinationController::class, 'update'])->name('update');
        Route::delete('/{destination}', [AdminDestinationController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-destroy', [AdminDestinationController::class, 'bulkDestroy'])->name('bulkDestroy');
    });
    Route::prefix('admin/cities')->name('admin.cities.')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('index');
        Route::get('/create', [CityController::class, 'create'])->name('create');
        Route::post('/', [CityController::class, 'store'])->name('store');
        Route::get('/{city}/edit', [CityController::class, 'edit'])->name('edit');
        Route::put('/{city}', [CityController::class, 'update'])->name('update');
        Route::delete('/{city}', [CityController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-destroy', [CityController::class, 'bulkDestroy'])->name('bulkDestroy');
    });
    Route::prefix('admin/analytics')->name('admin.analytics.')->group(function () {
        Route::get('/', [AnalyticsController::class, 'index'])->name('index');
    });
    Route::get('/admin/gallery-picker', [GalleryPickerController::class, 'index'])->name('admin.gallery-picker');
    Route::prefix('admin/media')->name('admin.media.')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('index');
        Route::delete('/destroy', [MediaController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-delete', [MediaController::class, 'bulkDelete'])->name('bulkDelete');
    });
    Route::prefix('admin/my-tours')->name('admin.my-tours.')->group(function () {
        Route::get('/', [MyTourController::class, 'index'])->name('index');
        Route::get('/create', [MyTourController::class, 'create'])->name('create');
        Route::post('/', [MyTourController::class, 'store'])->name('store');
        Route::get('/{myTour}/edit', [MyTourController::class, 'edit'])->name('edit');
        Route::put('/{myTour}', [MyTourController::class, 'update'])->name('update');
        Route::delete('/{myTour}', [MyTourController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('admin/faqs')->name('admin.faqs.')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::get('/create', [FaqController::class, 'create'])->name('create');
        Route::post('/', [FaqController::class, 'store'])->name('store');
        Route::get('/{faq}/edit', [FaqController::class, 'edit'])->name('edit');
        Route::put('/{faq}', [FaqController::class, 'update'])->name('update');
        Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('admin/chat-sessions')->name('admin.chat-sessions.')->group(function () {
        Route::get('/', [ChatSessionController::class, 'index'])->name('index');
        Route::delete('/{chatSession}', [ChatSessionController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-destroy', [ChatSessionController::class, 'bulkDestroy'])->name('bulkDestroy');
    });
    Route::prefix('admin/settings')->name('admin.settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/', [SettingController::class, 'update'])->name('update');
    });
    Route::prefix('admin/contact')->name('admin.contact.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::put('/', [ContactController::class, 'update'])->name('update');
    });
    Route::prefix('admin/cars')->name('admin.cars.')->group(function () {
        Route::get('/', [CarController::class, 'index'])->name('index');
        Route::get('/create', [CarController::class, 'create'])->name('create');
        Route::post('/', [CarController::class, 'store'])->name('store');
        Route::get('/{car}/edit', [CarController::class, 'edit'])->name('edit');
        Route::put('/{car}', [CarController::class, 'update'])->name('update');
        Route::delete('/{car}', [CarController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-destroy', [CarController::class, 'bulkDestroy'])->name('bulkDestroy');
    });
    Route::prefix('admin/blog')->name('admin.blog.')->group(function () {
        Route::get('/', [AdminBlogController::class, 'index'])->name('index');
        Route::get('/create', [AdminBlogController::class, 'create'])->name('create');
        Route::post('/', [AdminBlogController::class, 'store'])->name('store');
        Route::get('/{blog}/edit', [AdminBlogController::class, 'edit'])->name('edit');
        Route::put('/{blog}', [AdminBlogController::class, 'update'])->name('update');
        Route::delete('/{blog}', [AdminBlogController::class, 'destroy'])->name('destroy');

        // Blog Comments Moderation
        Route::prefix('comments')->name('comments.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\BlogCommentController::class, 'index'])->name('index');
            Route::patch('/{comment}/approve', [\App\Http\Controllers\Admin\BlogCommentController::class, 'approve'])->name('approve');
            Route::patch('/{comment}/reject', [\App\Http\Controllers\Admin\BlogCommentController::class, 'reject'])->name('reject');
            Route::delete('/{comment}', [\App\Http\Controllers\Admin\BlogCommentController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::prefix('tours')->name('tours.')->group(function () {
    Route::get('/', [TourController::class, 'index'])->name('index');
    Route::get('/packages', [TourController::class, 'packages'])->name('packages');
    Route::get('/{slug}', [TourController::class, 'show'])->name('show');
});

Route::prefix('destinations')->name('destinations.')->group(function () {
    Route::get('/', [DestinationController::class, 'index'])->name('index');
    Route::get('/{slug}', [DestinationController::class, 'show'])->name('show');
});

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{blog}/comment', [BlogController::class, 'storeComment'])->name('comments.store');
});

Route::post('/chatbot', [\App\Http\Controllers\ChatbotController::class, 'chat'])->name('chatbot.chat');

Route::get('/instagram/feed', [InstagramController::class, 'feed'])->name('instagram.feed');

Route::get('/sitemap.xml', function () {
    $baseUrl = config('app.url', 'https://jogja.bandungdrivertour.com');
    $lastModified = now()->toAtomString();

    $tours = \App\Models\Tour::where('is_active', true)->get(['id','slug','updated_at']);
    $destinations = \App\Models\Destination::where('is_active', true)->get(['id','slug','updated_at']);
    $blogs = \App\Models\Blog::where('is_active', true)->get(['id','slug','updated_at']);

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    $staticPages = [
        ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
        ['loc' => '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => '/contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => '/tours', 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/tours/packages', 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/destinations', 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/blog', 'priority' => '0.8', 'changefreq' => 'daily'],
    ];

    foreach ($staticPages as $page) {
        $xml .= '  <url>' . "\n";
        $xml .= '    <loc>' . $baseUrl . $page['loc'] . '</loc>' . "\n";
        $xml .= '    <lastmod>' . $lastModified . '</lastmod>' . "\n";
        $xml .= '    <changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
        $xml .= '    <priority>' . $page['priority'] . '</priority>' . "\n";
        $xml .= '  </url>' . "\n";
    }

    foreach ($tours as $tour) {
        $xml .= '  <url>' . "\n";
        $xml .= '    <loc>' . $baseUrl . '/tours/' . $tour->slug . '</loc>' . "\n";
        $xml .= '    <lastmod>' . $tour->updated_at->toAtomString() . '</lastmod>' . "\n";
        $xml .= '    <changefreq>weekly</changefreq>' . "\n";
        $xml .= '    <priority>0.7</priority>' . "\n";
        $xml .= '  </url>' . "\n";
    }

    foreach ($destinations as $dest) {
        $xml .= '  <url>' . "\n";
        $xml .= '    <loc>' . $baseUrl . '/destinations/' . $dest->slug . '</loc>' . "\n";
        $xml .= '    <lastmod>' . $dest->updated_at->toAtomString() . '</lastmod>' . "\n";
        $xml .= '    <changefreq>weekly</changefreq>' . "\n";
        $xml .= '    <priority>0.7</priority>' . "\n";
        $xml .= '  </url>' . "\n";
    }

    foreach ($blogs as $blog) {
        $xml .= '  <url>' . "\n";
        $xml .= '    <loc>' . $baseUrl . '/blog/' . $blog->slug . '</loc>' . "\n";
        $xml .= '    <lastmod>' . $blog->updated_at->toAtomString() . '</lastmod>' . "\n";
        $xml .= '    <changefreq>monthly</changefreq>' . "\n";
        $xml .= '    <priority>0.6</priority>' . "\n";
        $xml .= '  </url>' . "\n";
    }

    $xml .= '</urlset>';

    return response($xml, 200)
        ->header('Content-Type', 'application/xml')
        ->header('Cache-Control', 'public, max-age=3600');
});

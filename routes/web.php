<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FootballController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\HomeController as AdminHomeAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/sign-up', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'save'])->name('register.post');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about.us');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact.us');
Route::post('/contact-save', [HomeController::class, 'contactSave'])->name('contact.save');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/how-to-play', [HomeController::class, 'howToPlay'])->name('how.to.play');
Route::get('/terms-condition', [HomeController::class, 'termsCondition'])->name('terms.condition');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/personal-data-policy', [HomeController::class, 'personalDataPolicy'])->name('personal.data.policy');


Route::get('/leagues', [FootballController::class, 'getLeague'])->name('leagues');
Route::get('/league/{leagueId}/matches', [FootballController::class, 'getLeagueMatches'])->name('leagueMatches');
Route::get('/matche-detail/{matcheId}', [FootballController::class, 'matchDetails'])->name('matche-detail');
Route::get('/getLeagueTeams/{leagueId}/{season}', [FootballController::class, 'getLeagueTeams'])->name('getLeagueTeams');
Route::get('/getLeagueTeamPlayer/{leagueId}/{season}', [FootballController::class, 'getLeagueTeams'])->name('getLeagueTeams');
Route::post('/create-team', [FootballController::class, 'createTeam'])->name('create-team');
Route::get('/my-team', [FootballController::class, 'viewTeam'])->name('my-team')->middleware('myTeamMiddleware');
Route::get('/current-team-count', [FootballController::class, 'currentTeamCount'])->name('current-team-count');
Route::get('/auth.check', [FootballController::class, 'AuthCheck'])->name('auth.check');
Route::post('/make-captain', [FootballController::class, 'makeCaptain'])->name('make.captain');
// Route::get('/proxy-image', function(Request $request) {
//     $url = $request->query('url');
//     $cacheKey = 'proxy_image_' . md5($url);

//     // Check if the image is already cached
//     if (Cache::has($cacheKey)) {
//         return response(Cache::get($cacheKey))->header('Content-Type', 'image/jpeg');
//     }

//     // Fetch the image from the external source
//     $image = file_get_contents($url);

//     // Cache the image
//     Cache::put($cacheKey, $image, now()->addDays(7)); // Cache for 7 days

//     return response($image)->header('Content-Type', 'image/jpeg');
// });
Route::middleware('auth')->group(function () {

    Route::get('/save-team', [FootballController::class, 'saveTeam'])->name('save-team');
    Route::prefix('profile')->group(function () {
        Route::get('/my-profile', [ProfileController::class, 'myProfile'])->name('profile.profile');
        Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change.password');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
        Route::get('/my-matches', [ProfileController::class, 'myMatches'])->name('profile.matches');
        Route::get('/match-detail/{leagueId}/{matchId}', [ProfileController::class, 'matchDetails'])->name('profile.match-detail');
        Route::post('/profile/update-pic', [ProfileController::class, 'updateProfilePic'])->name('profile.update-pic');

    });
});


Route::prefix('admin')->group(function () {

    Route::get('/login',[AdminAuthController::class,'login'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'authLogin'])->name('admin.auth.login');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard',[AdminAuthController::class,'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminHomeAuthController::class, 'getUsersList'])->name('admin.users');
        Route::get('/contact-us', [AdminHomeAuthController::class, 'contactList'])->name('admin.contact');

    });
});

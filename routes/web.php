<?php
namespace App\Http\Controllers;

use Auth;
use Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteTokenController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('privacy', function () {
    return view('privacy');
});

Route::get('terms', function () {
    return view('terms');
});

//Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'verified'])->group(function () {

	Route::resource('appointments', AppointmentController::class);
	Route::resource('contacts', ContactController::class);

	Route::get('accounts/{account}/t', [AccountController::class, 't']);
	Route::resource('accounts', AccountController::class);
	Route::resource('accounts.subaccounts', SubAccountController::class)->scoped();

	Route::resource('invoices', InvoiceController::class);
	Route::resource('invoices.payments', PaymentController::class)->scoped();

	Route::resource('expenses', ExpenseController::class);
	Route::resource('expenses.receipts', ReceiptController::class)->scoped();

	Route::resource('transactions', TransactionController::class);
	Route::resource('transactions.journals', JournalController::class)->scoped();

	Route::resource('topics', MessageTopicController::class);
	Route::resource('topics.messages', MessageController::class)->scoped();

	Route::resource('projects', ProjectController::class);
	Route::resource('projects.volunteers', VolunteerController::class)->scoped();

	Route::get('login/google', [SocialiteTokenController::class, 'redirectToGoogleProvider']);
	Route::get('login/google/callback', [SocialiteTokenController::class, 'handleGoogleProviderCallback']);

	Route::get('login/microsoft', [SocialiteTokenController::class, 'redirectToMicrosoftProvider']);
	Route::get('login/microsoft/callback', [SocialiteTokenController::class, 'handleMicrosoftProviderCallback']);

	//Route::get('settings/createcalendar',  [SettingController::class, 'createCalendar']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
//Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', 'invoices')->name('dashboard');

Route::get('teams/switch/{team}', [HomeController::class, 'switchteam']);

Route::get('logout', function (){
	# code...
	Auth::logout();
	return redirect(route('login'));
});

Route::get('firstrun', function (){
	return view("auth.first-time");
});
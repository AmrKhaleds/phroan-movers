<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('home');
});



Route::group(
    [
        'prefix' => 'acp',
    ],
    function () {


        Route::get('/deploy',[App\Http\Controllers\HomeController::class, 'deploy']);


        Auth::routes(['register' => false]);

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//        HR

        //                  Categories
        Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
        Route::get('/category/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');

        //                  Knows
        Route::get('/knows', [App\Http\Controllers\KnowController::class, 'index'])->name('knows.index');
        Route::get('/know/create', [App\Http\Controllers\KnowController::class, 'create'])->name('knows.create');
        Route::post('/know/store', [App\Http\Controllers\KnowController::class, 'store'])->name('knows.store');
        Route::get('/know/edit/{id}', [App\Http\Controllers\KnowController::class, 'edit'])->name('knows.edit');
        Route::post('/know/update/{id}', [App\Http\Controllers\KnowController::class, 'update'])->name('knows.update');
        Route::get('/know/destroy/{id}', [App\Http\Controllers\KnowController::class, 'destroy'])->name('knows.destroy');

        //                  Knows
        Route::get('/receivedphones', [App\Http\Controllers\ReceivedController::class, 'index'])->name('receivedphones.index');
        Route::get('/receivedphone/create', [App\Http\Controllers\ReceivedController::class, 'create'])->name('receivedphones.create');
        Route::post('/receivedphone/store', [App\Http\Controllers\ReceivedController::class, 'store'])->name('receivedphones.store');
        Route::get('/receivedphone/edit/{id}', [App\Http\Controllers\ReceivedController::class, 'edit'])->name('receivedphones.edit');
        Route::post('/receivedphone/update/{id}', [App\Http\Controllers\ReceivedController::class, 'update'])->name('receivedphones.update');
        Route::get('/receivedphone/destroy/{id}', [App\Http\Controllers\ReceivedController::class, 'destroy'])->name('receivedphones.destroy');

        //                  Companies
        Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
        Route::get('/company/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
        Route::post('/company/store', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
        Route::get('/company/edit/{id}', [App\Http\Controllers\CompanyController::class, 'edit'])->name('companies.edit');
        Route::get('/company/show/{id}', [App\Http\Controllers\CompanyController::class, 'show'])->name('companies.show');
        Route::post('/company/update/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
        Route::get('/company/destroy/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');

        //                  PossibleExpenses
        Route::get('/possible_expenses', [App\Http\Controllers\PossibleExpensesController::class, 'index'])->name('possible_expenses.index');
        Route::post('/possible_expense/store', [App\Http\Controllers\PossibleExpensesController::class, 'store'])->name('possible_expenses.store');
        Route::post('/possible_expense/update/{id}', [App\Http\Controllers\PossibleExpensesController::class, 'update'])->name('possible_expenses.update');
        Route::get('/possible_expense/destroy/{id}', [App\Http\Controllers\PossibleExpensesController::class, 'destroy'])->name('possible_expenses.destroy');

        //                  Employees
        Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/employee/rest/password/{id}', [App\Http\Controllers\EmployeeController::class, 'RestPass'])->name('employees.rest.password');
        Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/employee/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employees.edit');
        Route::get('/employee/show/{id}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employees.show');
        Route::get('/employee/profile', [App\Http\Controllers\EmployeeController::class, 'profile'])->name('employees.profile');
        Route::post('/employee/update/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employees.update');
        Route::get('/employee/destroy/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employees.destroy');

        //                  Payroll
        Route::get('/payrolls', [App\Http\Controllers\PayrollController::class, 'index'])->name('payrolls.index');
        Route::get('/payroll/create', [App\Http\Controllers\PayrollController::class, 'create'])->name('payrolls.create');
        Route::post('/payroll/store', [App\Http\Controllers\PayrollController::class, 'store'])->name('payrolls.store');
        Route::get('/payroll/edit/{id}', [App\Http\Controllers\PayrollController::class, 'edit'])->name('payrolls.edit');
        Route::post('/payroll/update/{id}', [App\Http\Controllers\PayrollController::class, 'update'])->name('payrolls.update');
        Route::get('/payroll/status/{id}', [App\Http\Controllers\PayrollController::class, 'status'])->name('payrolls.status');


//        CARS


        Route::resource('/workers', App\Http\Controllers\WorkerController::class);
        Route::get('/workers/delete/{id}', [App\Http\Controllers\WorkerController::class,'destroy'])->name('workers.destroy');

        //                  Vehicles
        Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'index'])->name('vehicles.index');
        Route::get('/vehicle/create', [App\Http\Controllers\VehicleController::class, 'create'])->name('vehicles.create');
        Route::post('/vehicle/store', [App\Http\Controllers\VehicleController::class, 'store'])->name('vehicles.store');
        Route::get('/vehicle/edit/{id}', [App\Http\Controllers\VehicleController::class, 'edit'])->name('vehicles.edit');
        Route::post('/vehicle/update/{id}', [App\Http\Controllers\VehicleController::class, 'update'])->name('vehicles.update');
        Route::get('/vehicle/status/{id}/{status}', [App\Http\Controllers\VehicleController::class, 'status'])->name('vehicles.status');
        Route::get('/vehicle/destroy/{id}', [App\Http\Controllers\VehicleController::class, 'destroy'])->name('vehicles.destroy');

        //                  Assign Vehicles
        Route::get('/assign_cars/{id}', [App\Http\Controllers\AssignCarController::class, 'index'])->name('assign_cars.index');
        Route::post('/assign_car/store/{id}', [App\Http\Controllers\AssignCarController::class, 'store'])->name('assign_cars.store');
        Route::post('/assign_car/storeAssign', [App\Http\Controllers\AssignCarController::class, 'storeAssign'])->name('assign_cars.storeAssign');
        Route::get('/assign_car/leave/{id}', [App\Http\Controllers\AssignCarController::class, 'leave'])->name('assign_cars.leave');
        Route::post('/assign_car/update/{id}', [App\Http\Controllers\AssignCarController::class, 'update'])->name('assign_cars.update');
        Route::get('/assign_car/destroy/{id}', [App\Http\Controllers\AssignCarController::class, 'destroy'])->name('assign_cars.destroy');

        //                  By CronJob
        Route::get('/assign_car/leave_all', [App\Http\Controllers\AssignCarController::class, 'leave_all']);

        //                  Maintenance
        Route::get('/maintenances', [App\Http\Controllers\MaintenanceController::class, 'index'])->name('maintenances.index');
        Route::get('/maintenance/create', [App\Http\Controllers\MaintenanceController::class, 'create'])->name('maintenances.create');
        Route::post('/maintenance/store', [App\Http\Controllers\MaintenanceController::class, 'store'])->name('maintenances.store');
        Route::get('/maintenance/edit/{id}', [App\Http\Controllers\MaintenanceController::class, 'edit'])->name('maintenances.edit');
        Route::post('/maintenance/update/{id}', [App\Http\Controllers\MaintenanceController::class, 'update'])->name('maintenances.update');
        Route::get('/maintenance/destroy/{id}', [App\Http\Controllers\MaintenanceController::class, 'destroy'])->name('maintenances.destroy');

//        Booking

        //                  Booking
        Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
        Route::get('/booking/create', [App\Http\Controllers\BookingController::class, 'create'])->name('bookings.create');
        Route::get('/booking/quick_create', [App\Http\Controllers\BookingController::class, 'QuickCreate'])->name('bookings.quick_create');
        Route::get('/booking/search_phone', [App\Http\Controllers\BookingController::class, 'SearchPhone'])->name('bookings.search.phone');
        Route::post('/booking/store', [App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
        Route::get('/booking/show/{id}', [App\Http\Controllers\BookingController::class, 'show'])->name('bookings.show');
        Route::get('/booking/show_old/{id}', [App\Http\Controllers\BookingController::class, 'show_old'])->name('bookings.show.old');
        Route::get('/booking/edit/{id}', [App\Http\Controllers\BookingController::class, 'edit'])->name('bookings.edit');
        Route::post('/booking/update/{id}', [App\Http\Controllers\BookingController::class, 'update'])->name('bookings.update');
        Route::get('/booking/destroy/{id}', [App\Http\Controllers\BookingController::class, 'destroy'])->name('bookings.destroy');
        Route::post('/booking/rate', [App\Http\Controllers\BookingController::class, 'rate'])->name('bookings.rate');

        //                  Attendant
        Route::get('/attendants/type/{type}', [App\Http\Controllers\AttendantController::class, 'index'])->name('attendants.index');
        Route::get('/attendant/status/{id}', [App\Http\Controllers\AttendantController::class, 'Status'])->name('attendants.status');
        Route::get('/attendant/destroy/{id}', [App\Http\Controllers\AttendantController::class, 'destroy'])->name('attendants.destroy');

        //                  Traking
        Route::get('/trakings', [App\Http\Controllers\TrakingController::class, 'index'])->name('trakings.index');
        Route::get('/traking/calender', [App\Http\Controllers\TrakingController::class, 'calender'])->name('trakings.calender');
        Route::get('/traking/calender/ajax', [App\Http\Controllers\TrakingController::class, 'dataAjax'])->name('get.ajax.calendar');
        Route::get('/traking/assign/{id}/{assign_to}', [App\Http\Controllers\TrakingController::class, 'assign'])->name('trakings.assign');
        Route::post('/traking/destroy/{id}', [App\Http\Controllers\TrakingController::class, 'destroy'])->name('trakings.destroy');
        Route::get('/traking/undestroy/{id}', [App\Http\Controllers\TrakingController::class, 'undestroy'])->name('trakings.undestroy');
        Route::get('/traking/status/{id}/{status}', [App\Http\Controllers\TrakingController::class, 'Status'])->name('trakings.status');


        Route::get('/expense_orders', [App\Http\Controllers\OrderExpenseController::class, 'index'])->name('expense_orders.index');
        Route::get('/expense_order/{id}', [App\Http\Controllers\OrderExpenseController::class, 'create'])->name('expense_order');
        Route::post('/expense_order', [App\Http\Controllers\OrderExpenseController::class, 'store'])->name('expense_order.store');
        Route::get('/expense_orders/delete/{id}', [App\Http\Controllers\OrderExpenseController::class, 'destroy'])->name('expense_orders.destroy');

//        Setting

        //                  Setting
        Route::get('/setting_km/create', [App\Http\Controllers\SettingController::class, 'create'])->name('setting_km.create');
        Route::get('/setting_km/check', [App\Http\Controllers\SettingController::class, 'check'])->name('setting_km.check');
        Route::get('/setting_duration/check', [App\Http\Controllers\SettingController::class, 'checkDuration'])->name('setting_duration.check');
        Route::post('/setting_km/store', [App\Http\Controllers\SettingController::class, 'store'])->name('setting_km.store');
        Route::get('/setting_km/new', [App\Http\Controllers\SettingController::class, 'New'])->name('setting_km.new');
        Route::get('/setting/create', [App\Http\Controllers\SettingController::class, 'createGeneral'])->name('setting.create');
        Route::post('/setting/store', [App\Http\Controllers\SettingController::class, 'storeGeneral'])->name('setting.store');




        // Accounting

        Route::get('/customers_balances', [App\Http\Controllers\CustomersBalanceController::class,'CustomersBalance'])->name('customers_balances');
        Route::get('/customers_balance/{id}', [App\Http\Controllers\CustomersBalanceController::class,'Show'])->name('customers_balance');

        Route::resource('/catch_receipts', App\Http\Controllers\CatchReceiptController::class);
        Route::get('/catch_receipt_details', [App\Http\Controllers\CatchReceiptController::class, 'CatchReceiptDetails'])->name('catch_receipts.details');
        Route::resource('/receipts', App\Http\Controllers\ReceiptController::class);

        Route::resource('/payments', App\Http\Controllers\PaymentsMethodController::class);

        // Tree
        Route::get('/tree', [App\Http\Controllers\AccountController::class, 'Tree'])->name('tree');
        Route::get('/get_account_ajax', [App\Http\Controllers\AccountController::class, 'AccountAjax'])->name('account.ajax');
        Route::get('/get_account_details', [App\Http\Controllers\AccountController::class, 'AccountDetails'])->name('account.details');
        Route::resource('/accounts', App\Http\Controllers\AccountController::class);

        Route::resource('/dailymoves', App\Http\Controllers\DailyMoveController::class);

        Route::get('/setting/account', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.account');
//        Route::post('/setting/store', [App\Http\Controllers\SettingController::class, 'store'])->name('setting.stores');

        // Report
        Route::get('/financial_center', [App\Http\Controllers\ReportAccountController::class, 'FinancialCenter'])->name('financial.center');
        Route::get('/report_tracking', [App\Http\Controllers\TrakingController::class, 'Report'])->name('report.tracking');


    });

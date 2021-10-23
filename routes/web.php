<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/locked', 'Auth\LockController@locked')->name('locked');

Route::post('/locked', 'Auth\LockController@unlock')->name('unlock');


// Route::get('/', 'HomeController@index')->middleware('auth.lock')->name('home');
Route::get('/', 'HomeController@index')->middleware('lock')->name('home');




// categories
Route::get('/categories', 'category\CategoryController@index')->name('categories');
Route::Post('/categories', 'category\CategoryController@store')->name('categories.store');
//Ajax
Route::Post('/categoryupdatestatus', 'category\CategoryController@categorystatus');
//End Ajax
Route::get('/categoryupdatepage/{id}', 'category\CategoryController@categoryupdatepage')->name('categorieupdatepage');
Route::post('/categoryupdatestore/{id}', 'category\CategoryController@categoryupdatestore')->name('categorieupdate.store');
Route::delete('/categorydeletestore/{id}', 'category\CategoryController@categorydelete')->name('categorieupdate.delete');

// user
Route::get('/user', 'user\UserController@index')->name('user');
Route::Post('/user', 'user\UserController@userstore')->name('user.store');
// Route::get('/profile', 'user\UserController@profile')->name('user.profile');
// Route::get('/profile/change', 'user\UserController@profilechange')->name('user.profile.change');
Route::get('/userupdatepage/{id}', 'user\UserController@userupdatepage')->name('userupdate');
Route::post('/userupdatestore/{id}', 'user\UserController@userupdatestore')->name('userupdate.store');
Route::delete('/userdeletestore/{id}', 'user\UserController@userdelete')->name('user.delete');

// message
Route::get('/message/{id}', 'user\UserController@message')->name('message');
Route::post('/messagesend', 'user\UserController@messagestore')->name('message.store');
Route::get('/messagedata', 'user\UserController@messagedata')->name('message.data');
Route::get('/sentmessage', 'user\UserController@sentmessage')->name('message.sent');
Route::get('/replymessage/{id}', 'user\UserController@replymessage')->name('message.reply');
Route::post('/replymessagestore', 'user\UserController@replystore')->name('message.replystore');
Route::get('/replymessagesview/{id}', 'user\UserController@replyview')->name('message.view');
Route::get('/sentmessagesviewds/{id}', 'user\UserController@sentviews')->name('message.sentview');
Route::get('/replysmmessage/{id}', 'user\UserController@replysmessage')->name('message.replys');
Route::delete('/replymessagesdelete/{id}', 'user\UserController@messagedelete')->name('message.delete');
Route::delete('/sentmessagesdelete/{id}', 'user\UserController@sentmessagedelete')->name('messagesent.delete');
Route::get('/messageuser', 'user\UserController@messageuser')->name('message.user');

// product
Route::get('/product', 'product\PrductController@index')->name('product');
Route::post('/productstore', 'product\PrductController@productstore')->name('product.store');
Route::get('/productdata', 'product\PrductController@data')->name('product.data');
//Ajax
Route::Post('/productupdatestatus', 'product\PrductController@productstatus');
//End Ajax
Route::get('/productupdatepage/{id}', 'product\PrductController@productupdatepage')->name('productupdatepage');
Route::get('/productview/{id}', 'product\PrductController@productview')->name('productview');
Route::get('/productattribute/{id}', 'Attribute\AttributeController@productattribute')->name('productattribute');
Route::post('/productattributecolorstore/{id}', 'Attribute\AttributeController@productattributecolorstore')->name('productattributecolorstore');
Route::post('/productattributestore/{id}', 'Attribute\AttributeController@productattributestore')->name('productattributestore');
Route::post('/productattributesupdate/{id}', 'Attribute\AttributeController@productattributeupdate')->name('productattributeupdate');
Route::get('/productattributesdelete/{id}', 'Attribute\AttributeController@productattributedelete')->name('productattribute.delete');

Route::post('/productupdatestore/{id}', 'product\PrductController@productupdatestore')->name('productupdate.store');
Route::delete('/productdeletestore/{id}', 'product\PrductController@productdelete')->name('product.delete');

// Expense
Route::get('/expense', 'Expense\ExpenseController@index')->name('expense');
Route::get('/expenseview', 'Expense\ExpenseController@view')->name('expense.view');
Route::Post('/expense', 'Expense\ExpenseController@store')->name('expense.store');
Route::get('/expenseupdatepage/{id}', 'Expense\ExpenseController@expenseupdatepage')->name('expenseupdatepage');
Route::post('/expenseupdatestore/{id}', 'Expense\ExpenseController@expenseupdatestore')->name('expenseupdate.store');
Route::delete('/expensedeletestore/{id}', 'Expense\ExpenseController@expensedelete')->name('expenseupdate.delete');

// Supplier
Route::get('/supplier', 'Supplier\SupplierController@index')->name('supplier');
Route::get('/suppliersview', 'Supplier\SupplierController@view')->name('supplier.view');
Route::Post('/suppliers', 'Supplier\SupplierController@store')->name('supplier.store');
Route::get('/suppliersupdatepage/{id}', 'Supplier\SupplierController@supplierupdatepage')->name('supplierupdatepage');
Route::post('/suppliersupdatestore/{id}', 'Supplier\SupplierController@supplierupdatestore')->name('supplierupdate.store');
Route::delete('/suppliersdeletestore/{id}', 'Supplier\SupplierController@supplierdelete')->name('supplierupdate.delete');

// Purchase
Route::get('/purchase', 'Purchase\PurchaseController@index')->name('Purchase');
Route::get('/purchaseadd/{id}', 'Purchase\PurchaseController@view')->name('Purchase.view');
Route::Post('/purchaseadd', 'Purchase\PurchaseController@store')->name('purchase.store');
Route::get('/purchaseall', 'Purchase\PurchaseController@allview')->name('purchase.all');
Route::get('/purchaseallpage/{id}', 'Purchase\PurchaseController@Purchaseallpage')->name('Purchaseallpage');
Route::get('/purchaseupdate/{id}/product/{productid}', 'Purchase\PurchaseController@Purchaseupdate')->name('Purchaseupdate');
Route::post('/purchasesupdatestore/{id}/product/{productid}', 'Purchase\PurchaseController@Purchaseupdatestore')->name('Purchaseupdate.store');
Route::get('/purchasereturn', 'Purchase\PurchaseController@return')->name('purchase.return');
Route::delete('/purchasedeletestore/{id}', 'Purchase\PurchaseController@Purchasedelete')->name('Purchaseupdate.delete');

// Customer
Route::get('/customer', 'Customer\CustomerController@index')->name('customer');
Route::get('/customerview', 'Customer\CustomerController@view')->name('customer.view');
Route::Post('/customers', 'Customer\CustomerController@store')->name('customer.store');
Route::get('/customersupdatepage/{id}', 'Customer\CustomerController@customerupdatepage')->name('customerupdatepage');
Route::post('/customerupdatestore/{id}', 'Customer\CustomerController@customerupdatestore')->name('customerupdate.store');
Route::delete('/customerdeletestore/{id}', 'Customer\CustomerController@customerdelete')->name('customerupdate.delete');

// Sales
Route::get('/sales', 'Sale\SalesController@index')->name('sales');
Route::get('/salesadd/{id}', 'Sale\SalesController@view')->name('sales.view');
Route::Post('/salesadd', 'Sale\SalesController@store')->name('sales.store');
Route::get('/salesall', 'Sale\SalesController@allview')->name('sales.all');
Route::get('/salesallpage/{id}', 'Sale\SalesController@salesallpage')->name('salesallpage');
Route::get('/salesupdate/{id}/product/{productid}', 'Sale\SalesController@salesupdate')->name('salesupdate');
Route::post('/salesupdatestore/{id}/product/{productid}', 'Sale\SalesController@salesupdatestore')->name('salesupdate.store');
Route::get('/salesreturn', 'Sale\SalesController@return')->name('sales.return');
Route::delete('/salesdeletestore/{id}', 'Sale\SalesController@salesdelete')->name('salesupdate.delete');
//Ajax
Route::post('/productgetpriceupdate', 'Sale\SalesController@getPrice');
Route::post('/productgetpricolorupdate', 'Sale\SalesController@getcolorPrice');
Route::post('/salecolorsize', 'Sale\SalesController@salecolorsize');
Route::post('/productpricecalculate', 'Sale\SalesController@productcalculate');
Route::post('/getcolorlist/colorid/{id}', 'Sale\SalesController@coloredit');
//End Ajax

// Purchase Report

Route::get('/purchasereoprt', 'Report\ReportController@purchaseindex')->name('purchasereport');
Route::Post('/purchasereoprt', 'Report\ReportController@purchsestore')->name('purchasereoprt.store');
Route::get('/purchasereturnreoprt', 'Report\ReportController@purchsereturn')->name('purchasereturnreoprt');
Route::Post('/purchasereturnreoprt', 'Report\ReportController@purchsereturnstore')->name('purchasereturnreoprt.store');
Route::get('/purchaspaid', 'Report\ReportController@purchasepaid')->name('purchasepaid');
Route::Post('/purchasereoprt', 'Report\ReportController@purchsestore')->name('purchasereoprt.store');

// Sale Report

Route::get('/salesreoprt', 'Report\ReportController@salesindex')->name('salesreoprt');
Route::Post('/salesreoprt', 'Report\ReportController@salesstore')->name('salesreoprt.store');
Route::get('/salesreturnreoprt', 'Report\ReportController@salesreturn')->name('salesreturnreoprt');
Route::Post('/salesreturnreoprt', 'Report\ReportController@salesreturnstore')->name('salesreturnreoprt.store');


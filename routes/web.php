<?php

use App\Http\Controllers\AccountingController;
use App\Http\Controllers\ArchieveController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ChurchBranchController;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\ChurchRoleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\ConvertController;
use App\Http\Controllers\CreditsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquityController;
use App\Http\Controllers\EvangelismController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinanceTransactionsController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\FoundationSchoolController;
use App\Http\Controllers\FoundationModuleController;
use App\Http\Controllers\FoundationSchoolModuleController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\LiabilityController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PastorController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RevenueContrller;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'displayDashboard'])->name('dashboard');

    Route::middleware('role:1,2')->group(function () {
        //Church Routes
        Route::get('/church', [ChurchController::class, 'churchIndex'])->name('church.index');
        Route::post('/church', [ChurchController::class, 'churchStore'])->name('church.store');
        Route::get('/church/{churchId}/details', [ChurchController::class, 'getDetails']);
        Route::put('/church',[ChurchController::class, 'churchUpdate'] )->name('church.update');
        Route::get('/church/images', [ChurchController::class, 'uploadForm'])->name('image.form');
        Route::post('/upload-logo', [ChurchController::class, 'uploadLogo'])->name('upload.logo');

        //Branch
        Route::get('/church_branches', [ChurchBranchController::class, 'index'])->name('branch.index');
        Route::get('/church_branch', [ChurchBranchController::class, 'create'])->name('branch.create');
        Route::post('/church_branch', [ChurchBranchController::class, 'store'])->name('branch.store');
        Route::get('/church_branch/{id}', [ChurchBranchController::class, 'getDetails']);
        Route::put('/church_branch',[ChurchBranchController::class, 'update'] )->name('branch.update');
        Route::delete('/church_branch',[ChurchBranchController::class, 'delete'] )->name('branch.delete');
    });

    Route::middleware('role:1,2,3,4')->group(function () {
        //GROUPS
        Route::get('/group', [GroupController::class, 'index'])->name('group.index');
        Route::post('/group', [GroupController::class, 'create'])->name('group.create');
        Route::get('/group/{id}', [GroupController::class, 'details']);
        Route::put('/group', [GroupController::class, 'update'])->name('group.update');
        Route::delete('/group',[GroupController::class, 'delete'] )->name('group.delete');
        Route::get('/group-export', [GroupController::class, 'export'])->name('group.export');

        Route::get('/group_members/{id}', [GroupMemberController::class, 'members'])->name('group.members.list');
        Route::post('/group/add_member', [GroupMemberController::class, 'add_member'])->name('group.member');
        Route::post('/group/remove_member', [GroupMemberController::class, 'remove_member'])->name('group.member.remove');

        Route::post('/group/add_leader', [GroupMemberController::class, 'add_leader'])->name('group.leader');
        Route::post('/group/revoke_leader', [GroupMemberController::class, 'revoke_leader'])->name('group.leader.revoke');
        // Route::get('/group/leader/{id}', [GroupMemberController::class, 'details']);
        Route::put('/group/update_leader', [GroupMemberController::class, 'update_leader'])->name('group.leader.update');

        //FAMILY
        Route::get('/families', [FamilyController::class, 'index'])->name('family.index');
        Route::post('/family', [FamilyController::class, 'create'])->name('family.create');
        Route::get('/family/{id}', [FamilyController::class, 'details']);
        Route::put('/family', [FamilyController::class, 'update'])->name('family.update');
        Route::delete('/family',[FamilyController::class, 'delete'] )->name('family.delete');

        Route::get('/familylist/{id}', [FamilyController::class, 'familyList'])->name('family.list');

        Route::get('/family_members/{id}', [FamilyController::class, 'members'])->name('family.members.list');
        Route::post('/family/add_member', [FamilyController::class, 'add_member'])->name('family.member');
        Route::post('/family/remove_member', [FamilyController::class, 'remove_member'])->name('family.member.remove');

        Route::post('/family/add_leader', [FamilyController::class, 'add_leader'])->name('family.leader');
        Route::post('/family/revoke_leader', [FamilyController::class, 'revoke_leader'])->name('family.leader.revoke');
        // Route::get('/family/leader/{id}', [GroupMemberController::class, 'details']);
        Route::put('/family/update_leader', [FamilyController::class, 'update_leader'])->name('family.leader.update');

        //MEMBERS
        Route::get('/members', [MemberController::class, 'index'])->name('member.index');
        Route::post('/member', [MemberController::class, 'create'])->name('member.create');
        Route::get('/members/{id}', [MemberController::class, 'details']);
        Route::put('/member', [MemberController::class, 'update'])->name('member.update');
        Route::delete('/member',[MemberController::class, 'delete'] )->name('member.delete');
        Route::get('/members-export', [MemberController::class, 'export'])->name('member.export');
        Route::post('/member/details', [MemberController::class, 'searchMember'])->name('member.search');

        Route::post('/member_image_upload', [ImageUploadController::class,'member'])->name('member.image.upload');
        Route::post('/student_image_upload', [ImageUploadController::class,'foundation_school'])->name('foundation.image.upload');
        Route::post('/user_image_upload', [ImageUploadController::class,'user'])->name('user.image.upload');
        Route::post('/church_logo_upload', [ImageUploadController::class,'uploadLogo'])->name('church.logo.upload');


        //PASTOR
        Route::get('/pastors', [PastorController::class, 'index'])->name('pastor.index');
        Route::get('/add_pastor', [PastorController::class, 'addPastor'])->name('pastor.new');
        Route::post('/add_pastor', [PastorController::class, 'storePastor'])->name('pastor.store');
        Route::get('/pastor/{id}', [PastorController::class, 'details']);
        Route::get('/update_pastor/{id}', [PastorController::class, 'edit'])->name('pastor.edit');
        Route::put('/pastor', [PastorController::class, 'update'])->name('pastor.update');
        Route::delete('/pastor',[PastorController::class, 'delete'] )->name('pastor.delete');

        //LEADERS
        Route::get('/leaders', [LeaderController::class, 'index'])->name('leader.index');
        Route::get('/add_leader', [LeaderController::class, 'addLeader'])->name('leader.new');
        Route::post('/add_leader', [LeaderController::class, 'storeLeader'])->name('leader.store');
        Route::get('/leaders/{id}', [LeaderController::class, 'details']);
        Route::get('/update_leader/{id}', [LeaderController::class, 'edit'])->name('leader.edit');
        Route::put('/leader', [LeaderController::class, 'update'])->name('leader.update');
        Route::delete('/leader',[LeaderController::class, 'delete'] )->name('leader.delete');

        Route::get('/group/{groupId}/members', [LeaderController::class, 'fetchGroupMembers']);


        //STAFF
        Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/staff/{id}', [StaffController::class, 'details']);
        Route::put('/staff', [StaffController::class, 'update'])->name('staff.update');
        Route::delete('/staff',[StaffController::class, 'delete'] )->name('staff.delete');



        //Report routes
        Route::get('/reports', [ReportsController::class, 'index'])->name('report.index');
        Route::get('/financial/balance_sheet', [ReportsController::class, 'balanceIndex'])->name('balance_sheet.index');
        Route::post('/financial/balance_sheet', [ReportsController::class, 'balanceSheet'])->name('balance_sheet.generate');
        Route::post('/financial/profit_and_loss', [ReportsController::class, 'profitAndLoss'])->name('profit_loss.generate');
        Route::post('/financial/trial_balance', [ReportsController::class, 'trialBalance'])->name('trial_balanec.generate');
        Route::post('/log', [ReportsController::class, 'Logs'])->name('logs.generate');
        Route::get('/logs', [UserController::class, 'Logs'])->name('logs.index');

        //Archieves Routes
        Route::get('/archives', [ArchiveController::class, 'index'])->name('archive.index');
        Route::get('/archives/employees', [ArchiveController::class, 'Employees'])->name('archive.employees');
        Route::get('/archives/users', [ArchiveController::class, 'Users'])->name('archive.users');


        //System Preferences
        Route::get('/preferences', [PreferencesController::class, 'index'])->name('preference.index');
        Route::get('/preferences/settings', [PreferencesController::class, 'settings'])->name('settings.index');

        Route::put('/setting/general-settings',[PreferencesController::class, 'settingUpdate'] )->name('setting.update');
        Route::post('/update-sms-notification', [PreferencesController::class, 'updateNotification'])->name('update.notification');
        Route::post('/update-bill-notification', [PreferencesController::class, 'sms_notification'])->name('update.sms.notification');
        Route::post('/update-credit-sales', [PreferencesController::class, 'creditSales'])->name('update.creditSales');
        Route::post('/update-use-barcode', [PreferencesController::class, 'useBarcode'])->name('update.useBarcode');

        //User Account Routes
        Route::get('/users', [UserController::class, 'userIndex'])->name('user.index');
        Route::post('/user', [UserController::class, 'userStore'])->name('user.store');
        Route::get('/user/{userId}/details', [UserController::class, 'getDetails']);
        Route::put('/user',[UserController::class, 'userUpdate'] )->name('user.update');
        Route::get('/user/{id}/profile', [UserController::class, 'userProfile'])->name('user.profile');
        Route::post('/upload-profile-image', [UserController::class, 'uploadProfileImg'])->name('upload.profile.image');

        Route::post('/user/block', [UserController::class, 'userAccountBlock'])->name('user.block');
        Route::post('/user/account_restore', [UserController::class, 'userAccountRestore'])->name('user.restore.account');
        Route::delete('/user',[UserController::class, 'userDelete'] )->name('user.delete');

        Route::post('/user/restore',[UserController::class, 'userRestore'] )->name('user.restore');

        //Church role routes
        Route::get('/role', [ChurchRoleController::class, 'roleIndex'])->name('role.index');
        Route::post('/role', [ChurchRoleController::class, 'roleStore'])->name('role.store');
        Route::get('/role/{roleId}/details', [ChurchRoleController::class, 'getDetails']);
        Route::put('/role',[ChurchRoleController::class, 'roleUpdate'] )->name('role.update');
        Route::delete('/role',[ChurchRoleController::class, 'roleDelete'] )->name('role.delete');
        Route::post('/role/restore',[ChurchRoleController::class, 'roleRestore'] )->name('role.restore');

    });

    // Admin specific routes
    Route::middleware('role:2')->group(function () {
        Route::get('/documents', [DocumentController::class, 'index'])->name('document.index');

    });

    //Accountant and Cashier
    Route::middleware('role:2,3,4,5,6')->group(function () {
        //ACCOUNTING
            //Accounting routes
            Route::get('/account', [AccountingController::class, 'accountIndex'])->name('account.index');
            Route::post('/account', [AccountingController::class, 'accountStore'])->name('account.store');
            Route::get('/account/{accountId}/details', [AccountingController::class, 'getDetails']);
            Route::put('/account',[AccountingController::class, 'accountUpdate'] )->name('account.update');
            Route::delete('/account',[AccountingController::class, 'accountDelete'] )->name('account.delete');
            Route::post('/account/restore',[AccountingController::class, 'accountRestore'] )->name('account.restore');

            //Finance Routes
            Route::get('/finance', [FinanceController::class, 'financeIndex'])->name('finance.index');
            Route::get('/finance/entry', [FinanceController::class, 'Entry'])->name('finance.entry');
            Route::post('/finance/record', [FinanceController::class, 'Transactions'])->name('finance.record');

            Route::post('/finance', [FinanceController::class, 'financeStore'])->name('finance.store');
            Route::put('/finance',[FinanceController::class, 'financeUpdate'] )->name('finance.update');
            Route::delete('/finance',[FinanceController::class, 'financeDelete'] )->name('finance.delete');
            Route::get('/finance/{journalID}', [FinanceController::class, 'financeShowDetails'])->name('financeShowDetails');

            Route::get('/transactions', [FinanceTransactionsController::class, 'transactions'])->name('transactions.index');
            Route::get('/transactions', [FinanceTransactionsController::class, 'transactions'])->name('transactions.index');

            //Expenses Routes
            Route::get('/expenses', [ExpenseController::class, 'expenseIndex'])->name('expense.index');
            Route::post('/expense', [ExpenseController::class, 'expenseStore'])->name('expense.store');
            Route::put('/expense', [ExpenseController::class, 'expenseUpdate'])->name('expense.update');
            Route::get('/expense/{id}/details', [ExpenseController::class, 'getDetails']);
            Route::get('/expense/{journalID}', [ExpenseController::class, 'financeShowDetails'])->name('expenseShowDetails');

            //Revnue Routes
            Route::get('/revenue', [RevenueContrller::class, 'revenueIndex'])->name('revenue.index');
            Route::post('/revenue', [RevenueContrller::class, 'revenueStore'])->name('revenue.store');
            Route::put('/revenue', [RevenueContrller::class, 'revenueUpdate'])->name('revenue.update');
            Route::get('/revenue/{id}/details', [RevenueContrller::class, 'getDetails']);
            Route::get('/revenue/{journalID}', [RevenueContrller::class, 'financeShowDetails'])->name('revenueShowDetails');

            //Equity Routes
            Route::get('/equity', [EquityController::class, 'equityIndex'])->name('equity.index');
            Route::post('/equity', [EquityController::class, 'equityStore'])->name('equity.store');
            Route::put('/equity', [EquityController::class, 'equityUpdate'])->name('equity.update');

            //Revnue Routes
            Route::get('/asset', [AssetController::class, 'assetIndex'])->name('asset.index');
            Route::post('/asset', [AssetController::class, 'assetStore'])->name('asset.store');
            Route::put('/asset', [AssetController::class, 'assetUpdate'])->name('asset.update');

            //Liability Routes
            Route::get('/liability', [LiabilityController::class, 'liabilityIndex'])->name('liability.index');
            Route::post('/liability', [LiabilityController::class, 'liabilityStore'])->name('liability.store');
            Route::put('/liability', [LiabilityController::class, 'liabilityUpdate'])->name('liability.update');

    });


    //VISSITORS
    Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');
    Route::get('/visitors/create', [VisitorController::class, 'create'])->name('visitors.create');
    Route::post('/visitors', [VisitorController::class, 'store'])->name('visitors.store');
    Route::get('/visitors/{id}', [VisitorController::class, 'show']);  // Data to json
    Route::post('/visitors/{id}/convert', [VisitorController::class, 'convertToMember'])->name('visitors.convert');
    Route::put('/visitor', [VisitorController::class, 'update'])->name('visitor.update');
    Route::delete('/visitor', [VisitorController::class, 'delete'])->name('visitor.delete');

    // Evangelism Routes
    Route::get('/evangelism', [EvangelismController::class, 'index'])->name('evangelism.index');
    Route::post('/evangelism', [EvangelismController::class, 'store'])->name('evangelism.store');
    Route::get('/evangelism_details/{id}', [EvangelismController::class, 'show']);  // to json
    Route::put('/evangelism', [EvangelismController::class, 'update'])->name('evangelism.update');
    Route::delete('/evangelism', [EvangelismController::class, 'destroy'])->name('evangelism.destroy');
    Route::get('/evangelism/{id}', [EvangelismController::class, 'converts'])->name('evangelism.converts');

    // Converts Routes
    Route::get('/converts', [ConvertController::class, 'index'])->name('converts.index');  // List all converts
    Route::get('/converts/create', [ConvertController::class, 'create'])->name('converts.create');  // Show form to create a new convert
    Route::post('/converts', [ConvertController::class, 'store'])->name('converts.store');  // Store a new convert
    Route::get('/converts/{id}', [ConvertController::class, 'show']);  // View a specific convert
    Route::put('/converts', [ConvertController::class, 'update'])->name('converts.update');  // Update a convert
    Route::put('/converts/status', [ConvertController::class, 'status'])->name('converts.status');  // Update a convert
    Route::delete('/converts', [ConvertController::class, 'destroy'])->name('converts.destroy');  // Delete a convert

    // Foundation School Routes
    Route::get('/foundation-school', [FoundationSchoolController::class, 'index'])->name('foundation-school.index');
    Route::get('/foundation-school/create', [FoundationSchoolController::class, 'create'])->name('foundation-school.create');
    Route::post('/foundation-school', [FoundationSchoolController::class, 'store'])->name('foundation-school.store');
    Route::get('/foundation-school/{id}', [FoundationSchoolController::class, 'show']);
    Route::get('/foundation-student-profile/{student}', [FoundationSchoolController::class, 'profile'])->name('foundation-school.profile');
    Route::delete('/foundation-school', [FoundationSchoolController::class, 'destroy'])->name('foundation-school.destroy');

        Route::get('/foundation-school-modules/{id}', [FoundationSchoolModuleController::class, 'show']);
        Route::put('/foundation-school-modules', [FoundationSchoolModuleController::class, 'update'])->name('foundation-school-modules.update');

        // Foundation Modules Routes
        Route::get('/foundation-modules', [FoundationModuleController::class, 'index'])->name('foundation-modules.index');  // List all foundation school modules
        Route::get('/foundation-modules/create', [FoundationModuleController::class, 'create'])->name('foundation-modules.create');  // Show form
        Route::post('/foundation-modules', [FoundationModuleController::class, 'store'])->name('foundation-modules.store');  // Store a new foundation school module
        Route::get('/foundation-modules/{id}', [FoundationModuleController::class, 'show']);  // View details of a specific module
        Route::put('/foundation-modules', [FoundationModuleController::class, 'update'])->name('foundation-modules.update');  // Update a module
        Route::delete('/foundation-modules', [FoundationModuleController::class, 'destroy'])->name('foundation-modules.destroy');  // Delete a module



    // Converts Routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');  // List all tasks
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');  // Store a new convert
    Route::get('/tasks/{id}', [TaskController::class, 'show']);  // View a specific convert
    Route::get('/task/{task}', [TaskController::class, 'view'])->name('task.view');  // View a specific convert
    Route::put('/tasks', [TaskController::class, 'updateTask'])->name('tasks.update');  // Update a convert
    Route::put('/tasks/status', [TaskController::class, 'status'])->name('tasks.status');  // Update a convert
    Route::delete('/tasks', [TaskController::class, 'destroy'])->name('tasks.destroy');  // Delete a convert
    Route::post('/tasks/{task}/add-assignees', [TaskController::class, 'addAssignees'])->name('tasks.addAssignees');
    Route::post('/tasks/{task}/remove-assignees', [TaskController::class, 'removeAssignees'])->name('tasks.removeAssignees');

        //Task Steps
        Route::post('/steps/{stepId}/update-status', [TaskController::class, 'updateStepStatus']);
        Route::get('/step/{id}', [TaskController::class, 'step']);  // View a specific convert
        Route::put('/step', [TaskController::class, 'updateStep'])->name('step.update');  // Update a convert
        Route::delete('/step', [TaskController::class, 'destroyStep'])->name('step.destroy');  // Delete a convert
        Route::post('/add-step', [TaskController::class, 'addStep'])->name('step.store');  // Store a new convert


        //Task Category

        Route::get('/task_categories', [TaskCategoryController::class, 'index'])->name('task.category.index');  // List all tasks
        Route::post('/task_categories', [TaskCategoryController::class, 'store'])->name('tasks.category.store');  // Store a new convert
        Route::get('/task_categories/{id}', [TaskCategoryController::class, 'show']);  // View a specific convert
        Route::put('/task_categories', [TaskCategoryController::class, 'update'])->name('task.category.update');  // Update a convert
        Route::delete('/task_categories', [TaskCategoryController::class, 'destroy'])->name('task.category.destroy');  // Delete a convert

    // Follow-Up Routes
    Route::get('/follow-ups', [FollowUpController::class, 'index'])->name('follow-ups.index');  // List all follow-ups
    Route::get('/follow-ups/create', [FollowUpController::class, 'create'])->name('follow-ups.create');  // Show form to schedule a new follow-up
    Route::post('/follow-ups', [FollowUpController::class, 'store'])->name('follow-ups.store');  // Store a new follow-up
    Route::get('/follow-ups/{id}', [FollowUpController::class, 'show'])->name('follow-ups.show');  // View a specific follow-up
    Route::get('/follow-ups/{id}/edit', [FollowUpController::class, 'edit'])->name('follow-ups.edit');  // Edit a follow-up
    Route::put('/follow-ups/{id}', [FollowUpController::class, 'update'])->name('follow-ups.update');  // Update a follow-up
    Route::delete('/follow-ups/{id}', [FollowUpController::class, 'destroy'])->name('follow-ups.destroy');  // Delete a follow-up


    //PROJECTS
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::post('/project', [ProjectController::class, 'create'])->name('project.create');
    Route::get('/project/{id}', [ProjectController::class, 'details']);
    Route::put('/project', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('/project',[ProjectController::class, 'delete'] )->name('project.delete');
    Route::get('/project-export', [ProjectController::class, 'export'])->name('project.export');

    //FACILITY
    Route::get('/facility', [FacilityController::class, 'index'])->name('facility.index');
    Route::post('/facility', [FacilityController::class, 'create'])->name('facility.create');
    Route::get('/facility/{id}', [FacilityController::class, 'details']);
    Route::put('/facility', [FacilityController::class, 'update'])->name('facility.update');
    Route::delete('/facility',[FacilityController::class, 'delete'] )->name('facility.delete');
    Route::get('/facility-export', [FacilityController::class, 'export'])->name('facility.export');

    //EQUIPMENT
    Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
    Route::post('/equipment', [EquipmentController::class, 'create'])->name('equipment.create');
    Route::get('/equipment/{id}', [EquipmentController::class, 'details']);
    Route::put('/equipment', [EquipmentController::class, 'update'])->name('equipment.update');
    Route::delete('/equipment',[EquipmentController::class, 'delete'] )->name('equipment.delete');
    Route::get('/equipment-export', [EquipmentController::class, 'export'])->name('equipment.export');

    //EVENT
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    Route::post('/event', [EventController::class, 'create'])->name('event.create');
    Route::get('/event/{id}', [EventController::class, 'details']);
    Route::put('/event', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event',[EventController::class, 'delete'] )->name('event.delete');
    Route::get('/event-export', [EventController::class, 'export'])->name('event.export');

    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

    //ATTENDANCE
    Route::middleware('role:1,2,3')->group(function () {

        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
        Route::get('/attendance/{id}', [AttendanceController::class, 'details']);
        Route::put('/attendance', [AttendanceController::class, 'update'])->name('attendance.update');
    });

    Route::post('/church_service', [AttendanceController::class, 'storeService'])->name('church_service.store');
    Route::get('/church_service/{id}', [AttendanceController::class, 'service_details']);
    Route::put('/church_service', [AttendanceController::class, 'service_update'])->name('service.update');
    Route::delete('/church_service',[AttendanceController::class, 'service_delete'] )->name('service.delete');

    //Legal Routes
    Route::get('privacy_policy', [LegalController::class, 'privacy_policy'])->name('privacy_policy');
    Route::get('terms_of_use', [LegalController::class, 'terms_of_use'])->name('terms_of_use');
    Route::get('refund_policy', [LegalController::class, 'refund_policy'])->name('refund_policy');

    // SMS Messaging
    Route::get('/messaging', [CommunicationController::class, 'index'])->name('sms.index');
    Route::post('/sms/send', [CommunicationController::class, 'sendSingle'])->name('sms.sendSingle');
    Route::post('/sms/send-bulk', [CommunicationController::class, 'sendBulk'])->name('sms.sendBulk');
    Route::get('/sms/{sentId}/details', [CommunicationController::class, 'getSentDetails']);
    Route::delete('/sms',[CommunicationController::class, 'delete'] )->name('sms.delete');

    //SMS Credit purchas
    Route::post('/sms/credit', [CreditsController::class, 'purchaseCredits'])->name('purchase.credits');
    Route::post('/sms_credits/confirmattion', [CreditsController::class, 'confirmation'])->name('sms.credits.confirm');
    Route::post('/sms/update_senderID', [CreditsController::class, 'updateSenderID'])->name('sms.senderID');


    //SYSTEM ADMIN
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::post('/client', [ClientController::class, 'clientStore'])->name('client.store');
    Route::get('/client/{clientId}/details', [ClientController::class, 'getDetails']);
    Route::put('/client',[ClientController::class, 'clientUpdate'] )->name('client.update');

});




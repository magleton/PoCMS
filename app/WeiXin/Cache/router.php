<?php
use Polymer\Boot\Application;
use Slim\App;
$app = Application::getInstance()->get(App::class);
$app->add(Application::getInstance()->get('corsMiddleware'));

$app->add(Application::getInstance()->get("Polymer\Middleware\GXParseRequestJSONMiddleware"));
$app->POST('/admin/login', APP_NAME . '\\Controller\\Backend\\AdminController:login')->setName('admin.login');
$app->GET('/admin/info', APP_NAME . '\\Controller\\Backend\\AdminController:getAdminInfo')->setName('admin.info');

$app->POST('/agency/save', APP_NAME . '\\Controller\\Backend\\AgencyController:save')->setName('admin.agency.save');
$app->POST('/agency/update', APP_NAME . '\\Controller\\Backend\\AgencyController:update')->setName('admin.agency.update');
$app->POST('/agency/list', APP_NAME . '\\Controller\\Backend\\AgencyController:list')->setName('admin.agency.list');
$app->POST('/agency/detail/{id}', APP_NAME . '\\Controller\\Backend\\AgencyController:detail')->setName('admin.agency.detail');

$app->POST('/appointment/save', APP_NAME . '\\Controller\\Backend\\AppointmentController:save')->setName('admin.appointment.save');
$app->POST('/appointment/update', APP_NAME . '\\Controller\\Backend\\AppointmentController:update')->setName('admin.appointment.update');
$app->POST('/appointment/list', APP_NAME . '\\Controller\\Backend\\AppointmentController:list')->setName('admin.appointment.list');
$app->POST('/appointment/detail/{id}', APP_NAME . '\\Controller\\Backend\\AppointmentController:detail')->setName('admin.appointment.detail');

$app->POST('/banner/save', APP_NAME . '\\Controller\\Backend\\BannerController:save')->setName('admin.banner.save');
$app->POST('/banner/update', APP_NAME . '\\Controller\\Backend\\BannerController:update')->setName('admin.banner.update');
$app->POST('/banner/list', APP_NAME . '\\Controller\\Backend\\BannerController:list')->setName('admin.banner.list');
$app->POST('/banner/detail/{id}', APP_NAME . '\\Controller\\Backend\\BannerController:detail')->setName('admin.banner.detail');

$app->POST('/category/save', APP_NAME . '\\Controller\\Backend\\CategoryController:save')->setName('admin.category.save');
$app->POST('/category/update', APP_NAME . '\\Controller\\Backend\\CategoryController:update')->setName('admin.category.update');
$app->POST('/category/list', APP_NAME . '\\Controller\\Backend\\CategoryController:list')->setName('admin.category.list');
$app->POST('/category/detail/{id}', APP_NAME . '\\Controller\\Backend\\CategoryController:detail')->setName('admin.category.detail');

$app->GET('/', APP_NAME . '\\Controller\\Home:index')->setName('wechat.home.root.index');
$app->map(['GET', 'POST'], '/home/add-user', APP_NAME . '\\Controller\\Home:addUser')->setName('wechat.home.add.user');
$app->map(['GET', 'POST'], '/home/send', APP_NAME . '\\Controller\\Home:send')->setName('wechat.home.send');
$app->map(['GET', 'POST'], '/oauth/oAuthWebsite', APP_NAME . '\\Controller\\OAuth:oAuthWebsite')->setName('wechat.OAuth.oAuthWebsite');
$app->map(['GET', 'POST'], '/oauth/dealOAuthWebsite', APP_NAME . '\\Controller\\OAuth:dealOAuthWebsite')->setName('wechat.OAuth.dealOAuthWebsite');

$app->POST('/news/save', APP_NAME . '\\Controller\\Backend\\NewsController:save')->setName('admin.news.save');
$app->POST('/news/update', APP_NAME . '\\Controller\\Backend\\NewsController:update')->setName('admin.news.update');
$app->POST('/news/list', APP_NAME . '\\Controller\\Backend\\NewsController:list')->setName('admin.news.list');
$app->GET('/news/detail/{id}', APP_NAME . '\\Controller\\Backend\\NewsController:detail')->setName('admin.news.detail');

$app->POST('/order/save', APP_NAME . '\\Controller\\Backend\\OrderController:save')->setName('admin.order.save');
$app->POST('/order/update', APP_NAME . '\\Controller\\Backend\\OrderController:update')->setName('admin.order.update');
$app->POST('/order/list', APP_NAME . '\\Controller\\Backend\\OrderController:list')->setName('admin.order.list');
$app->POST('/order/detail/{id}', APP_NAME . '\\Controller\\Backend\\OrderController:detail')->setName('admin.order.detail');

$app->POST('/scenic-area/save', APP_NAME . '\\Controller\\Backend\\ScenicAreaController:save')->setName('admin.scenic.area.save');
$app->POST('/scenic-area/update', APP_NAME . '\\Controller\\Backend\\ScenicAreaController:update')->setName('admin.scenic.area.update');
$app->POST('/scenic-area/list', APP_NAME . '\\Controller\\Backend\\ScenicAreaController:list')->setName('admin.scenic.area.list');
$app->POST('/scenic-area/detail/{id}', APP_NAME . '\\Controller\\Backend\\ScenicAreaController:detail')->setName('admin.scenic.area.detail');

$app->POST('/scenic-spot-plan/save', APP_NAME . '\\Controller\\Backend\\ScenicSpotPlanController:save')->setName('admin.scenic.spot.plan.save');
$app->POST('/scenic-spot-plan/update', APP_NAME . '\\Controller\\Backend\\ScenicSpotPlanController:update')->setName('admin.scenic.spot.plan.update');
$app->POST('/scenic-spot-plan/list', APP_NAME . '\\Controller\\Backend\\ScenicSpotPlanController:list')->setName('admin.scenic.spot.plan.list');
$app->POST('/scenic-spot-plan/detail/{id}', APP_NAME . '\\Controller\\Backend\\ScenicSpotPlanController:detail')->setName('admin.scenic.spot.plan.detail');

$app->POST('/sign-up/save', APP_NAME . '\\Controller\\Backend\\SignUpController:save')->setName('admin.sign.up.save');
$app->POST('/sign-up/update', APP_NAME . '\\Controller\\Backend\\SignUpController:update')->setName('admin.sign.up.update');
$app->POST('/sign-up/list', APP_NAME . '\\Controller\\Backend\\SignUpController:list')->setName('admin.sign.up.list');
$app->POST('/sign-up/detail/{id}', APP_NAME . '\\Controller\\Backend\\SignUpController:detail')->setName('admin.sign.up.detail');

$app->POST('/admin/upload', APP_NAME . '\\Controller\\Backend\\UploadController:uploadFile')->setName('admin.upload.file');
$app->post('/user/login', APP_NAME . '\\Controller\\Frontend\\UserController:login')->setName('user.login');

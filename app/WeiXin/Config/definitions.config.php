<?php

use WeiXin\Services\AdminService;
use WeiXin\Services\AgencyService;
use WeiXin\Services\AppointmentService;
use WeiXin\Services\BannerService;
use WeiXin\Services\CategoryService;
use WeiXin\Services\HelloService;
use WeiXin\Services\LogService;
use WeiXin\Services\NewsService;
use WeiXin\Services\OrdersService;
use WeiXin\Services\ResourceManagerService;
use WeiXin\Services\ScenicAreaService;
use WeiXin\Services\ScenicSpotPlanService;
use WeiXin\Services\TestService;
use WeiXin\Services\UserService;

return [
    'testService' => DI\create(TestService::class),
    'helloService' => DI\create(HelloService::class),
    'adminService' => DI\create(AdminService::class),
    'userService' => DI\create(UserService::class),
    'bannerService' => DI\create(BannerService::class),
    'appointmentService' => DI\create(AppointmentService::class),
    'orderService' => DI\create(OrdersService::class),
    'categoryService' => DI\create(CategoryService::class),
    'newsService' => DI\create(NewsService::class),
    'scenicAreaService' => DI\create(ScenicAreaService::class),
    'agencyService' => DI\create(AgencyService::class),
    'resourceManagerService' => DI\create(ResourceManagerService::class),
    'scenicSpotPlanService' => DI\create(ScenicSpotPlanService::class),
    'logService' => DI\create(LogService::class),
];
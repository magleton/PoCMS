<?php

use WeiXin\Services\AdminService;
use WeiXin\Services\AgencyService;
use WeiXin\Services\AppointmentService;
use WeiXin\Services\BannerService;
use WeiXin\Services\CategoryService;
use WeiXin\Services\HelloService;
use WeiXin\Services\Impl\AgencyServiceImpl;
use WeiXin\Services\Impl\AppointmentServiceImpl;
use WeiXin\Services\Impl\LogServiceImpl;
use WeiXin\Services\Impl\NewsServiceImpl;
use WeiXin\Services\Impl\ResourceManagerServiceImpl;
use WeiXin\Services\Impl\ScenicAreaServiceImpl;
use WeiXin\Services\Impl\ScenicSpotPlanServiceImpl;
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
    AppointmentService::class => DI\create(AppointmentServiceImpl::class),
    'orderService' => DI\create(OrdersService::class),
    'categoryService' => DI\create(CategoryService::class),
    'newsService' => DI\create(NewsService::class),
    ScenicAreaService::class => DI\create(ScenicAreaServiceImpl::class),
    AgencyService::class => DI\create(AgencyServiceImpl::class),
    ResourceManagerService::class => DI\create(ResourceManagerServiceImpl::class),
    ScenicSpotPlanService::class => DI\create(ScenicSpotPlanServiceImpl::class),
    LogService::class => DI\create(LogServiceImpl::class),
];
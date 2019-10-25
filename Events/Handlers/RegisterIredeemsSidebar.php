<?php

namespace Modules\Iredeems\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIredeemsSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('iredeems::common.title.iredeems'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                    $this->auth->hasAccess('iredeems.items.index') || $this->auth->hasAccess('iredeems.redeems.index')
                );
                $item->item(trans('iredeems::items.title.items'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iredeems.item.create');
                    $item->route('admin.iredeems.item.index');
                    $item->authorize(
                        $this->auth->hasAccess('iredeems.items.index')
                    );
                });
                $item->item(trans('iredeems::redeems.title.redeems'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iredeems.redeem.create');
                    $item->route('admin.iredeems.redeem.index');
                    $item->authorize(
                        $this->auth->hasAccess('iredeems.redeems.index')
                    );
                });
                $item->item(trans('iredeems::pointhistories.title.pointhistories'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->route('admin.iredeems.pointhistory.index');
                    $item->authorize(
                        $this->auth->hasAccess('iredeems.pointhistories.index')
                    );
                });
                $item->item(trans('iredeems::pointhistories.title.pointhistories'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->route('admin.iredeems.pointhistory.index');
                    $item->authorize(
                        $this->auth->hasAccess('iredeems.pointhistories.index')
                    );
                });
                $item->item(trans('iredeems::points.title.points'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iredeems.point.create');
                    $item->route('admin.iredeems.point.index');
                    $item->authorize(
                        $this->auth->hasAccess('iredeems.points.index')
                    );
                });
// append





            });
        });

        return $menu;
    }
}

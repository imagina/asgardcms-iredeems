<?php


namespace Modules\Iredeems\Events\Handlers;

use Modules\Iredeems\Events\RedeemWasCreated;
use Modules\Iredeems\Entities\PointHistory;
use Modules\Iredeems\Entities\Item;
class StoreUsedPoints
{
    /**
     * @var Setting
     */

    public function __construct()
    {

    }

    /**
     * @param RedeemWasCreated $event
     */
    public function handle(RedeemWasCreated $event)
    {
        $data=$event->data;
        try {
          // PointHistory::create([
          //   'entity_id'=>$data['item_id'],
          //   'user_id'=>$data['user_id'],
          //   'entity'=>Item::class,
          //   'quantity'=>1,
          //   'type'=>false,//Entrada - Entry
          //   'points'=>$data['used_points']
          // ]);
        } catch (\Exception $e) {
          \Log::error('Handle Store Used Points method handle: '+$e->getMessage());
        }
    }//handle()

}

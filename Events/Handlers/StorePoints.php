<?php


namespace Modules\Iredeems\Events\Handlers;

use Modules\Iredeems\Events\OrderWasCreated;
use Modules\Iredeems\Entities\PointHistory;
use Modules\Icommerce\Entities\Product;
class StorePoints
{
    /**
     * @var Setting
     */

    public function __construct()
    {

    }

    /**
     * @param OrderWasCreated $event
     */
    public function handle(OrderWasCreated $event)
    {
        $data=$event->data;
        try {
          /*
            Comentado el 18 de julio 2019 por solicitud del dueño del sitio,
            que no se entregaran los puntos por producto hasta que la orden no
            cambiara a un estado de procesada.
          */
          // foreach($data['items'] as $item){
          //   $product=Product::find($item['product_id']);
          //   if($product->points>0){
          //     iredeems_StorePointUser([
          //       "user_id"=>$data['user_id'],
          //       "pointable_id"=>$item['product_id'],
          //       "pointable_type"=>"Product",
          //       "description"=>$item['quantity']." ".$product->name,
          //       "points"=>(int)$product->points
          //     ]);
          //   }//product -> points > 0
          // }//foreach items
        } catch (\Exception $e) {
          \Log::error('Handle Store points method handle: '+$e->getMessage());
        }
    }//handle()

}

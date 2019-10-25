<?php
use Modules\Iredeems\Entities\PointHistory;
use Modules\Iredeems\Entities\Redeem;
use Modules\Iredeems\Entities\Point;
if(!function_exists('iredeems_availablePointsOfUser')){
  function iredeems_availablePointsOfUser($user_id=null){
    $availablePoints=0;
    if($user_id){
      $entry=Point::where('user_id',$user_id)->sum('points');
      $out=Redeem::where('user_id',$user_id)->sum('points');
      $availablePoints=(int)$entry-(int)$out;
    }
    return (int)$availablePoints;
  }//iredeems_availablePointsOfUser()
}

if(!function_exists('iredeems_PointsHistoryOfUser')){
  function iredeems_PointsHistoryOfUser($user_id=null){
    $pointsHistory=null;
    if($user_id){
      $entry=Point::with('item','product')->where('user_id',$user_id)->get();
      $out=Redeem::where('user_id',$user_id)->get();
      if(count($entry)>0 || count($out)>0){
        $pointsHistory=(object)[
          "entry"=>$entry,
          "out"=>$out
        ];
      }//if(count($entry)>0 || count($out)>0){
    }//if($user_id){
    return $pointsHistory;
  }//iredeems_availablePointsOfUser()
}

if(!function_exists('iredeems_StorePointUser')){
  function iredeems_StorePointUser($data=null){
    /*
      Structure to receive
      $store=[
        'user_id'=>1,
        'pointable_id'=>0,
        'pointable_type'=>'user',
        'description'=>"----",
        'points'=>20
      ];
    */
    try {
      if($data && is_array($data)){
        $data=(object)$data;
        if(isset($data->user_id) && isset($data->pointable_id)
        && isset($data->pointable_type) && isset($data->points)){
          $class=null;
          if(strtolower($data->pointable_type)=="user"){
            $class=\Modules\User\Entities\Sentinel\User::class;
          }else if(strtolower($data->pointable_type)=="product"){
            $class=\Modules\Icommerce\Entities\Product::class;
          }else{
            $class="---";
          }
          // else
            // throw new \Exception("Validate the entity sent because it is not in the validations of the method",500);
          Point::create([
            "user_id"=>$data->user_id,
            "pointable_id"=>is_integer($data->pointable_id) ? $data->pointable_id : 0,
            "pointable_type"=>$class,
            "points"=>$data->points,
            "description"=>isset($data->description) ? $data->description : '',
          ]);
          return true;
        }//exist all data in object
        else
          throw new \Exception("Validate send all data to save points",500);
      }//is_Array data
      else
        throw new \Exception("Validate send array data to save points",500);
    } catch (\Exception $e) {
      \Log::error("Ihelpers iredeems_StorePointUser ".$e->getMessage());
      return false;
    }

  }//iredeems_availablePointsOfUser()
}
if(!function_exists('iredeems_RedemptionOfUserPoints')){
  function iredeems_RedemptionOfUserPoints($data=null){
    /*
      Structure to receive
      $store=[
        'user_id'=>1,
        'description'=>"Puntos por registro de usuario",
        'points'=>20
      ];
    */
    try {
      if($data && is_array($data)){
        $data=(object)$data;
        if(isset($data->user_id) && isset($data->description) && isset($data->points)){
          Redeem::create([
            "user_id"=>$data->user_id,
            "description"=>$data->description,
            "points"=>$data->points
          ]);
          return true;
        }//exist all data in object
        else
          throw new \Exception("Validate send all data to save used points",500);
      }//is_Array data
      else
        throw new \Exception("Validate send array data to save used points",500);
    } catch (\Exception $e) {
      \Log::error("Ihelpers iredeems_StorePointUser ".$e->getMessage());
      return false;
    }

  }//iredeems_availablePointsOfUser()
}

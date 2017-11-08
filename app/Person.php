<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

  public function memberships()
     {
         return $this->hasMany('App\Membership');
     }

  public function portraits()
    {
        return $this->hasMany('App\Photograph');
    }

  public function questionnaire_answers()
    {
        return $this->hasMany('App\QuestionnaireAnswer');
    }

  public function ismember()
    {

    $paid_member = $this->memberships()->where('season_id', '>', '48')->first() ? true : false;
    $life_member = $this['is_life_member'] == 1;
    $member = $paid_member || $life_member;
    return $member ;
    }

  public function main_portrait ()
  {
    $portrait = $this->portraits()->orderBy('created_at', 'desc')->first()['file_name'];
    return $portrait;
  }


  protected $appends = array('portrait');

  public function getPortraitAttribute()

   {
     return $this->main_portrait();
   }



}

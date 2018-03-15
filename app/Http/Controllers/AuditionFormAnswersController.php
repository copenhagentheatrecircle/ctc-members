<?php

namespace App\Http\Controllers;

use App\AuditionFormAnswer;
use App\Person;
use Illuminate\Http\Request;

class AuditionFormAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AuditionFormAnswer  $auditionFormAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(AuditionFormAnswer $auditionFormAnswer)
    {

      $person_id = $auditionFormAnswer->person_id;
      $initial = Person::with('questionnaire_answers')->find($person_id);


      $reformed = array();
      $reformed['id']=$initial->id;
      $reformed['first_name']=$initial->first_name;
      $reformed['last_name']=$initial->last_name;
      $reformed['biography']=$initial->member_bio;
      if(!empty($initial->portrait)){
        $reformed['portrait']=$initial->portrait;
      } else {
        $reformed['portrait']='unisex_silhouette.png';
      }

      foreach ($initial->questionnaire_answers as $answer) {

        if (!empty($answer->functiongroup_id)) {

          //sort order field = key, to ensure correct order
          $sort_id = $answer->functiongroups->sort_order;
          $reformed['general_interests'][$sort_id]['name'] = $answer->functiongroups->questionnaire_name;
          $reformed['general_interests'][$sort_id]['color_hex'] = $answer->functiongroups->color_hex;

        }

        elseif (!empty($answer->function_id) && !empty($answer->has_experience) && $answer->interest==1) {

          //sort order field = key, to ensure correct order
          $sort_id = $answer->functions->functiongroups->sort_order . "_" . $answer->functions->sort_order;
          $reformed['experience'][$sort_id]['name'] = $answer->functions->questionnaire_name;
          $reformed['experience'][$sort_id]['color_hex'] = $answer->functions->functiongroups->color_hex;

        }

        elseif (!empty($answer->function_id) && !empty($answer->wants_to_learn) && $answer->interest==1) {

          //sort order field = key, to ensure correct order
          $sort_id = $answer->functions->functiongroups->sort_order . "_" . $answer->functions->sort_order;
          $reformed['wants_to_learn'][$sort_id]['name'] = $answer->functions->questionnaire_name;
          $reformed['wants_to_learn'][$sort_id]['color_hex'] = $answer->functions->functiongroups->color_hex;

        }

      }

      //remove keys here
      if (!empty($reformed['general_interests'])) {
        $reformed['general_interests']=array_values($reformed['general_interests']);
      }

      if (!empty($reformed['wants_to_learn'])){
        $reformed['wants_to_learn']=array_values($reformed['wants_to_learn']);
      }

      if (!empty($reformed['experience'])){
        $reformed['experience']=array_values($reformed['experience']);
      }

      $person = $reformed;

      return view ('auditionformanswers.show',compact('auditionFormAnswer', 'person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AuditionFormAnswer  $auditionFormAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditionFormAnswer $auditionFormAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuditionFormAnswer  $auditionFormAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditionFormAnswer $auditionFormAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AuditionFormAnswer  $auditionFormAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditionFormAnswer $auditionFormAnswer)
    {
        //
    }
}

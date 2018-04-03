<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class TicketsalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $events = Event::where('project_id', $id)->orderBy('date')->orderBy('time')->get();
      foreach ($events as $event) {
        $subarray['id']=$event['id'];
        $subarray['date']=$event['date'];
        $subarray['time']=$event['time'];
        $seccode=$event['place2book_seccode'];
        $orders = place2bookShowStats ($seccode);
        $orders_array = json_decode($orders, TRUE);
        $orders_array = $orders_array['event']['tickets']['ticket'];

        //initialise ticket amounts
        $subarray['sold'] = 0;
        $subarray['available'] = (int)$orders_array[0]['available'];
        $subarray['standard'] = 0;
        $subarray['child'] = 0;
        $subarray['group_10_to_19'] = 0;
        $subarray['group_20_or_more'] = 0;
        $subarray['membership_adult'] = 0;
        $subarray['membership_child'] = 0;
        $subarray['comp'] = 0;
        //map each ticket type and add to sum
        foreach ($orders_array as $orders_detail) {

          $tickettype = $orders_detail['name'];
          $sold = $orders_detail['sold'];
          $subarray['sold'] += $sold;

          switch ($tickettype) {
            //standard tickets
            case 'Standard (reserved)';
            case 'Standard';
              $tickettype = "standard";
              break;
            //child tickets
            case 'Child (reserved)';
            case 'Child';
              $tickettype = "child";
              break;
            //group 10-19
            case 'Group 10-19 adults';
            case 'Group 10-19 (reserved)';
              $tickettype = "group_10_to_19";
              break;
            //group 20+
            case 'Group 20+';
            case 'Group 20+ (reserved)';
            case 'Extra group tickets (over 20)';
              $tickettype = "group_20_or_more";
              break;
            //membership
            case 'Membership Ticket';
              $tickettype = "membership_adult";
              break;
            //membership child
            case 'Membership Ticket (child)';
            case 'Membership ticket (child)';
              $tickettype = "membership_child";
              break;
            //membership child
            case 'Complimentary';
              $tickettype = "comp";
              break;
            //default: list ticket type
            default;
              $tickettype = $tickettype;
              break;
          }

          $subarray[$tickettype] = $subarray[$tickettype] ?? 0;
          $subarray[$tickettype] += $sold;

        }

        $array[]=$subarray;
      }
      $output = $array;
      return view ('ticketsales.show', Compact('output'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

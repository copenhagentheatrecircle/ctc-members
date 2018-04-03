<?php

namespace App\Http\Controllers;

use App\Event;
use App\Project;
use Illuminate\Http\Request;

class EventController extends Controller
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
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        // return $event;
        $project = Project::where('id', $event['project_id'])->first();
        // return $project;
        $seccode = $event['place2book_seccode'];
        $output['project']=$project['name'];
        $output['project_id']=$project['id'];
        $output['date']=date ('d M Y', strtotime ($event['date']));
        $output['time']=date ('H:i', strtotime ($event['time']));
        // return $seccode;
        $place2bookData = place2bookShowOrders ($seccode);
        $place2bookData = json_decode($place2bookData, TRUE);
        // return $place2bookData;
        $orders = $place2bookData['event']['purchases']['purchase'];
        // return $orders;
        foreach ($orders as $order) {
          $subarray['name']=$order['customer']['name'];
          $subarray['created_at']= date ('d M Y', strtotime ($order['created_at']));
          $pr = $order['custom_fields']['custom_field'][1]['value'];
          if (!is_array($pr)){
            $subarray['pr']=$pr;
          } else {
            $subarray['pr']="n/a";
          }
          // $subarray['pr']=$order['custom_fields']['custom_field'][1]['value'];
          $tickets = $order['tickets']['ticket'];
          //tickets output standardised into array
          $ticketarray = array();
          $ticket_count = 0;
          $ticket_amount = 0;
          if (isset($tickets['id'])){
            $ticketarray[0]=$tickets;
          } else {
            foreach ($tickets as $ticket) {
              $ticketarray[]=$ticket;
            }
          }
          // data extracted as needed
          foreach ($ticketarray as $ticket) {
            if ($ticket['credited']=="false") {
              $ticket_subarray['type'] = $ticket['type'];
              $ticket_subarray['price'] = $ticket['price'];
              $ticket_subarray['credited'] = $ticket['credited'];
              $ticket_amount += $ticket['price'];
              $ticket_count += 1;
            }
          }

          $subarray['tickets_sold']= $ticket_count;
          $subarray['sum']= $ticket_amount/100;

          if ($ticket_count>0) {
            $output['tickets'][]=$subarray;
          }

        }
        // return $output;
        return view ('events.show', Compact('output'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}

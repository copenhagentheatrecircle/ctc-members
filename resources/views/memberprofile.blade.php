
  <div class="container alert alert-secondary" style="max-width: 100%; background-color: #efefef; margin-bottom: 0px;">
      <div class="row">
        <div class="col-sm-4 col-5">
          <img src="https://ctc-members.dk/media/{{$portrait}}" alt="" style="max-width: 100%; border: lightgrey solid 2px; border-radius: 8%;">
        </div>
        <div class="col-sm-8 col-7">
          <h1 class="display-4">{{$first_name}}</h1><h1 class="display-4">{{$last_name}}</h1>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <br/>
          <blockquote class="blockquote" style="font-size: 16px;"><p>
            {!! nl2br(e($biography)) !!}
          </p></blockquote>
        </div>
      </div>

  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
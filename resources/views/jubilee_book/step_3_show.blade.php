@extends('layouts.app_simple_bulma')

@section('content')

<div class="container">

  @include('jubilee_book/navbar')

  <div class="section" style="padding-top: 20px;">
     @include ('jubilee_book/step_counter', ['step'=>3])

      <section class="section" style="padding-top: 20px;">
        <div class="card">
            <div class="card-content">
                <div class="columns">
                    <div class="column is-3">
                        <nav class="menu">
                            <p class="menu-label">
                                Your Shows
                            </p>
                            <ul class="menu-list">
                                @foreach ($projects as $project)
                                    <li>
                                        <a href="{{$project->id}}" @if ($project->id == $this_project->id) class='is-active' @endif >
                                            <span class="icon @if ($project->id != $this_project->id) has-text-success @endif ">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            {{$project->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    <div class="column">
                    <h3 class="title is-3">{{$this_project->name}}</h3>
                    <h4 class="subtitle is-4">{{$this_project->year}}</h4>
                </div>
                </div>
            </div>
        </div>
        <br>
        <div class="field">
            <div class="control">
              <a href="/jubilee-book/{{$person->uniqid}}/step-2" type="submit" class="button is-outlined is-danger is-pulled-left">back to step 2</a>
            </div>
        </div>
     </section>
  </div>

</div>

@endsection


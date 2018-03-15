@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-1">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Suggestions</li>
          </ol>
        </nav>

        <div class="row scrollbox">
            <div class="col-md-12 col-md-offset-0">
                <div class="card light-transparency">


                    <div class="card-body">


                        <table class="table table-striped">

                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th></th>
                            </tr>

                            @foreach ($posts as $post)
                                <tr>
                                    <td class="pt-3">{{$post->title}}</td>
                                    <td class="pt-3">
                                        @if (!empty($post->person->main_portrait()))

                                          <img src="https://ctc-members-balmec.imgix.net/{{$post->person->main_portrait()}}?fit=crop&w=123&h=123&crop=faces&facepad=1.7&fit=facearea" alt="" style="object-fit: cover; height: 40px; width: 40px; border-radius: 10%; border: solid grey 1px; ">

                                        @else

                                          <img src="https://ctc-members.dk/media/unisex_silhouette.png" alt="" style="object-fit: cover; height: 50px; width: 50px; border-radius: 50%; border: solid grey 1px; ">

                                        @endif
                                        {{$post->person->first_name}} 
                                        {{$post->person->last_name}}
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

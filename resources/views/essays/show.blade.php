@extends('layouts.master')

@section('title',$essay->name)

@section('breadcrumb')
    <li><a href="/home">Home</a></li>
    <li><a href="/essays">Book Essays</a></li>
    <li class="is-active"><a href="#">{{$essay->name}}</a></li>
@endsection

@section('content')

  <div class="section" style="padding: 10px; padding-top: 20px;">

     <section class="section" style="padding: 10px;">
        <div class="columns">
            <div class="column is-2" style="padding-left: 20px;">
                <img src="/media/book_50.png" class="img-fluid">
            </div>
          <div class="column" >
            <h1 class="title is-1" style="padding-top: 1.8rem; margin-bottom: 10px;">{{$essay->name}}</h1>
          </div>
        </div>
        <div class="card">
            <div class="card-content" style="padding: 0.8rem !important;">
                <div class="columns">
                    <div class="column is-2-widescreen is-3-desktop is-3-tablet has-background-white-bis">
                        @include('essays.partials.sidebar')
                    </div>
                    <div class="column" style="padding-left:2%;padding-right:2%;">
                      {{-- show panels --}}
                      @foreach ($panels as $key=>$panel)
                        <div v-show="activePanel=='{{$key}}'" v-cloak >@include('essays.partials.show.'.$key)</div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
     </section>

  </div>

@endsection

@section('scripts')

  <script type="text/javascript">
      const app = new Vue({
          el: '#app',
          data:{
              mode: 'show',
              activePanel: '{{request()->input('panel') ?? 'testimonies'}}',
          },
          methods:{
            changeActivePanel(selection){
              this.activePanel = selection
            },
            submitForm(){
              this.mode = 'show';
            },
          }
      });
  </script>

  <script src="{{ asset('js/dropzone.js') }}"></script>

  {{-- include a Dropzone Instantiation for each image Dropzone --}}
  @foreach($phototypes as $phototype)
      @include('components.dropzone_image_scriptblock',['id'=>'upload-'.$phototype->slug])
  @endforeach

  {{-- include a Dropzone Instantiation for each document Dropzone --}}
  @foreach($documenttypes as $documenttype)
      @include('components.dropzone_document_scriptblock',['id'=>'upload-'.$documenttype->slug])
  @endforeach

@endsection



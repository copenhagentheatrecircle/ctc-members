<div v-show="mode=='show'">
  {{-- show stills --}}
  @if($photographs['show_still']??null)
    <h4 class="title is-5">Show Stills:</h4>
    @foreach ($photographs['show_still'] as $photograph)
      <a href="/files/{{$photograph}}" target="_blank">
        <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
      </a>
    @endforeach
    <br>
  @endif
  {{-- behind the scenes --}}
  @if($photographs['behind_the_scenes']??null)
    <h4 class="title is-5">Behind The Scenes:</h4>
    @foreach ($photographs['behind_the_scenes'] as $photograph)
      <a href="/files/{{$photograph}}" target="_blank">
        <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
      </a>
    @endforeach
    <br>
  @endif
  {{-- posters --}}
  @if($photographs['poster']??null)
    <h4 class="title is-5">Poster:</h4>
    @foreach ($photographs['poster'] as $photograph)
      <a href="/files/{{$photograph}}" target="_blank">
        <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
      </a>
    @endforeach
    <br>
  @endif
  {{-- posters --}}
  @if($photographs['banner']??null)
    <h4 class="title is-5">Banner:</h4>
    @foreach ($photographs['banner'] as $photograph)
      <a href="/files/{{$photograph}}" target="_blank">
        <img src="https://res.cloudinary.com/ctcircle/image/fetch/h_100/https://ctc-members.dk/files/{{$photograph}}">
      </a>
    @endforeach
    <br>
  @endif
</div>
<div v-show="mode=='edit'">
  @include('projects.partials.edit.pictures')
</div>


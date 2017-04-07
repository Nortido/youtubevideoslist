<!doctype html>
<html>
<head>
  <title>YouTube User Videos</title>
</head>
  <body>
    {!! Form::open(['url' => '#', 'method' => 'GET']) !!}
      {!! Form::hidden('pageToken') !!}
      {!! Form::label('Enter username', 'Enter user name') !!}
      {!! Form::text('username') !!}
      {!! Form::submit('Get it!') !!}
    {!! Form::close() !!}

    @if (isset($data['items']) && !empty($data['items']))

      @include('blocks.pagination', ['data' => $data])

      @foreach($data['items'] as $video)
        <div>
          <a href="https://www.youtube.com/watch?v={!! $video->snippet->resourceId->videoId !!}">
            <img src="{!! $video->snippet->thumbnails->standard->url !!}">
          </a>
          <h4>{!! $video->snippet->title !!}</h4>
          <small><pre>{!! $video->snippet->description !!}</pre></small>
        </div>
      @endforeach

      @include('blocks.pagination', ['data' => $data])

    @endif
    <script src="{!! asset('js/app.js') !!}"></script>
    <script src="{!! asset('js/pagination.js') !!}"></script>
  </body>
</html>
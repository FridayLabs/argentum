@spaceless
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @foreach($styles as $style)
        <link rel="stylesheet" href="/static/{{ $style->targetPath() }}">
    @endforeach
    <title>{{ $title }}</title>
</head>
<body>
<div id="app">
    {!! $content !!}
</div>
</body>
@foreach($scripts as $script)
    <script src="/static/{{ $script->targetPath() }}"></script>
@endforeach
</html>
@endspaceless
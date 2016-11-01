@spaceless
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @foreach(styles_assets() as $style)
        <link rel="stylesheet" href="/static/{{ $style->targetPath() }}">
    @endforeach
    <title>{{ $title }}</title>
</head>
<body>{!! $content !!}</body>
@foreach(scripts_assets() as $script)
    <script src="/static/{{ $script->targetPath() }}"></script>
@endforeach
</html>
@endspaceless
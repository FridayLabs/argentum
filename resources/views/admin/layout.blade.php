@spaceless
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @foreach($styles as $style)
        <link rel="stylesheet" href="/static/{{ $style->targetPath() }}">
    @endforeach
</head>
<body>
<div id="app">
    <app></app>
</div>

@foreach($scripts as $script)
    <script src="/static/{{ $script->targetPath() }}"></script>
@endforeach
</body>
</html>
@endspaceless
@spaceless
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @foreach($styles as $style)
        <link rel="stylesheet" href="/static/{{ $style->targetPath() }}">
    @endforeach
    <title>Argentum admin dashboard</title>
</head>
<body>
<div id="app">
    <app></app>
</div>
</body>
@foreach($scripts as $script)
    <script src="/static/{{ $script->targetPath() }}"></script>
@endforeach
</html>
@endspaceless
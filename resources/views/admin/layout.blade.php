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
    <p>
        <router-link to="/dashboard">Go to Foo</router-link>
        <router-link to="/login">Go to Bar</router-link>
    </p>
    <router-view></router-view>
</div>

@foreach($scripts as $script)
    <script src="/static/{{ $script->targetPath() }}"></script>
@endforeach
</body>
</html>
@endspaceless
@spaceless
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php
    file_asset('css', node_path('admin::bulma/css/bulma.css'));
    file_asset('js', node_path('admin::vue/dist/vue.min.js'), 'vue');
    file_asset('vue', 'admin::app.js')->dependsOn('vue');
    ?>

    @foreach(styles_assets() as $style)
        <link rel="stylesheet" href="/static/{{ $style->targetPath() }}">
    @endforeach
</head>
<body>
<div id="app">
    <foo></foo>
</div>

@foreach(scripts_assets() as $script)
    <script src="/static/{{ $script->targetPath() }}"></script>
@endforeach
</body>
</html>
@endspaceless
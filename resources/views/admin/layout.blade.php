@spaceless
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php
    file_asset('css', node_path('bulma/css/bulma.css'));
    file_asset('js', node_path('vue/dist/vue.min.js'), 'vue');
    file_asset('vue', 'admin/app.js')->dependsOn('vue');
    ?>
    @foreach(styles_assets() as $style)
        <link rel="stylesheet" href="/static/{{ $style->targetPath() }}">
    @endforeach
</head>
<body>
<div id="app">
    <p>
        <!-- use router-link component for navigation. -->
        <!-- specify the link by passing the `to` prop. -->
        <!-- <router-link> will be rendered as an `<a>` tag by default -->
        <router-link to="/dashboard">Go to Foo</router-link>
        <router-link to="/login">Go to Bar</router-link>
    </p>
    <!-- route outlet -->
    <!-- component matched by the route will render here -->
    <router-view></router-view>
</div>

@foreach(scripts_assets() as $script)
    <script src="/static/{{ $script->targetPath() }}"></script>
@endforeach
</body>
</html>
@endspaceless
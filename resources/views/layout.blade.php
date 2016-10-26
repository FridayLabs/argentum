@spaceless
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @foreach($styles as $style)
        <link rel="stylesheet" href="/static/{{ $style->getTargetPath() }}">
    @endforeach
    <title>{{ $title }}</title>
</head>
<body>{!! $content !!}</body>
</html>
@endspaceless
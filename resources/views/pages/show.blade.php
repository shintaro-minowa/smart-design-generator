<!DOCTYPE html>
<html>
<head>
    <title>{{ $page->title }}</title>
    <style>
        {!! $page->content->style_css !!}
    </style>
</head>
<body>
    {!! $page->content->body_html !!}
    <script>
        {!! $page->content->script_js !!}
    </script>
</body>
</html>

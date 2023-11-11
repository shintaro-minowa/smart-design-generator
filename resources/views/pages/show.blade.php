<!DOCTYPE html>
<html>
<head>
    <title>{{ $page->title }}</title>
    <style>
        {!! $page->content->css_content !!}
    </style>
</head>
<body>
    {!! $page->content->html_content !!}
    <script>
        {!! $page->content->js_content !!}
    </script>
</body>
</html>

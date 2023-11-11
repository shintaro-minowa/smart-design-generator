<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Design Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input,
        select,
        textarea,
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            background-color: #1e90ff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #00bfff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Smart Design Generator</h1>
        <form action="{{ route('pages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="MyWebsite">
            </div>
            <div class="form-group">
                <label for="site-type">Site type</label>
                <select id="site-type" name="site-type">
                    <option value="Web Application">Web Application</option>
                    <option value="business">Business</option>
                    <option value="blog">Blog</option>
                    <option value="portfolio">Portfolio</option>
                    <option value="e-commerce">E-commerce</option>
                    <option value="homepage">Homepage</option>
                    <option value="game">Game</option>
                </select>
            </div>
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" id="color" name="color" value="blue">
            </div>
            <div class="form-group">
                <label for="design-details">Design details</label>
                <textarea id="design-details" name="design-details" rows="5"
                    placeholder="Enter any specific design requirements here..."></textarea>
            </div>
            <button type="submit">Generate Design</button>
        </form>
    </div>
</body>

</html>

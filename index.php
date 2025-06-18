<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Recipe Sharing Platform</title>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
</head>
<body>
<div class="grid place-items-center h-[100vh]">
    <p class="text-6xl">0</p>
    <button class="text-3xl font-bold text-green-800 cursor-pointer border border-green-800 py-2 px-5 rounded-full hover:bg-green-500 hover:text-white transition-all">
        Press & Hold Me!
    </button>
</div>

<script>
    $(document).ready(function () {
        let pTag = $('p');
        let timeoutId = null;

        $('button').mousedown(function () {
            timeoutId = setInterval(function () {
                let currentNumber = parseInt(pTag.text(), 10);
                currentNumber++;
                pTag.text(currentNumber);
            }, 100);
        }).on('mouseup mouseleave', function () {
            clearInterval(timeoutId);
        });
    });
</script>
</body>
</html>
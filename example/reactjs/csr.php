<?php
$appState = ['name' => 'ReactJS'];
$reactJs = new \ReactJS(
    file_get_contents(__DIR__ . '/build/helloworld.bundle.js'),
    file_get_contents(__DIR__ . '/build/helloworld.bundle.js')
);
$html = $reactJs->getMarkup();

?>
<!doctype>
<html>
<head>
    <title>Hello ReactJS</title>
</head>

<body>
    <div id="root"><?/div>
    <script>
        var appState = <?php echo json_encode($appState, JSON_HEX_TAG);?>;
    </script>
    <script src="/build/helloworld.bundle.js"></script>
</body>
</html>

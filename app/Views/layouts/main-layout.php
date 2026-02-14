<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // HEADER
        $this->renderView('/parts/header');
    ?>

    <?php
    // SIDEBAR
        $this->renderView('/parts/sidebar');
    ?>
    <?php
        echo $content;
    ?>
     <?php
    //FOOTER
        $this->renderView('/parts/footer');
    ?>
</body>
</html>
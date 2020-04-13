<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeoMoon JSON Form Generator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous" />
    <style>
        body{ padding:50px; }
        label{ display:block; }
        input{ padding:5px; }
        select{ width:100px; padding:5px;}
    </style>
</head>
<body>
            <?php
                require_once('form.class.php');
                $form = new Form(['file'=>'./example_form.json']);
                $form->show();
            ?>
</body>
</html>
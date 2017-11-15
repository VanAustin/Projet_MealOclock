<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?=$this->e($title)?></title>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Raleway:200,400,600" rel="stylesheet" />
    <link rel="stylesheet" href="<?= $ASSET_PATH ?>css/style.css">
    <link rel="stylesheet" href="<?= $ASSET_PATH ?>css/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Miriam+Libre" rel="stylesheet">
</head>

<body>
    <?=$this->insert('partials/header')?>

    <?=$this->section('content')?>

    <?=$this->insert('partials/footer')?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

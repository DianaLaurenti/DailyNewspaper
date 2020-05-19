<html>
<head>
    <title><?=$this->e($title)?></title>
</head>
<body>
    <?php $this->insert('templates::header') ?>
    <?=$this->section('content')?>
</body>
</html>

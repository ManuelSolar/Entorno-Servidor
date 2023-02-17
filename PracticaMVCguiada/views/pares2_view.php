<?php
$num = $data['numero'];
$pares = array();
for ($i=0; $i < $num; $i++) { 
    $pares[$i] = $i*2;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC</title>
</head>
<body>
    <h1>Modelo Vista Controlador</h1>
    <p>Los <?php echo $num;?> primeros números pares son:</p>
    <ul>
        <?php foreach ($pares as $par) { ?>
            <li><?php echo $par; ?></li>
        <?php } ?>
    </ul>
    
    
</body>
</html>
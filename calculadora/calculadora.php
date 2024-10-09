<?php
$num= isset($_POST['num']) ? $_POST['num']: null;
$op= isset($_POST['op']) ? $_POST['op']: null;
$mostrador= isset($_POST['mostrador']) ? $_POST['mostrador']: null;
$num2= isset($_POST['num2']) ? $_POST['num2']: null;
$op2= isset($_POST['op2']) ? $_POST['op2']: null;

if($op!=null){
    if($op=="="){
        switch ($op2){
            case "+" : $mostrador=$num2+$mostrador; break;
            case "-" : $mostrador=$num2-$mostrador; break;
            case "*" : $mostrador=$num2*$mostrador; break;
            case "/" : 
                if($mostrador!=0){
                    $mostrador=$num2/$mostrador; 
        }
        else {$mostrador= "Error ";
        }
        break;
        }
    }
    else {
        $op2=$op;
        $num2=$mostrador;
        $mostrador=null;
    }
}
    else {
        $mostrador=$mostrador.$num;
    }


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="diseño.css">
</head>
<body>
    <div class="contenedor">
        <form method="POST" action="calculadora.php">
            <table> 
                <tr> 
                    <td colspan="4">
                        <input type="text" name="mostrador" value="<?php echo $mostrador; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td><button type="submit" name="num" value="7">7</button></td>
                    <td><button type="submit" name="num" value="8">8</button></td>
                    <td><button type="submit" name="num" value="9">9</button></td>
                    <td><button type="submit" name="op" value="+">+</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="num" value="4">4</button></td>
                    <td><button type="submit" name="num" value="5">5</button></td>
                    <td><button type="submit" name="num" value="6">6</button></td>
                    <td><button type="submit" name="op" value="-">-</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="num" value="1">1</button></td>
                    <td><button type="submit" name="num" value="2">2</button></td>
                    <td><button type="submit" name="num" value="3">3</button></td>
                    <td><button type="submit" name="op" value="/">/</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="num" value="0">0</button></td>
                    <td><button type="submit" name="op" value="borrar">C</button></td>
                    <td><button type="submit" name="op" value="=">=</button></td>
                    <td><button type="submit" name="op" value="*">*</button></td>
                </tr>
            </table>
            <input type="hidden" name="num2" value="<?php echo $num2; ?>">
            <input type="hidden" name="op2" value="<?php echo $op2; ?>">
        </form>
    </div>
</body>
</html>

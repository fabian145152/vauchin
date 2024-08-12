<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma de Variables</title>
    <script>
        function obtenerVariables() {
            // Obtiene los parámetros de la URL
            const urlParams = new URLSearchParams(window.location.search);
            const var1 = urlParams.get('var1');
            const var2 = urlParams.get('var2');
            const var3 = urlParams.get('var3');

            // Muestra las variables en el HTML
            document.getElementById('variables').innerHTML = `
                
            <br>
            <br>
            <br>
            <br>
            Var1: ${var1} <br>
            Var2: ${var2} <br>
            Var3: ${var3}
            `;
            document.write(var1);
        }
    </script>
</head>

<body>

    <?php

    ?>

    <form>
        <label for="var1">Variable 1:</label>
        <input type="number" id="var1" name="var1" onblur="sumarVariables()"><br><br>

        <label for="var2">Variable 2:</label>
        <input type="number" id="var2" name="var2" onblur="sumarVariables()"><br><br>

        <label for="var3">Variable 3:</label>
        <input type="number" id="var3" name="var3" onblur="sumarVariables()"><br><br>
    </form>
    <p id="resultado">Resultado: </p>




    <script>
        window.onload = function() {
            window.open('', '', 'width=400,height=200');
        };
    </script>
</body>

</html>
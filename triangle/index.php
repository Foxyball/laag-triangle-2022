<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&family=Rubik&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>LAAG - triangle</title>
</head>
<style>
	* {
	font-family: 'Roboto', sans-serif;
	}

    #triangle {
        display: block;
        margin: 0 auto;
        cursor: pointer;
    }

    #title {
        text-align: center;
    }
</style>

<body>

    <h1 id="title">ЛААГ - <?php echo date('Y'); ?> </h1>

    <div class="alert alert-primary" role="alert"><p style="text-align:center;"><b>Отдолу се намира друг статичен триъгълник с фиксирани координати, който няма нищо общо с въведените от Вас координати и  при кликване вътре се оцветява, а при кликане извън него се премахва цвета!</b></p></div>
    
    <a class="btn btn-dark" href="code.php" download>Свали код</a>
    <a class="btn btn-dark" href="https://github.com/Foxyball" target="_blank">GitHub</a>

    <!-- triangle -->
    <canvas id="triangle" width="1000" height="1000"></canvas>

    <script>
        // https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API/Tutorial/Drawing_shapes
        // https://www.w3schools.com/jsref/met_element_addeventlistener.asp

        let ctx = document.querySelector("#triangle");
        let context = ctx.getContext("2d");


        
        // Въвеждане на координатите за  A(x1, y1), B(x2, y2), C(x3, y3),P(x4, y4)
        let x1 = prompt("Точка А(x1, y1) - въведете x1");
        let y1 = prompt("Точка А(x1, y1) - въведете y1");
        let x2 = prompt("Точка B(x2, y2) - въведете x2");
        let y2 = prompt("Точка B(x2, y2) - въведете y2");
        let x3 = prompt("Точка C(x3, y3) - въведете x3");
        let y3 = prompt("Точка C(x3, y3) - въведете y3");
        let x4 = prompt("Точка P(x4, y4) - въведете x4");
        let y4 = prompt("Точка P(x4, y4) - въведете y4");

        // Проверка дали точката е вътре в триъгълника или извън него 
        function isInside(x1, y1, x2, y2, x3, y3, x4, y4) {
            // Изчисляване на триъгълник ABC
            let A = area(x1, y1, x2, y2, x3, y3);

            // Изчисляване на триъгълник PBC
            let A1 = area(x4, y4, x2, y2, x3, y3);

            // Изчисляване на триъгълник PAC
            let A2 = area(x1, y1, x4, y4, x3, y3);

            // Изчисляване на триъгълник PAB
            let A3 = area(x1, y1, x2, y2, x4, y4);

            // Проверка дали сумата на триъгълниците е същата като триъгълника ABC
            return (A == A1 + A2 + A3);
        }

        // Изчисляване на площта на триъгълник
        function area(x1, y1, x2, y2, x3, y3) {
            return Math.abs((x1 * (y2 - y3) + x2 * (y3 - y1) +
                x3 * (y1 - y2)) / 2.0);
        }

        // Проверка дали точката P(x4, y4) е вътре в триъгълника ABC
        if (isInside(x1, y1, x2, y2, x3, y3, x4, y4)) {
            context.fillStyle = "green";
            context.font = "30px Arial";
            context.fillText("Отговор: Точката P се намира вътре в триъгълника!", 10, 50);
        } else {
            context.fillStyle = "red";
            context.font = "30px Arial";
            context.fillText("Отговор: Точката P се намира извън триъгълника!", 10, 50);
        }



        // ************* Статичен триъгълник ************* 

        // Статичен триъгълник ABC с фиксирани координати
        function triangle(x, y) {
            context.beginPath();
            context.moveTo(x, y);
            context.lineTo(x - 100, y + 200);
            context.lineTo(x + 100, y + 200);
            context.closePath();
            context.lineWidth = 2;
            context.stroke();
            context.font = "30px Arial";
            context.fillText("C", x - 10, y - 5);
            context.fillText("A", x - 120, y + 200);
            context.fillText("B", x + 100, y + 200);
        }

        // Оцвети триъгълника ABC в червено цвят, ако е натиснато вътре в него
        ctx.addEventListener("click", function(event) {
            let x = event.pageX - ctx.offsetLeft;
            let y = event.pageY - ctx.offsetTop;

            if (context.isPointInPath(x, y)) {
                context.fillStyle = "red";
                context.fill();
            }
        });

        // Премахни оцветяването на триъгълника ABC, ако е натиснато извън него
        ctx.addEventListener("click", function(event) {
            let x = event.pageX - ctx.offsetLeft;
            let y = event.pageY - ctx.offsetTop;
            if (context.isPointInPath(x, y)) {
                return;
            }

            context.fillStyle = "#ffffff";
            context.fill();
        });

        // Извикване на функцията за статичния триъгълник ABC
        triangle(500, 200);
    </script>


    <!-- <script src="triangle.js"></script> -->
</body>

</html>

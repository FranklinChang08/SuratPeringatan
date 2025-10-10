<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        button {
            display: block;
        }

        @media screen and (max-width: 765px) {
            .container {
                grid-template-columns: 1fr;
            }

   
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Surat Peringatan</h1>
        <button>SUBMIT</button>
    </div>
</body>

</html>
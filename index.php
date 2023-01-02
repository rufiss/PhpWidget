<?php
header("Access-Control-Allow-Origin: *")
?>
<!DOCTYPE html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-md-center" style="margin-top:30px"><a href="index.php" style="text-decoration: none">Criar Prescrição</a></h1>
    <div class="form-group">
        <form id="selectFlowForm" action="/signaturestart.php" method="POST">
            <div class="container" style="margin-top:30px">
                <div class="col-sm-2 align-self-center">
                    <div class="row justify-content-center mb-2">
                        <label for="cpfField">Name:</label>
                        <input id="nameField" class="form-control" type="text" name="name" placeholder="Name" required />
                    </div>
                    <div class="row justify-content-center mb-2">
                        <label for="cpfField">CPF:</label>
                        <input id="cpfField" class="form-control" type="text" name="cpf" placeholder="000.000.000-00" required />
                    </div>
                    <div class="row justify-content-center mb-2">
                        <label for="emailField">Email:</label>
                        <input id="emailField" class="form-control" type="text" name="email" placeholder="example@example.com" required />
                    </div>
                    <button id="searchButton" type="submit" class="btn btn-primary mt-2">Search</button>
                </div>
            </div>
    </div>
</body>
.

<?php

use Util\Service;

require __DIR__ . '/Util/Service.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    die();
}

$name = $_POST['name'];

$cpf = $_POST['cpf'];

$email = $_POST['email'];

function getEmbed($name, $cpf, $email)
{

    $service = new Service();


    $service->init();


    $embeddedUrl = $service->run($name, $cpf, $email);

    return $embeddedUrl;
}


?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="site.css">

<head>
    <title> Prescription </title>
    <script type="text/javascript" src="https://cdn.lacunasoftware.com/libs/signer/lacuna-signer-widget-0.6.0.min.js" integrity="sha256-TM1zGyxt8+FQ3VcihnbovQlTP1pBRAVLSKKTOxRBIGw=" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<h1 class="text-md-center" style="margin-top:30px"><a href="index.php" style="text-decoration: none">Criar Prescrição</a></h1>
<body>
    <div class=row-cols-auto>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div id="embed-container" class="frame-container"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
<script>
    $(document).ready(function() {
        var widget = new LacunaSignerWidget();

        widget.on(widget.events.documentSigned, function(e) {

            alert('Documento ' + e.id + ' assinado');
        });

        widget.render("<?php echo getEmbed($name, $cpf, $email) ?>", 'embed-container');
    });
</script>

</html>

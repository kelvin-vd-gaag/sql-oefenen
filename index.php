<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oefenen met SQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/themes/prism.min.css">
</head>
<body>
<?php
require "database.php";
$query = ""; // Initialiseer de query-variabele
if (isset($_POST['sql'])) {
    $query = $_POST['sql'];
    try {
        $get_games = $conn->prepare($query);
        $get_games->execute();
        $games = $get_games->fetchAll();
    } catch (PDOException $error) {
        echo "<div class='alert alert-danger' role='alert'>  " .$error->getMessage() . ";
</div>";
    }

}
?>
<div class="container">
    <form method="post" action="index.php">
        <div class="mb-3">
            <label for="sql" class="form-label">Jouw Query</label>
            <input type="text" class="form-control" id="sql" name="sql" aria-describedby="sqlHelp"
                   value="<?php echo htmlspecialchars($query); ?>">
            <!-- Gebruik htmlspecialchars om HTML-tekens te ontsnappen -->
            <input type="submit" class="btn btn-primary mt-3" value="Voer de query uit">
            <!--            <div id="sqlHelp" class="form-text">Klik <a href="#">hier</a> voor tips</div>-->
        </div>
    </form>
    <?php
    if (isset($games)) {
        ?>
        <span><?php echo count($games) . " games gevonden" ?></span>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">title</th>
                <th scope="col">price</th>
                <th scope="col">rating</th>
                <th scope="col">release_year</th>
                <th scope="col">Stock</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($games as $game) { ?>
                <tr>
                    <td scope="row"><?php echo $game['id'] ?></td>
                    <td><?php echo $game['title'] ?></td>
                    <td><?php echo $game['price'] ?></td>
                    <td><?php echo $game['rating'] ?></td>
                    <td><?php echo $game['release_year'] ?></td>
                    <td><?php echo $game['stock'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>

<?php
    require "dbBroker.php";
    require "movie.php";

    session_start();

   

    $movies = Movie::getAllMovies($connection);

    if (!$movies) {
        echo "Greska u upitu.";
        die();
    }

    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies to watch</title>

</head>

<body>

    <div>
        <h1>Movie list</h1> 
    </div>

    

    <div style="margin-top: 10px; background-color:  rgba(10, 65, 82, 0.5); border:none" >
        <table id="movieTable" class="table " style="color: white; background-color: rgba(10, 65, 82, 1);">
            <thead class=" table-dark" style="color: white; background-color: rgb(2, 47, 61);">
            <tr>
                <th scope="col"></th>
                <th scope="col">Movie name</th>
                <th scope="col">Genre</th>
                <th scope="col">Year</th>
                <th scope="col">Select movie</th>
            </tr>
            </thead>

            <tbody>
                <?php
                    while ($row = $movies->fetch_array()) { 
                ?>
                <tr>
                    <td></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["genre"] ?></td>
                    <td><?php echo $row["year"] ?></td>
                    
                    <td>
                        <label class="custom-radio-btn">
                            <input type="radio" name="checked-donut" value=<?php echo $row["id"] ?>>
                        </label>
                    </td>

                </tr>
                <?php
            }
         } ?>
            </tbody>
        </table>
        
    </div>

    



    

</body>
</html>

<?php
    require "dbBroker.php";
    require "movie.php";

    session_start();

    if (isset($_GET['logout']) && !empty($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">   
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Movies to watch</title>
    <a href="home.php?logout=true" style="float: right; padding: 0px">
            <button id="logout" type="button" class="btn" style="color: white; background-color: rgba(218, 226, 0, 1);">
                <i class="bi bi-arrow-bar-left"></i>
                Log out
            </button>
        </a>
</head>

<body>

    <div>
        <h1>Movie list</h1> 
       
    </div>

    
    

    <div style="margin-top: 10px; background-color: rgba(44, 37, 40, 1); border:none" >
        <table id="movieTable" class="table " style="color: white; background-color: rgba(132, 111, 122, 0.37);">
            <thead class=" table-dark" style="color: white; background-color: rgba(44, 37, 40, 1);">
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
        <div class="row" style="padding: 10px; background-color: rgba(10, 65, 82, 0)">
            <div class="col-md-4">
        
                <button type="button" class="btn btn-primary"
                    style="color: white; background-color:rgba(130, 132, 141, 1);" data-toggle="modal" data-target="#addMovieModal">
                    <i class="bi bi-controller"></i> 
                    Add new movie   
                </button>
             </div>
        
            <div class="col-sm-8" style="text-align: right">
                <button id="btnEditMovie" class="btn " style="color: white; background-color: rgba(130, 132, 141, 1);"
                    data-toggle="modal" data-target="#editMovieModal">
                    <i class="bi bi-pen-fill"></i> 
                    Update movie  
                </button>
                
                <button id="btnDeleteMovie" class="btn " style="color: white; background-color: rgba(196, 49, 64, 1);">
                    <i class="bi bi-eraser-fill"></i> 
                    Delete movie
                </button>
            </div>
        </div>
        


        
    </div>

    
    <!-- Add game modal -->
    <div class="modal fade" id="addMovieModal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content" style="border: 3px solid rgb(2, 47, 61); background-color:rgb(2, 47, 61) ;">
                <div class="modal-header">
                    <h3 style="color: white; text-align:left">Add new movie</h3>  
                </div>
                <div class="modal-body">
                    <div class="">
                        <form action="#" method="post" id="addMovieForm">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input  type="text" style="border: 1px solid black" name="userId" class="form-control"
                                           placeholder="User ID" value="<?php echo $_SESSION['user_id'] ?>" readonly/> 
                                    </div>
                                    <div class="form-group">
                                        <input  type="text" style="border: 1px solid black" name="movieName" class="form-control"
                                           placeholder="Movie name" value=""/> 
                                    </div>
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" name="movieGenre" class="form-control" placeholder="Movie genre"
                                           value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" style="border: 1px solid black" name="movieYear" class="form-control"
                                           placeholder="Movie year" value=""/>
                                    </div>
                                </div>
                                <div class="col-4" style="text-align: center">
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success "
                                            style="background-color: rgba(10, 65, 82, 1); border: 1px solid black;">
                                             Add movie
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-default" 
                                            style="color: white; background-color: rgb(82, 10, 46); border: 1px solid white" 
                                            data-dismiss="modal">Dismiss
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>

<!-- Edit game Modal-->
    <div class="modal fade" id="editMovieModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 3px solid rgb(2, 47, 61); background-color:rgb(2, 47, 61) ;">
                <div class="modal-header">
                    <h3 style="color: white; text-align:left">Edit movie</h3>   
                </div>
                <div class="modal-body">
                    <div class="">
                        <form action="#" method="post" id="editMovieForm">
                    
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input id="id" type="text" style="border: 1px  black" name="movieId" class="form-control"
                                           placeholder="Movie ID" value="" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <input id="movieNameId" style="border: 1px solid black" type="text" name="movieName" class="form-control"
                                           placeholder="Movie name" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input id="movieGenreId" style="border: 1px solid black" type="text" name="movieGenre" class="form-control"
                                           placeholder="Movie genre" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input id="movieYearId" style="border: 1px solid black" type="number" name="movieYear" class="form-control"
                                           placeholder="Movie year" value=""/>
                                    </div>
                                </div>
                                <div class="col-4" style="text-align: center">
                                    <div class="form-group">
                                        <button id="btnIzmeni" type="submit" class="btn btn-success"
                                            style="background-color: rgba(10, 65, 82, 1); border: 1px solid black;">
                                             Update movie
                                        </button>
                                    </div>
                                    <div class= "form-group">
                                        <button type="button" class="btn btn-default" 
                                        style="color: white; background-color: rgb(82, 10, 46); border: 1px solid white" 
                                        data-dismiss="modal">Dismiss
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
  
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="funkcije.js"></script>


    

</body>
</html>

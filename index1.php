<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Crud</title>
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <span class="navbar-brand mb-0 h1"> PHP CRUD</span>
</nav>
<div class="container">
<?php require_once 'crud.php'; ?>

<?php
    $mysqli = new mysqli('localhost', 'root', null, 'studnetcrud');
    $students = $mysqli->query("SELECT * FROM students");
?>
    <table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Roll</th>
        <th>Actions</th>
    </tr>
    <?php while($row = $students->fetch_assoc()) :?>
    <tr>
        <td><?php echo $row['name'];?> </td>
        <td><?php echo $row['roll'];?> </td>
        <td>
        <a href="index.php?edit=<?php echo $row['id']?>" class="btn btn-primary btn-sm">Edit</a>
        <a href="index.php?delete=<?php echo $row['id']?>" class="btn btn-danger btn-sm">Delete</a>
        </td>
    </tr>
    <?php endwhile;?>
    </table>
    <div class="row">
       <div class="col-md-12">
       <form method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Student's Name" value=<?php echo $name?>>
                </div>
                <div class="form-group">
                    <label for="roll">Roll No</label>
                    <input type="text" name="roll" class="form-control" id="roll" placeholder="Enter Student's Roll No" value=<?php echo $roll?>>
                </div>
                <?php if(isset($_GET['edit'])): ?>
                    <input type="number" hidden name='id' value=<?php echo $_GET['edit']?>>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="save">Submit</button>
                <?php endif; ?>

                <a id="ajaxSubmit" class="btn btn-info">Ajax Submit</a>
        </form>
        </div>
    </div>
</div>

    <script src="assets/jquery/dist/jquery.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>

   <script>
   $("#ajaxSubmit").on('click', function() {
        $.ajax('/index.php',
        {
            type:"POST",
            data: {
                name: $('#name').val(),
                roll: $('#roll').val(),
                save: 'save'
            },
            success: function (data,status,xhr) { 
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
            }
        });
   });
   </script>
</body>
</html>
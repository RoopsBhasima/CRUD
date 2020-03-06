<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include_once 'crud.php';?>
<div class="container">
<div class="row">
<div class="col-md-12">
<table class="table table-bordered">
<?php
    $mysqli = new mysqli('localhost', 'root', null, 'students');
    $students = $mysqli->query("SELECT * FROM studentlist");
?>
<tr>
        <th>Name</th>
        <th>Roll</th>
        <th>Actions</th>
    </tr>
<?php while($student = $students->fetch_assoc()) :?>
    <tr>
        <td><?= $student['name'];?> </td>
        <td><?= $student['roll'];?> </td>
        <td>
        <a href="?edit=<?= $student['id']?>" class="btn btn-primary btn-sm">Edit</a>
        <a href="?delete=<?= $student['id']?>" class="btn btn-danger btn-sm">Delete</a>
        </td>
    </tr>
<?php endwhile;?>
</table>
</div>
<div class="col-md-12">
<form method="POST">
    <div class="form-group">
        <label for="nsme">Name</label>
        <input type="text" name="name" class="form-control" id="name"   placeholder="Enter Student's Name" value='<?= $name?>'/>
    </div>
    <div class="form-group">
        <label for="roll">Roll No</label>
        <input type="text" name="roll" class="form-control" id="roll" placeholder="Enter Student's Roll No" value='<?= $roll?>'>
    </div>
    <?php if(isset($_GET['edit'])): ?>
        <input type="number" hidden name='id' value=<?php echo $_GET['edit']?>>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
    <?php else: ?>
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <a id="ajaxSave" class="btn btn-primary"  name="ajaxSave">Ajax Save</a>
    <?php endif; ?>

</form></div>
</div>
</div>

<script src="assets/jquery/dist/jquery.min.js"></script>

<script>
    $("#ajaxSave").on('click', function() {
        $.ajax('/index.php',    
        {
            type:"POST",
            data: {
                name: $('#name').val(),
                roll: $('#roll').val(),
                save: 'save'
            },
            success: function (data,status,xhr) {
                console.log('done');
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
            }
        });
    })
</script>
</body>
</html>
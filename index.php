<?php include('server.php');

    //fetching records for editing
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit_state = true;
        $rec = mysqli_query($db, "SELECT * FROM info WHERE id=$id");
        $record = mysqli_fetch_array($rec);
        $name = $record['name'];
        $address = $record['address'];
        $id = $record['id'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galactique Peace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (isset($_SESSION['msg'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['msg']; 
                unset($_SESSION['msg']);
            ?>

        </div>
    <?php endif ?>
    <form action="server.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label for="">Galactique Embassador</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="input-group">
            <label for="">Embassador's Planet</label>
            <input type="text" name="address" value="<?php echo $address; ?>">
        </div>
        <div class="input-group">
            <?php if ($edit_state == false): ?>
                <button type="submit" name="save" class="btn">Assign</button>
            <?php else: ?>
                <button type="submit" name="update" class="btn">Propose</button>
            <?php endif ?>

        </div>
    </form>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Planet</th>
                <th colspan="2">Action</th>

            
            </tr>
        
        </thead>
        <tbody>
            <?php 
                while ($row = mysqli_fetch_array($results)){ ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><a class="edit_btn" href="index.php?edit=<?php echo $row['id']; ?>">Propose a Change</a></td>
                    <td><a class="del_btn" href="server.php?del=<?php echo $row['id']; ?>">Depost</a></td>

                </tr>
            <?php } ?>
            
        
        </tbody>
    
    </table>
</body>
</html>
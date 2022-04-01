<?php     
	$errors = "";

	$db = mysqli_connect("localhost", "root", "", "todo");
	
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}
		else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}	

    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];

        mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
        header('location: index.php');
    }
?>


<!DOCTYPE html>       
<html>
<head>
	<title>To Do List </title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
    <div class="wrapper">
	<header>
		<h2 style="font-style: 'Hervetica';">ToDo App</h2>
    </header>
	<form method="post" action="index.php" class="inputField">
        <div class='error'>
            <?php if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
            <?php } ?>
        </div>
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" ><i class="fa fa-plus"></i></button>
	</form>

    <table>
		<thead class="table-head">
			<tr>
				<th>No</th>
				<th >Tasks</th>
				<th style="width: 55px;">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 			
			$tasks = mysqli_query($db, "SELECT * FROM tasks");

			$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
				<tr>
					<td> <?php echo $i; ?> </td>
					<td class="task"> <?php echo $row['task']; ?> </td>
					<td class="delete"> 
						<a href="index.php?del_task=<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></a> 
					</td>
				</tr>
			<?php $i++; } ?>	
		</tbody>
    </table>
    </div>
</body>
</html>
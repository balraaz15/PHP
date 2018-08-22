<h3><?php if($edit) echo 'Edit a Person'; else echo 'Add a person'; ?></h3>
<form method="POST">
	<input type="hidden" name="person_id" value="<?php if($edit) echo $row['person_id']; ?>">
    <input type="text" name="firstname" placeholder="Firstname" value="<?php if($edit) echo $row['firstname']; ?>"><br><br>
    <input type="text" name="lastname" placeholder="Lastname" value="<?php if($edit) echo $row['lastname']; ?>"><br><br>
    <input type="date" name="dob" value="<?php if($edit) echo $row['dob']; ?>"><br><br>
    <input type="email" name="email" placeholder="email" value="<?php if($edit) echo $row['email']; ?>"><br><br>
    <input type="submit" name="submit" value="<?php if($edit) echo 'Update'; else echo 'Submit'; ?>">
</form>
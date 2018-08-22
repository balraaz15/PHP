<?php
	if(isset($_GET['did'])) {
        $del = $personTable->delete('person_id', $_GET['did']);
        if($del) {
        	header('location:index.php?page=list&del=1');
        } else {
            echo '<p class="alert alert-info alert-dismissible fade show" role="alert">Could not delete person.</p>';
            unset($_GET['did']);
        }
    }

    if(isset($_GET['del'])) {
    	echo '<p class="alert alert-warning alert-dismissible fade show" role="alert">Person Deleted</p>';
    }
?>

<h3>List of Persons <a href="addedit" style="float:right;"><small>Add a new person</small></a></h3>
<hr>
<ul class="list-group list-group-flush">
	<?php
		foreach($listPersons as $row) {
			echo '<li class="list-group-item">'.$row['firstname'].' '.$row['lastname'].' was born on '.$row['dob'].' and their email address is "'.$row['email'].'"  <a href="addedit?eid='.$row['person_id'].'">Edit</a>  <a href="list?did='.$row['person_id'].'">Delete</a></li>';
		}
	?>
</ul>

<h3 style="margin-top:20px;">List of Messages</h3>
<hr>
<ul class="list-group list-group-flush">
	<?php
		foreach($listMessages as $msg) {
			$person = $personTable->find('person_id', $msg['person_id'])->fetch();

            echo '<li class="list-group-item">'.$person['firstname'].' '.$person['lastname'].' sent <strong>'.$msg['message'].'</strong> on '.$msg['post_date'].'</li>';
		}
	?>
</ul>
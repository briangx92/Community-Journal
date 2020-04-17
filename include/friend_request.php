<!-- adding some kind of code in the value part.
I'm thinking of something that grabs the username from the url and places it here.active
After the username is attached I can query the get request and add the current logged in user and add them to their friends list -->

<form action="friend-profile.php" method="get">
    <button type="submit" name="sub_fr" value="<?php $friend = $_SESSION['email'] ?>">test</button>
</form>
<?php
$sub_fr = isset($_GET['sub_fr']);
print_r($sub_fr);

?>
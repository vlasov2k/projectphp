<?php
echo "are you ready?";
?>
<form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
    <p>yes or no
        <input text='submit' name='start'>
    </p>

    <p>
        <input type='submit'>
    </p>
</form>

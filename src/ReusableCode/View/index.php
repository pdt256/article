<?php
/**
 * @var \pdt256\article\ReusableCode\User $user
 * @var bool $isPassword1Valid
 * @var bool $isPassword2Valid
 */
?>

<p>
    First Name: <?=$user->getFirstName()?><br>
    Last Name: <?=$user->getLastName()?>
</p>

<ul>
    <li>Is Password 1 Valid: <?=var_export($isPassword1Valid, true)?> (<?=$password1?>)</li>
    <li>Is Password 2 Valid: <?=var_export($isPassword2Valid, true)?> (<?=$password2?>)</li>
    <li>Is Password 3 Valid: <?=var_export($isPassword3Valid, true)?> (<?=$password3?>)</li>
</ul>

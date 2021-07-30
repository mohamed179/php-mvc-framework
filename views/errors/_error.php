<?php

/**
 * @var $message string
 * @var $trace string
 */

?>

<h1><?= $message ?></h1>
<?php if(!is_null($trace)): ?><pre><?= $trace ?></pre><?php endif ?>
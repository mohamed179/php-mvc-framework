<?php

/**
 * @var $model \App\Models\LoginModel
 */

?>
<h1>Login</h1>
<form method="post" action="/login">
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email"
               type="email"
               name="email"
               value="<?= $model->email ?>"
               class="form-control<?= $model->hasError('email') ? ' is-invalid' : '' ?>">
        <?php if($model->hasError('email')): ?><div class="invalid-feedback">
             <?= $model->getFirstError('email') ?>
        </div><?php endif ?>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input id="password"
               type="password"
               name="password"
               class="form-control<?= $model->hasError('password') ? ' is-invalid' : '' ?>">
        <?php if($model->hasError('password')): ?><div class="invalid-feedback">
             <?= $model->getFirstError('password') ?>
        </div><?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 padding-right">
                    <?php if (isset($result)): ?>
                        <p>Вы зарегистрированы!</p>
                    <?php else: ?>
                        <?php if (isset($errors) && is_array($errors)): ?>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li style="color: red;"> - <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <form action="#" method="post" class="form-horizontal">
                            <fieldset>
                                <legend>Регистрация</legend>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="login">Логин: </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control input-md" id="login" name="login"
                                               placeholder="Логин" value="<?= Input::get_value('login'); ?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Имя: </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control input-md" id="name" name="name"
                                               placeholder="Имя" value="<?= Input::get_value('name'); ?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="email">Email: </label>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control input-md" id="email" name="email"
                                               placeholder="E-mail" value="<?= Input::get_value('email'); ?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="password">Пароль: </label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control input-md" id="password"
                                               name="password" placeholder="Пароль"
                                               value="<?= Input::get_value('password'); ?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="password2">Повторите пароль: </label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control input-md" id="password2"
                                               name="password2" placeholder="Повторите пароль"/><br>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="submit"></label>
                                    <div class="col-md-8">
                                        <input type="hidden" class="form-control input-md" name="token"
                                               value="<?= Token::generate_token(); ?>"/>
                                        <button type="submit" id="submit" name="submit" class="btn btn-success">
                                            Зарегистрироваться
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4 padding-right">

                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li style="color: red"> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>


                        <form  method="post" class="form-horizontal">
                            <fieldset>
                                <!-- Form Name -->
                                <legend>Вход на сайт</legend>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="login">Логин: </label>
                                    <div class="col-md-8">
                                        <input id="login" name="login" type="text" placeholder="Логин" class="form-control input-md" required value="<?= Input::get_value('login')?>">
                                    </div>
                                </div>
                                <!-- Password input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="password">Пароль: </label>
                                    <div class="col-md-8">
                                        <input id="password" name="password" type="password" placeholder="Введите пароль" class="form-control input-md">
                                    </div>
                                </div>
                                <!-- Button (Double) -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="submit"></label>
                                    <div class="col-md-8">
                                        <input type="hidden" class="form-control input-md" name="token" value="<?= Token::generate_token();?>" />
                                        <button type="submit" id="submit" name="submit" class="btn btn-success">Login</button>
                                    </div>
                                </div>

                            </fieldset>
                        </form>
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
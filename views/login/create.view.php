<?php require 'views/partials/head.php' ?>
<?php require 'views/partials/nav.php' ?>

<main>
    <div class="center-container">
        <?php if (isset($errors['account'])) : ?>
            <div class="error-container">
                <?= $errors['account'] ?>
        </div>
        <?php endif; ?>

        <form action="/session" method="POST" class="form-container">
            <div>
                <input id="email" name="email" type="text" autocomplete="email" required class="form-input" placeholder="Username" value="<?= old('email') ?>">
            </div>

            <div>
                <input id="password" name="password" type="password" autocomplete="current-password" required class="form-input" placeholder="Password">
            </div>

            <div>
                <button type="submit" class="form-button">
                    Login
                </button>
            </div>
        </form>
    </div>
</main>

<?php require 'views/partials/footer.php' ?>
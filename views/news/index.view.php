<?php require 'views/partials/head.php' ?>
<?php require 'views/partials/nav.php' ?>
<main>
    <div class="center-container">
        <?php if (!empty($info)) : ?>
            <div class="info-container">
                <?php echo $info ?>
            </div>
        <?php endif; ?>

        <ul class="news-container">
            <?php if (!empty($articleNews)) : ?>
                <h1>All News</h1>
            <?php endif; ?>

            <?php foreach ($articleNews as $news) : ?>
                <li class="news-item transparent">
                    <div>
                        <b><?= htmlspecialchars($news['title']) ?></b>                   
                        <?= htmlspecialchars($news['body']) ?>
                    </div>
                    <div class="actions-buttons">
                        <div class="news-action-button">
                            <a href="/news/edit?id=<?= $news['id'] ?>" class="edit-link" 
                                data-title="<?= htmlspecialchars($news['title']) ?>" 
                                data-body="<?= htmlspecialchars($news['body']) ?>"
                                data-id="<?= htmlspecialchars($news['id']) ?>"
                                >
                                <img class="action-icon" src="/public/images/pencil.svg" alt="edit">
                            </a>
                        </div>
                        <button class="transparent no-border" onclick="document.querySelector('#delete-form').submit()"><img class="action-icon" src="/public/images/close.svg" alt="delete"></button>

                        <form id="delete-form" class="hidden" method="POST" action="/news">
                            <input type="disabled" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $news['id'] ?>">
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <form method="POST" action="/news" class="form-container transparent" id="new-form">
            <!-- <input id='input-patch' type="hidden" class="hidden" name="_method" value="PATCH"> -->
            <input id='input-id' type="hidden" class="hidden" name="id">
            <div class="form-header">
                <h1 id="form-label">Create News</h1>
                <button type="button" id="cancelButton" class="form-edit-exit hidden transparent no-border">
                    <img class="action-icon" src="/public/images/close.svg" alt="delete">
                </button>
            </div>
            <div>
                <div>
                    <div>
                        <input id="title" name="title" rows="3" class="form-input" placeholder="Title" value="<?= $_POST['title'] ?? '' ?>" />

                        <?php if (isset($errors['title'])) : ?>
                            <p class="text-red-500"><?= $errors['title'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <textarea id="body" name="body" rows="3" class="form-input" placeholder="Description"><?= $_POST['body'] ?? '' ?></textarea>

                        <?php if (isset($errors['body'])) : ?>
                            <p class="text-red-500"><?= $errors['body'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="form-button" id="form-input">
                    Create
                </button>
            </div>
        </form>

        <form method="POST" action="/session" class="form-container transparent no-border">
            <input type="hidden" name="_method" value="DELETE" />

            <button class="form-button">Log Out</button>
        </form>
    </div>
</main>

<?php require 'views/partials/footer.php' ?>

<?php require 'views/partials/footer.php' ?>

<script>
    $(document).ready(function() {
        $(".edit-link").click(function(event) {
            event.preventDefault();
            
            var title = $(this).data("title");
            var body = $(this).data("body");
            
            var originalTitle = $("#title").val();
            var originalBody = $("#body").val();
            
            $("#title").val(title);
            $("#body").val(body);
            $("#form-label").text("Update News");
            $("#form-input").text("Update");
            
            $("#cancelButton").removeClass("hidden");
            $("#input-id").removeClass("hidden").val($(this).data("id"));
            if ($("#input-patch").length === 0) {
                var inputPatch = $("<input>", {
                    id: "input-patch",
                    type: "hidden",
                    name: "_method",
                    value: "PATCH"
                });
                $("#new-form").append(inputPatch);
            }

            $("#cancelButton").click(function() {   
                $("#title").val(originalTitle);
                $("#body").val(originalBody);

                $("#form-label").text("Create News");
                $("#form-input").text("Create"); 

                $(this).addClass("hidden");
                $("#input-patch").remove();
                $("#input-id").addClass("hidden").val("");
            });
        });
        
    });
</script>
<h1>{% admin_featured_edit-title %}</h1>

<a href="/filmtono/featured" class="btn-back">
    <i class="fa-solid fa-arrow-left"></i>
    {%admin_featured_btn-back%}
</a>

<?php
    require_once __DIR__ . '/../../templates/alertas.php';
?>

<div class="form-div">
    <form class="form" method="POST">
        <?php include_once __DIR__.'/form.php'?>
        <input type="submit" id="btn-featured" value="{%admin_featured_edit-btn%}" class="btn-submit">
    </form>
</div>
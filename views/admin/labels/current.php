<a href="/filmtono/labels" class="btn-back">
    <i class="fa-solid fa-arrow-left"></i>
    {%admin_labels_back-btn%}
</a>

<h1 class="mBottom-5"><?php echo $sello->labelName; ?></h1>

<?php
    if($sello->musicType === '1'):?>
        <p class="center">
            <span class="text-yellow">{%admin_labels_aggregator%}:</span>
            <?php echo $sello->companyName; ?>
        </p>
    <?php elseif($sello->musicType === '2'): ?>
        <p class="center">
            <span class="text-yellow">{%admin_labels_publisher%}:</span>
            <?php echo $sello->companyName; ?>
        </p>
    <?php endif; ?>

<p class="center">
    <span class="text-blue">{%admin_labels_created%}: </span>
    <?php echo $sello->labelDate; ?>
</p>

<p class="center">
    <span class="text-blue">{%admin_labels_user%}: </span>
    <?php echo $sello->userName; ?>
</p>

<p class="center">
    <span class="text-blue">{%admin_labels_company%}: </span>
    <?php echo $sello->companyName; ?>
</p>

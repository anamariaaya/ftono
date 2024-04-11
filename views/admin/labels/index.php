<h1>{% <?php echo $titulo;?> %}</h1>

<!-- <?php //debugging($ntmusica)
;?> -->
<div class="dashboard__total">
    <p><span>{% labels_total %}: </span> 
        <?php echo count($labels); ?>
    </p>
    <p><span>{% publishers_total %}: </span> 
        <?php echo count($publishers); ?>
    </p>
    <p><span>{% aggregators_total %}: </span> 
        <?php echo count($aggregators); ?>
    </p>

    <div class="dashboard__search">
        <input class="dashboard__total__type-search" type="text" id="sellos-search" placeholder="{% labels_placeholder %}"/>
    </div>
</div>

<div class="cards">
    <div class="cards__container" id="grid-sellos">
    </div>
</div>

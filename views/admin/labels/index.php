<h1>{% <?php echo $titulo;?> %}</h1>

<div class="dashboard__total">
    <p><span>{% labels_total %}: </span> 

    </p>
    <p><span>{% publishers_total %}: </span> 

    </p>
    <p><span>{% aggregators_total %}: </span> 

    </p>

    <div class="dashboard__search">
        <input class="dashboard__total__type-search" type="text" id="sellos-search" placeholder="{% labels_placeholder %}"/>
    </div>
</div>

<div class="cards">
    <div class="cards__container" id="grid-sellos">
    </div>
</div>

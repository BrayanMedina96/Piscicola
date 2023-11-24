<html>

<head>

<link href="../content/bienvenida.scss" rel="stylesheet" />

<script src="../scripts/jquery-3.3.1.min.js"></script>

</head>

<body>
    
<div class="slide-container">
  
    <a href="#" class="scrollup boxed-btn is-active">
           <img src="../svg/down-arrow.png">
    </a>

  <div class="wrapper">
    <div class="clash-card barbarian">
      <div class="clash-card__image clash-card__image--barbarian">
        <img src="../svg/fish.png" width="280px" alt="" />
      </div>
      <div class="clash-card__level clash-card__level--barbarian">Aqua</div>
      <div class="clash-card__unit-name">Bienvenido</div>
      <div class="clash-card__unit-description">
      Aqua es un sistema de información creado para realizar seguimiento y control de la actividad piscícola.
      </div>

     <!-- <div class="clash-card__unit-stats clash-card__unit-stats--barbarian clearfix">
        <div class="one-third">
          <div class="stat">20<sup>S</sup></div>
          <div class="stat-value">Training</div>
        </div>

        <div class="one-third">
          <div class="stat">16</div>
          <div class="stat-value">Speed</div>
        </div>

        <div class="one-third no-border">
          <div class="stat">150</div>
          <div class="stat-value">Cost</div>
        </div>

      </div>-->

    </div> <!-- end clash-card barbarian-->
  </div> <!-- end wrapper -->
  
  <div class="wrapper">
    <div class="clash-card archer">
      <div class="clash-card__image clash-card__image--archer">
        <img src="../svg/dock.png" width="240px" alt="archer" />
      </div>
      <div class="clash-card__level clash-card__level--archer">Aqua</div>
      <div class="clash-card__unit-name">Tipo de lago</div>
      <div class="clash-card__unit-description">
        Parametriza los tipos de lago que utilizas  podría ser lagos en tierra , en geomembrana  , estanques de cemento o jaulones.
      </div>

    </div> <!-- end clash-card archer-->
  </div> <!-- end wrapper -->
  
  <div class="wrapper">
    <div class="clash-card giant">
      <div class="clash-card__image clash-card__image--giant">
        <img src="../svg/lak.png" width="230px" alt="" />
      </div>
      <div class="clash-card__level clash-card__level--giant">Aqua</div>
      <div class="clash-card__unit-name">Lagos</div>
      <div class="clash-card__unit-description">
         Configura los lagos, de esta manera podrás llevar un control por cada uno. Hará más fácil la toma de daciones.
      </div>

      <!--
      <div class="clash-card__unit-stats clash-card__unit-stats--giant clearfix">
        <div class="one-third">
          <div class="stat">2<sup>M</sup></div>
          <div class="stat-value">Training</div>
        </div>

        <div class="one-third">
          <div class="stat">12</div>
          <div class="stat-value">Speed</div>
        </div>

        <div class="one-third no-border">
          <div class="stat">2250</div>
          <div class="stat-value">Cost</div>
        </div>

      </div>
-->

    </div> <!-- end clash-card giant-->
  </div> <!-- end wrapper -->
  
   <div class="wrapper">
    <div class="clash-card goblin">
      <div class="clash-card__image clash-card__image--goblin">
        <img src="../svg/sonda.png" width="230px" alt="" />
      </div>
      <div class="clash-card__level clash-card__level--goblin">Aqua</div>
      <div class="clash-card__unit-name">Sonda</div>
      <div class="clash-card__unit-description">
           Es el elemento que utilizas para medir las variables fisicoquímicas del agua , importante que las configures de esta manera sabrás con exactitud donde se encuentran y podrás conocer las mediciones en tiempo real.
      </div>

      <!--
      <div class="clash-card__unit-stats clash-card__unit-stats--goblin clearfix">
        <div class="one-third">
          <div class="stat">30<sup>S</sup></div>
          <div class="stat-value">Training</div>
        </div>

        <div class="one-third">
          <div class="stat">32</div>
          <div class="stat-value">Speed</div>
        </div>

        <div class="one-third no-border">
          <div class="stat">100</div>
          <div class="stat-value">Cost</div>
        </div>

      </div>
-->

    </div> <!-- end clash-card goblin-->
  </div> <!-- end wrapper -->
  
  <div class="wrapper">
    <div class="clash-card wizard">
      <div class="clash-card__image clash-card__image--wizard">
        <img src="../svg/ice-fishing.png" width="230px" alt="" />
      </div>
      <div class="clash-card__level clash-card__level--wizard">Aqua</div>
      <div class="clash-card__unit-name">Cultivo</div>
      <div class="clash-card__unit-description">
        Cultivo es un registro que se realiza durante un periodo de tiempo, de esta manera se tiene un historial de la actividad en cada lago.
      </div>

      <!--
      <div class="clash-card__unit-stats clash-card__unit-stats--wizard clearfix">
        <div class="one-third">
          <div class="stat">5<sup>M</sup></div>
          <div class="stat-value">Training</div>
        </div>

        <div class="one-third">
          <div class="stat">16</div>
          <div class="stat-value">Speed</div>
        </div>

        <div class="one-third no-border">
          <div class="stat">4000</div>
          <div class="stat-value">Cost</div>
        </div>

      </div>
-->

    </div> <!-- end clash-card wizard-->
  </div> <!-- end wrapper -->
  
</div> <!-- end container -->

<script>
 (function () {

    try {
      var slideContainer = $('.slide-container');

     slideContainer.slick();

     $('.clash-card__image img').hide();
     $('.slick-active').find('.clash-card img').fadeIn(200);

     // On before slide change
     slideContainer.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
         $('.slick-active').find('.clash-card img').fadeOut(1000);
     });

     // On after slide change
     slideContainer.on('afterChange', function (event, slick, currentSlide) {
         $('.slick-active').find('.clash-card img').fadeIn(200);
     });
    } catch (error) {
       console.log(error);
    }
     

 })();
</script>

</body>

</html>
<html>

<head>
<style>
     @import url(https://fonts.googleapis.com/css?family=Lato:400,700,900);

     $border-radius-size: 14px;
     $barbarian: #EC9B3B;
     $archer: #EE5487;
     $giant: #F6901A;
     $goblin: #82BB30;
     $wizard: #4FACFF;

     *,
     *:before,
     *:after {
         box-sizing: border-box;
     }

     body {
         background: linear-gradient(to bottom, rgba(140, 122, 122, 1) 0%, rgba(175, 135, 124, 1) 65%, rgba(175, 135, 124, 1) 100%) fixed;
         background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/coc-background.jpg') no-repeat center center fixed;
         background-size: cover;
         font: 14px/20px "Lato", Arial, sans-serif;
         color: #9E9E9E;
         margin-top: 30px;
     }

     .slide-container {
         margin: auto;
         width: 600px;
         text-align: center;
     }

     .wrapper {
         padding-top: 40px;
         padding-bottom: 40px;

         &:focus {
             outline: 0;
         }
     }



     .clash-card {
         background: white;
         width: 300px;
         display: inline-block;
         margin: auto;
         border-radius: $border-radius-size + 5;
         position: relative;
         text-align: center;
         box-shadow: -1px 15px 30px -12px black;
         z-index: 9999;
     }

     .clash-card__image {
         position: relative;
         height: 230px;
         margin-bottom: 35px;
         border-top-left-radius: $border-radius-size;
         border-top-right-radius: $border-radius-size;
     }

     .clash-card__image--barbarian {
         background: url('../svg/fondo1.jpg');

         img {
             width: 400px;
             position: absolute;
             top: -65px;
             left: -70px;
         }
     }

     .clash-card__image--archer {
         background: url('../svg/fondo2.jpg');

         img {
             width: 400px;
             position: absolute;
             top: -34px;
             left: -37px;
         }
     }

     .clash-card__image--giant {
         background: url('../svg/fondo3.jpg');

         img {
             width: 340px;
             position: absolute;
             top: -30px;
             left: -25px;
         }
     }

     .clash-card__image--goblin {
         background: url('../svg/fondo1.jpg');

         img {
             width: 370px;
             position: absolute;
             top: -21px;
             left: -37px;
         }
     }

     .clash-card__image--wizard {
         background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/wizard-bg.jpg');

         img {
             width: 345px;
             position: absolute;
             top: -28px;
             left: -10px;
         }
     }

     .clash-card__level {
         text-transform: uppercase;
         font-size: 12px;
         font-weight: 700;
         margin-bottom: 3px;
     }

     .clash-card__level--barbarian {
         color: $barbarian;
     }

     .clash-card__level--archer {
         color: $archer;
     }

     .clash-card__level--giant {
         color: $giant;
     }

     .clash-card__level--goblin {
         color: $goblin;
     }

     .clash-card__level--wizard {
         color: $wizard;
     }

     .clash-card__unit-name {
         font-size: 26px;
         color: black;
         font-weight: 900;
         margin-bottom: 5px;
     }

     .clash-card__unit-description {
         padding: 20px;
         margin-bottom: 10px;
     }

     .clash-card__unit-stats--barbarian {
         background: $barbarian;

         .one-third {
             border-right: 1px solid #BD7C2F;
         }
     }

     .clash-card__unit-stats--archer {
         background: $archer;

         .one-third {
             border-right: 1px solid #D04976;
         }
     }

     .clash-card__unit-stats--giant {
         background: $giant;

         .one-third {
             border-right: 1px solid darken($giant, 8%);
         }
     }

     .clash-card__unit-stats--goblin {
         background: $goblin;

         .one-third {
             border-right: 1px solid darken($goblin, 6%);
         }
     }

     .clash-card__unit-stats--wizard {
         background: $wizard;

         .one-third {
             border-right: 1px solid darken($wizard, 6%);
         }
     }

     .clash-card__unit-stats {

         color: white;
         font-weight: 700;
         border-bottom-left-radius: $border-radius-size;
         border-bottom-right-radius: $border-radius-size;

         .one-third {
             width: 33%;
             float: left;
             padding: 20px 15px;
         }

         sup {
             position: absolute;
             bottom: 4px;
             font-size: 45%;
             margin-left: 2px;
         }

         .stat {
             position: relative;
             font-size: 24px;
             margin-bottom: 10px;
         }

         .stat-value {
             text-transform: uppercase;
             font-weight: 400;
             font-size: 12px;
         }

         .no-border {
             border-right: none;
         }
     }

     .clearfix:after {
         visibility: hidden;
         display: block;
         font-size: 0;
         content: " ";
         clear: both;
         height: 0;
     }

     .slick-prev {
         left: 100px;
         z-index: 999;
     }

     .slick-next {
         right: 100px;
         z-index: 999;
     }

     /*----------- */
     .scrollup.is-active {
         top: 98%;
         -webkit-transform: translateY(-98%);
         transform: translateY(-98%);
         opacity: 1;
         visibility: visible;
     }

     .scrollup.boxed-btn {
    width: 50px;
    height: 50px;
    border-radius: 0px 20px 0 20px;
    text-align: center;
    position: fixed;
    top: 100;
    right: 15px;
    padding: 0;
    color: #ffffff;
    /*opacity: 0;*/
    /*visibility: hidden;*/
    -webkit-transition: .9s;
    transition: .9s;
    z-index: 888;
    box-shadow: 0 2px 10px 0 rgba(0, 0, 0, .5);
}
</style>

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

      <div class="clash-card__unit-stats clash-card__unit-stats--barbarian clearfix">
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

      </div>

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

    </div> <!-- end clash-card wizard-->
  </div> <!-- end wrapper -->
  
</div> <!-- end container -->

<script>
 (function () {

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

 })();
</script>

</body>

</html>
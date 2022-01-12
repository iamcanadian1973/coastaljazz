import $ from 'jquery';
import 'slick-carousel';

// import "core-js/stable";
// import "regenerator-runtime/runtime";

// Foundation
import foundation from './modules/foundation'; /* eslint-disable-line */

// Custom Modules
import externalLinks from './modules/external-links';
//import doubleTapToGo from './modules/doubletaptogo';
import general from './modules/general';
//import slick from './modules/slick';
import genesisResonsiveMenu from './modules/genesis-responsive-menu';
import responsiveVideoEmbeds from './modules/responsive-video-embeds';

$(function() {

    $( document ).foundation();

    //doubleTapToGo.init();
	general.init();
    //slick.init();
    genesisResonsiveMenu.init();
    responsiveVideoEmbeds.init();

    $('.slick').slick();
});
<?php

/*
Modal - Contact
		
*/

modal_contact();
function modal_contact() {
    ?>
    <div class="contact reveal" id="contact" data-reveal data-animation-in="hinge-in-from-middle-y fast" data-animation-out="hinge-out-from-middle-y fast">
 	<div class="modal-contact">
		<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	  </button>
      <div class="modal-title">
      <?php
      printf( '<h4>%s</h4>', __( 'Free Consultation', '_s' ) );
      ?>
      </div>
	  <div class="modal-description">
		  <?php 
		  printf( '<p>%s</p>', __( 'We’ll get back to you within 1 business day.', '_s' ) );
          ?>
		  </div>
      
      <div class="modal-form">
	  <?php
 	    echo do_shortcode( '[gravityform id="1" title="false" description="false" ajax="true" tabindex="99"]' );
	  ?>
      </div>
   </div>
</div>
<?php
       
}
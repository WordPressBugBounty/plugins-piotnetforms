<?php
	if ( ! defined( 'ABSPATH' ) ) { exit; }
	
	add_action( 'wp_ajax_piotnetforms_save_draft', 'piotnetforms_save_draft' );
	add_action( 'wp_ajax_nopriv_piotnetforms_save_draft', 'piotnetforms_save_draft' );

	function piotnetforms_save_draft() {
        if(isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'piotnetforms_admin_nonce' )){
            $post_id    = sanitize_text_field( $_POST['post_id'] );
            $post_title = sanitize_text_field( $_POST['post_title'] );

            $my_post_update = [
                'ID'          => $post_id,
                'post_title'  => ! empty( $post_title ) ? $post_title : ( 'Piotnet Forms #' . $post_id ),
                'post_status' => 'publish',
            ];
            wp_update_post( $my_post_update );
        }else{
            echo "Nonce verification failed.";
        }
		wp_die();
	}

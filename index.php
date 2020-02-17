<?php
/*
Plugin Name: Student Utility
Plugin URI: none
Description:
Author: Matt Mullenweg
Version: 1.0
Author URI:
*/









add_action( 'user_new_form', 'crf_admin_registration_form' );
function crf_admin_registration_form( $operation ) {
    if ( 'add-new-user' !== $operation ) {
        // $operation may also be 'add-existing-user'
        return;
    }

    $year = ! empty( $_POST['year_of_birth'] ) ? intval( $_POST['year_of_birth'] ) : '';

    ?>
    <h3><?php esc_html_e( 'Personal Information', 'crf' ); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="year_of_birth"><?php esc_html_e( 'Year of birth', 'crf' ); ?></label> <span class="description"><?php esc_html_e( '(required)', 'crf' ); ?></span></th>
            <td>
                <input type="number"
                       min="1900"
                       max="2017"
                       step="1"
                       id="year_of_birth"
                       name="year_of_birth"
                       value="<?php echo esc_attr( $year ); ?>"
                       class="regular-text"
                />
            </td>
        </tr>
    </table>
    <?php
}


add_action( 'edit_user_created_user', 'crf_user_register' );

function crf_user_register( $user_id ) {
    if ( ! empty( $_POST['year_of_birth'] ) ) {
        update_user_meta( $user_id, 'year_of_birth', intval( $_POST['year_of_birth'] ) );
    }
}


add_action( 'show_user_profile', 'crf_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'crf_show_extra_profile_fields' );

function crf_show_extra_profile_fields( $user ) {
    ?>
    <h3><?php esc_html_e( 'Personal Information', 'crf' ); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="year_of_birth"><?php esc_html_e( 'Year of birth', 'crf' ); ?></label></th>
            <td><?php echo esc_html( get_the_author_meta( 'year_of_birth', $user->ID ) ); ?></td>
        </tr>
    </table>
    <?php
}